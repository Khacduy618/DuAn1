<?php
require_once 'Models/reviews.php';

class ReviewController {
    private $reviewModel;

    public function __construct() {
        $this->reviewModel = new Review();
    }

    public function submitReview() {
        try {
            if (!isset($_SESSION['login']['user_email'])) {
                throw new Exception("Bạn cần đăng nhập để đánh giá sản phẩm.");
            }

            $userEmail = $_SESSION['login']['user_email'];
            $productId = isset($_POST['id']) ? (int)$_POST['id'] : null;
            $reviewCategory = isset($_POST['review_category']) ? (int)$_POST['review_category'] : null;
            $reviewContent = trim($_POST['review_content'] ?? '');
            $reviewCategoryId = $_POST['review_category'];

            if (!$productId || !$reviewCategory || empty($reviewContent)) {
                throw new Exception("Vui lòng điền đầy đủ thông tin đánh giá.");
            }

            if (!is_numeric($reviewCategory) || $reviewCategory < 1 || $reviewCategory > 5) {
                throw new Exception("Đánh giá không hợp lệ.");
            }

            if (strlen($reviewContent) < 10) {
                throw new Exception("Nội dung đánh giá quá ngắn. Vui lòng viết ít nhất 10 ký tự.");
            }

            if (!$this->reviewModel->hasUserPurchasedProduct($userEmail, $productId)) {
                throw new Exception("Bạn chỉ có thể đánh giá sản phẩm đã mua.");
            }

            $result = $this->reviewModel->addReview($userEmail, $productId, $reviewCategory, $reviewContent);
            $this->reviewModel->increaseReviewCount($reviewCategoryId);
            if ($result === "duplicate") {
                throw new Exception("Bạn đã đánh giá sản phẩm này rồi.");
            }

            if ($result === false) {
                throw new Exception("Có lỗi xảy ra khi thêm đánh giá.");
            }
            
        } catch (Exception $e) {
            $_SESSION['error_message'] = $e->getMessage();
        }
        
        header("Location: index.php?act=product&id=" . $productId);
        exit();
    }
    public function getReviews() {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Missing product ID');
            }
    
            $productId = (int)$_GET['id'];
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';
    
            return $this->reviewModel->getReviewsByProduct($productId, $sort);
        } catch (Exception $e) {
            return [];
        }
    }
    
    public function checkPurchaseStatus($userEmail, $productId) {
        try {
            $sql = "SELECT COUNT(*) as count 
                    FROM bills b
                    JOIN bill_details bd ON b.bill_id = bd.id_bill
                    WHERE b.bill_userEmail = ? 
                    AND bd.pro_id = ?
                    AND b.bill_status = 7";  
            
            $result = pdo_query_one($sql, $userEmail, $productId);
            return ($result && $result['count'] > 0);
        } catch (Exception $e) {
            error_log("ERROR: " . $e->getMessage());
            return false;
        }
    }

    public function handleVote() {
        try {
            ob_clean();
            header('Content-Type: application/json');
            
            if (!isset($_SESSION['login']['user_email'])) {
                echo json_encode(['error' => 'Vui lòng đăng nhập']);
                exit();
            }

            $userEmail = $_SESSION['login']['user_email'];
            $reviewId = isset($_POST['reviewId']) ? (int)$_POST['reviewId'] : null;
            $voteType = isset($_POST['voteType']) ? $_POST['voteType'] : null;
            $action = isset($_POST['action']) ? $_POST['action'] : null;

            if (!$reviewId || !$voteType || !$action) {
                echo json_encode(['error' => 'Thiếu thông tin']);
                exit();
            }

            $result = $this->reviewModel->updateVote($reviewId, $voteType, $action, $userEmail);
            echo json_encode(['success' => true, 'data' => $result]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit();
    }

    public function getUserVotes() {
        try {
            ob_clean();
            header('Content-Type: application/json');
            
            if (!isset($_SESSION['login']['user_email'])) {
                echo json_encode(['error' => 'Unauthorized']);
                exit();
            }
        
            $userEmail = $_SESSION['login']['user_email'];
            $votes = $this->reviewModel->getUserVotes($userEmail);
            echo json_encode(['success' => true, 'data' => $votes]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit();
    }
}
?>