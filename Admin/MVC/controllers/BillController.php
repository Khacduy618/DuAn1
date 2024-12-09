<?php
require_once("MVC/Models/billModel.php");

class BillController
{
    private $billModel;

    public function __construct()
    {
        $this->billModel = new BillModel();
    }

    public function listBills()
    {
        $bills = $this->billModel->getAll();
        require_once('MVC/Views/admin/index.php');
    }

    public function detail()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            $billDetails = $this->billModel->details($billId);
            
            // Kiểm tra xem có dữ liệu không
            if (!$billDetails) {
                // Nếu không có dữ liệu, set một mảng trống
                $billDetails = [];
            }
            
            // Định nghĩa mapping trạng thái
            $statusMapping = [
                1 => ['Chưa thanh toán', 'danger'],
                2 => ['Đã thanh toán', 'success'],
                3 => ['Đang xử lý', 'warning'],
                4 => ['Đã xác nhận', 'info'],
                5 => ['Đang giao hàng', 'primary'],
                6 => ['Đã giao hàng', 'success'],
                7 => ['Hoàn thành', 'success'],
                8 => ['Đã lưu trữ', 'secondary']
            ];
            
            require_once('MVC/Views/admin/index.php');
        } else {
            header('Location: ?mod=bill');
        }
    }

    public function archivedBills()
    {
        $archivedBills = $this->billModel->getArchivedBills();
        require_once('MVC/Views/admin/index.php');
    }

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
            $this->billModel->updateStatus($billId, 7); // Chuyển về trạng thái "Completed"
            header('Location: ?mod=bill&act=list');
            exit;
        } else {
            header('Location: ?mod=bill&act=archived');
        }
    }

    public function status()
    {
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $billId = $_GET['id'];
            $newStatus = $_GET['status'];
            $this->billModel->updateStatus($billId, $newStatus);

            if ($newStatus == 8) {
                header('Location: ?mod=bill&act=archived');
            } else {
                header('Location: ?mod=bill&act=list&status=' . $newStatus);
            }
            exit;
        } else {
            header('Location: ?mod=bill&act=list');
        }
    }

    public function edit_bill_status_ajax()
    {
        header('Content-Type: application/json');
        
        // Đọc raw POST data vì đang gửi FormData
        $billId = $_POST['bill_id'] ?? null;
        $newStatus = $_POST['bill_status'] ?? null;

        if (!$billId || !$newStatus) {
            echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
            return;
        }

        try {
            $this->billModel->updateStatus_ajax($billId, $newStatus);
            echo json_encode(['success' => true, 'message' => 'Update status success']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }
}
