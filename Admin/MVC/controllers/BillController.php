<?php
require_once ("MVC/Models/billModel.php");

class BillController
{
    private $billModel;

    public function __construct()
    {
        $this->billModel = new BillModel();
    }

    // Method to list all bills
    public function listBills()
    {
        $bills = $this->billModel->getAll();

        // Including the view for listing bills
        require_once('MVC/Views/admin/index.php');
    }

    // Method to get the details of a bills
    public function detail()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            $billDetails = $this->billModel->details($billId);

            // Including the view for displaying bills details
            require_once('MVC/Views/admin/index.php');
        } else {
            // Redirect to list if no ID is provided
            header('Location: ?mod=bill');
        }
    }
    public function archivedBills()
    {
        $archivedBills = $this->billModel->getArchivedBills();
        require_once('MVC/Views/admin/index.php');
    }
    public function listDeletedBills()
    {
        $bills = $this->billModel->getDeleted();
        require_once('MVC/Views/admin/index.php');
    }
    // Method to delete a bills
    public function deleteBill()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            $this->billModel->softDelete($billId);
            header('Location: ?mod=bill&act=list');
            exit;
        }
    }
    public function restoreBillArchived()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            // Cập nhật trạng thái hóa đơn thành trạng thái "Completed" hoặc "Pending"
            $this->billModel->updateStatus($billId, 7); // Ví dụ: chuyển về trạng thái "Completed"

            // Sau khi khôi phục, chuyển hướng về danh sách hóa đơn bình thường
            header('Location: ?mod=bill&act=list');
            exit;
        } else {
            // Nếu không có ID, chuyển hướng về danh sách lưu trữ
            header('Location: ?mod=bill&act=archived');
        }
    }
    public function restoreBillDeleted()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            $this->billModel->restoreDeleted($billId);

            // Redirect to the deleted bills list after restoration
            header('Location: ?mod=bill&act=deleted');
            exit;
        } else {
            // If no ID is provided, redirect to the list
            header('Location: ?mod=bill&act=list');
        }
    }

    // Method to update the status of a bills
    public function status()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            $newStatus = $_GET['status'];  
            $this->billModel->updateStatus($billId, $newStatus);

                // Redirect back to the list after updating
            if ($newStatus === 8) {
                header('Location: ?mod=bill&act=archived');
            } else {
                header('Location: ?mod=bill&act=list&status=' . $newStatus);
            }
            exit;
        } else {
            header('Location: ?mod=bill&act=list');
        }
    }

    public function edit_bill_status_ajax() {
        // Session::checkSession2();
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
        error_log("Received POST data: " . print_r($_POST, true));
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'success' => false,
                'message' => 'Phương thức không được hỗ trợ'
            ]);
            return;
        }
        $bill_id = $_POST['bill_id'] ?? '';
        if (empty($bill_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu bill_id'
            ]);
            return;
        }
        $data = [];
        if (!empty($_POST['bill_status'])) {
            if ($_POST['bill_status'] == 1 || $_POST['bill_status'] == 2) {
                $data['bill_status'] = 3;
            }
            if ($_POST['bill_status'] == 4) {
                $data['bill_status'] = 5;
            }
            if ($_POST['bill_status'] == 5) {
                $data['bill_status'] = 6;
            }
            
        }
        error_log("Prepared data for update: " . print_r($data, true));
        if (empty($data)) {
            echo json_encode([
                'success' => false,
                'message' => 'Không có dữ liệu để cập nhật'
            ]);
            return;
        }
        $result = $this->billModel->updateStatus_ajax($bill_id, $data['bill_status']);
        $result_sau_update = $this->billModel->select_id_status_ajax($bill_id);
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Cập nhật thành công' : 'Cập nhật thất bại',
            'data' => $result_sau_update,
            'debug' => [
                'post_data' => $_POST,
                'processed_data' => $data,
                'bill_id' => $bill_id,
                'bill_status' => $result_sau_update['bill_status']
            ]
        ]);
        
    }
    public function get_bill_id_status_ajax() {
        // Session::checkSession2();
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
        error_log("Received POST data: " . print_r($_POST, true));
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'success' => false,
                'message' => 'Phương thức không được hỗ trợ'
            ]);
            return;
        }
        $bill_id = $_POST['bill_id'] ?? '';
        if (empty($bill_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu bill_id'
            ]);
            return;
        }
        $result = $this->billModel->getAll_by_id($bill_id);
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Cập nhật thành công' : 'Cập nhật thất bại',
            'data' => $result,
            'debug' => [
                'post_data' => $_POST,
                'processed_data' => $bill_id,
                'bill_id' => $bill_id,
                'bill_status' => $result['bill_status']
            ]
        ]);
        
    }

}
?>