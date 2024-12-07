<?php
require_once("Models/checkout.php");
require_once 'Models/cart.php';
require_once("Models/address.php");
require_once("Models/product.php");
class CheckoutController
{
    private $checkout_model;
    private $cartModel;
    private $addressModel;
    private $productModel;
    public function __construct()
    {
        $this->checkout_model = new Checkout();
        $this->cartModel = new Cart();
        $this->addressModel = new Address();
        $this->productModel = new Product();
    }
    function list()
    {
        if (isset($_SESSION['login'])) {
            $userEmail = $_SESSION['login']['user_email'];

            if (isset($_POST['shipping'])) {
                $shipping = $_POST['shipping'];
            } else {
                setcookie('msg1', 'Vui lòng chọn phương thức vận chuyển', time() + 5);
                header('location: ?act=cart');
                return;
            }

           
            if (isset($_POST['address_id'])) {
                $address_id = $_POST['address_id'];
                $address = $this->addressModel->getOneAddressById($address_id);
            } else {
                setcookie('msg1', 'Vui lòng chọn địa chỉ giao hàng', time() + 5);
                header('location: ?act=cart');
                return;
            }

            if (isset($_POST['coupon'])) {
                $coupon_name = $_POST['coupon'];
                $coupon = $this->cartModel->coupon($coupon_name);
            }  

            if (isset($_POST['total'])) {
                $total = $_POST['total'];
            } else {
                setcookie('msg1', 'Vui lòng chọn sản phẩm để thanh toán', time() + 5);
                header('location: ?act=cart');
                return;
            }

            if (isset($_POST['cart_items'])) {
                $cartItems = $this->cartModel->getCartItems($userEmail);
                $selectedItemIds = $_POST['cart_items'];
                $cartItems = array_filter($cartItems, function($item) use ($selectedItemIds) {
                    return in_array($item['cart_item_id'], $selectedItemIds);
                });
            } else {
                setcookie('msg1', 'Vui lòng chọn ít nhất 1 sản phẩm để thanh toán', time() + 5);
                header('location: ?act=cart');
                return;
            }

            require_once 'Views/index.php';
        } else {
            header('location: ?act=taikhoan');
        }
    }
    function save() {
        if (isset($_SESSION['login']) && isset($_POST['bill_payment'])) {
            try {
                $userEmail = $_SESSION['login']['user_email'];
                $user_name = $_SESSION['login']['user_name'];

                // Kiểm tra session cart_items thay vì POST
                if (!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items'])) {
                    setcookie('msg1', 'Vui lòng chọn sản phẩm để thanh toán', time() + 5);
                    header('Location: ?act=cart');
                    return;
                }

                // Lấy cart_item_ids từ session cart_items
                $selectedItemIds = array_map(function($item) {
                    return $item['cart_item_id'];
                }, $_SESSION['cart_items']);

                // Kiểm tra số lượng sản phẩm trước khi đặt hàng
                foreach ($_SESSION['cart_items'] as $item) {
                    if (!$this->checkout_model->checkProductQuantity($item['pro_id'], $item['quantity'])) {
                        setcookie('msg1', 'Sản phẩm ' . $item['product_name'] . ' không đủ số lượng', time() + 5);
                        header('Location: ?act=cart');
                        return;
                    }
                }

                // Tạo bill_var_id unique
                $bill_var_id = 'Tede-' . $user_name . '-' . date('YmdHis');
                
                // Lấy các giá trị từ POST
                $address_id = isset($_POST['address_id']) ? (int)$_POST['address_id'] : null;
                $total = isset($_POST['total']) ? (int)$_POST['total'] : 0;
                $tong = isset($_POST['tong']) ? (int)$_POST['tong'] : 0;
                $shipping = isset($_POST['shipping']) ? (int)$_POST['shipping'] : 0;
                $coupon_id = isset($_POST['coupon_id']) ? (int)$_POST['coupon_id'] : 0;
                $bill_payment = (int)$_POST['bill_payment'];
                $bill_status = $bill_payment == 1 ? 1 : 2;

                $address = $this->addressModel->getOneAddressById($address_id);
                if($coupon_id){
                    $this->cartModel-> coupon_update($coupon_id);
                }
                // Thêm hóa đơn và lấy ID
                $bill_id = $this->checkout_model->bill_insert_id(
                    $bill_var_id,
                    $userEmail,
                    $_SESSION['login']['user_phone'] ?? '',
                    $address_id,
                    $shipping,
                    $tong,
                    $total,
                    $coupon_id,
                    $bill_payment,
                    $bill_status
                );

                if ($bill_id) {
                    // Tạo chuỗi values cho chi tiết hóa đơn
                    $values_string = "";
                    $ordered_items = [];
                    foreach ($_SESSION['cart_items'] as $key => $item) {
                        // Debug thông tin
                        error_log("Processing item: " . print_r($item, true));
                        
                        $values_string .= "(" . 
                            $bill_id . ", '" . 
                            $bill_var_id . "', " . 
                            (int)$item['pro_id'] . ", " . 
                            (int)$item['product_price'] . ", " . 
                            (int)$item['quantity'] . ")";
                        
                        if ($key !== array_key_last($_SESSION['cart_items'])) {
                            $values_string .= ", ";
                        }

                        $ordered_items[] = [
                            'product_name' => $item['product_name'],
                            'quantity' => $item['quantity'],
                            'price' => $item['product_price'],
                            'total' => $item['product_price'] * $item['quantity']
                        ];
                    }

                    error_log("Final values string: " . $values_string);

                    try {
                        // Thêm chi tiết hóa đơn và cập nhật số lượng sản phẩm
                        $detail_result = $this->checkout_model->insert_bill_detail($values_string);

                        if ($detail_result) {
                            // Xóa các cart item đã chọn từ database
                            $this->cartModel->deleteSelectedCartItems($userEmail, $selectedItemIds);
                            
                            $_SESSION['order_complete'] = [
                                'bill_var_id' => $bill_var_id,
                                'bill_name' => $user_name,
                                'bill_address' => $address['address_name']. '-' . $address['address_street']. ' ' .$address['address_city'],
                                'bill_phone' => $_SESSION['login']['user_phone'],
                                'bill_userEmail' => $userEmail,
                                'bill_payment' => $bill_payment == 1 ? 'Cash on delivery' : 
                                                ($bill_payment == 2 ? 'Direct bank transfer' : 
                                                ($bill_payment == 3 ? 'PayPal' : 'Credit Card (Stripe)')),
                                'bill_date' => date('Y-m-d H:i:s'),
                                'total_amount' => $total,
                                'shipping_fee' => $shipping,
                                'final_total' => $tong,
                                'items' => $ordered_items
                            ];

                            // Xóa giỏ hàng sau khi đặt hàng thành công
                            unset($_SESSION['cart_items']);
                            header('Location: ?act=checkout&xuli=checkout_complete');
                        } else {
                            setcookie('msg1', 'Lỗi khi lưu chi tiết đơn hàng', time() + 5);
                            header('Location: ?act=checkout');
                        }
                    } catch (Exception $e) {
                        error_log("Error in save(): " . $e->getMessage());
                        setcookie('msg1', $e->getMessage(), time() + 5);
                        header('Location: ?act=cart');
                        return;
                    }
                } else {
                    setcookie('msg1', 'Đặt hàng không thành công', time() + 5);
                    header('Location: ?act=checkout');
                }
            } catch (Exception $e) {
                setcookie('msg1', $e->getMessage(), time() + 5);
                header('Location: ?act=cart');
                return;
            }
        } else {
            setcookie('msg1', 'Vui lòng đăng nhập và chọn phương thức thanh toán', time() + 5);
            header('Location: ?act=cart');
        }
    }
    function checkout_complete()
    {   
        require_once('Views/index.php');
    }
    function order_history() {
        if(!isset($_SESSION['login'])) {
            header('Location: index.php?act=login');
            return;
        }

        $userEmail = $_SESSION['login']['user_email']; // Điều chỉnh theo cấu trúc session của bạn
        
        // Lấy danh sách đơn hàng từ database
        $bill = $this->checkout_model->getBillByUserEmail($userEmail);
        
        // Kiểm tra xem $bill có phải là mảng không
        if (!is_array($bill)) {
            $bill = array();
        }
        
        // Lấy chi tiết đơn hàng
        foreach ($bill as &$order) {
            $order['details'] = $this->checkout_model->getBillDetailsByIdBill($order['bill_id']);
        }

        // Include view
        include 'Views/index.php';
    }
}