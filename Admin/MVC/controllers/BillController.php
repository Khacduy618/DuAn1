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
            header('Location: ?mod=bills&act=detail');
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
            header('Location: ?mod=bills&act=list');
            exit;
        }
    }
    public function restoreBillArchived()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            // Cập nhật trạng thái hóa đơn thành trạng thái "Completed" hoặc "Pending"
            $this->billModel->updateStatus($billId, 2); // Ví dụ: chuyển về trạng thái "Completed"

            // Sau khi khôi phục, chuyển hướng về danh sách hóa đơn bình thường
            header('Location: ?mod=bills&act=list');
            exit;
        } else {
            // Nếu không có ID, chuyển hướng về danh sách lưu trữ
            header('Location: ?mod=bills&act=archived');
        }
    }
    public function restoreBillDeleted()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];
            $this->billModel->restoreDeleted($billId);

            // Redirect to the deleted bills list after restoration
            header('Location: ?mod=bills&act=deleted');
            exit;
        } else {
            // If no ID is provided, redirect to the list
            header('Location: ?mod=bills&act=list');
        }
    }

    // Method to update the status of a bills
    public function status()
    {
        if (isset($_GET['id'])) {
            $billId = $_GET['id'];

            // Handle form submission to update status
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newStatus'])) {
                $newStatus = (int) $_POST['newStatus'];  // Cast to int to avoid any injection issues
                $this->billModel->updateStatus($billId, $newStatus);

                // Redirect back to the list after updating
                if ($newStatus === 3) {
                    header('Location: ?mod=bills&act=archived');
                } else {
                    header('Location: ?mod=bills&act=list');
                }
                exit;
            }

            // Fetch bill details for rendering the form
            $billDetails = $this->billModel->details($billId);
            require_once('MVC/Views/admin/index.php');
        } else {
            header('Location: ?mod=bills&act=list');
        }
    }
}
?>
