<?php

use App\Models\CartModel;
require_once("Models/shop.php");
require_once("Models/cart.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ShopController
{
    var $shop_model;
    var $cart_model;

    public function __construct()
    {
        $this->shop_model = new Shop();
        $this->cart_model = new Cart();
    }

    public function list()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
        $paren_id = isset($_GET['paren_id']) ? $_GET['paren_id'] : 0;

        $orderdata = $this->shop_model->getPaginationAndOrderData();
        $data = $this->shop_model->loadall_product($keyword, $orderdata['orderCondition'], $product_cat, $orderdata['itemPerPage'], $orderdata['offset']);
        $data_count = $this->shop_model->count_sp();
        $data_sum = $data_count;

        // Lấy dữ liệu đánh giá
        require_once "Models/reviews.php";
        $reviewModel = new Review();

        // Lấy tất cả đánh giá từ database
        $allReviews = $this->getAllProductReviews($reviewModel);

        // Xử lý dữ liệu đánh giá
        $reviewsCount = [];
        $ratings = [];

        foreach ($allReviews as $review) {
            $productId = $review['product_id'];

            // Đếm số lượng đánh giá cho mỗi sản phẩm
            if (!isset($reviewsCount[$productId])) {
                $reviewsCount[$productId] = 0;
            }
            $reviewsCount[$productId]++;

            // Tính tổng số sao
            if (!isset($ratings[$productId])) {
                $ratings[$productId] = 0;
            }
            $ratings[$productId] += $review['rating'];
        }

        // Tính trung bình số sao
        foreach ($ratings as $productId => $totalRating) {
            if ($reviewsCount[$productId] > 0) {
                $ratings[$productId] = $totalRating / $reviewsCount[$productId];
            }
        }

        require_once('Views/index.php');
    }

    public function getAllProductReviews($reviewModel)
    {
        try {
            return $reviewModel->getAllProductReviews();
        } catch (Exception $e) {
            return [];
        }
    }

    public function send_mail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


                $coupon_name = $this->cart_model->getCouponDeals();
                // dd($coupon_name);

                // Cấu hình PHPMailer
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'khacduy54.55@gmail.com';
                    $mail->Password = 'jbkw seit ixju fvmz';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;
                    $mail->CharSet = 'UTF-8';

                    //Recipients
                    $mail->setFrom('khacduy54.55@gmail.com', 'Tede Shop');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'COUPON CODE - WEBSITE TEDESHOP';
                    $mail->Body = '
                        <h2>Xin chào,</h2>
                        <p>Chúng tôi có deals hời cho bạn với coupon giảm 5%.</p>
                        <p>Mã giảm của bạn là:' . $coupon_name['coupon_name'] . '</p>
                        
                    ';

                    $mail->send();
                    setcookie('msg', 'Email đã được gửi thành công', time() + 5, '/');
                    header('Location: ?act=home');
                    exit();

                } catch (Exception $e) {
                    error_log("Mail Error: " . $mail->ErrorInfo);
                    setcookie('msg1', 'Không thể gửi email: ' . $mail->ErrorInfo, time() + 5, '/');
                    header('Location: ?act=home');
                    exit();
                }

            } catch (Exception $e) {
                error_log("General Error: " . $e->getMessage());
                setcookie('msg1', 'Có lỗi xảy ra, vui lòng thử lại', time() + 5, '/');
                header('Location: ?act=home');
                exit();
            }
        }
    }

}
?>