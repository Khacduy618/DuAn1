<?php
require_once("pdo.php");

class Review {
    private $db;

    public function __construct() {
        try {
            $this->db = pdo_get_connection();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function increaseReviewCount($reviewCategoryId) {
        $sql = "UPDATE review_categories SET review_count = review_count + 1 WHERE review_categoryId = ?";
        pdo_execute($sql, $reviewCategoryId);
    }

    public function getProductDetails($product_id) {
        try {
            $sql = "SELECT p.*, c.category_name 
                    FROM products p
                    LEFT JOIN categories c ON p.category_id = c.category_id
                    WHERE p.product_id = ?";
            return pdo_query_one($sql, $product_id);
        } catch (Exception $e) {
            return null;
        }
    }

    public function hasUserPurchasedProduct($userEmail, $productId) {
        try {
            $sql = "SELECT COUNT(*) as total 
                    FROM bills b
                    JOIN bill_details bd ON b.bill_id = bd.id_bill
                    WHERE b.bill_userEmail = ? 
                    AND bd.pro_id = ?
                    AND b.bill_status = 7";
            
            $result = pdo_query_one($sql, $userEmail, $productId);
            return ($result && isset($result['total']) && $result['total'] > 0);
        } catch (Exception $e) {
            return false;
        }
    }

    public function hasUserReviewed($userEmail, $productId) {
        try {
            if (!$userEmail || !$productId) {
                return true;
            }

            $purchaseCount = $this->getPurchaseCount($userEmail, $productId);
            $reviewCount = $this->getReviewCount($userEmail, $productId);
            
            return $reviewCount < $purchaseCount;
        } catch (Exception $e) {
            return true;
        }
    }

    public function getReviewsByProduct($product_id, $sort = 'latest') {
        try {
            $sql = "SELECT r.*, 
                    ROUND(r.review_category) as review_category,
                    u.user_name, 
                    u.user_full_name, 
                    rc.review_name
                    FROM reviews r
                    LEFT JOIN user u ON r.review_userEmail = u.user_email
                    LEFT JOIN review_categories rc ON r.review_category = rc.review_categoryId
                    WHERE r.pro_id = ? ";
    
            switch ($sort) {
                case 'rating-desc':
                    $sql .= "ORDER BY r.review_category DESC, r.review_dateTime DESC";
                    break;
                case 'rating-asc':
                    $sql .= "ORDER BY r.review_category ASC, r.review_dateTime DESC";
                    break;
                case 'helpful':
                    $sql .= "ORDER BY r.helpful DESC, r.review_dateTime DESC";
                    break;
                case 'latest':
                    $sql .= "ORDER BY r.review_dateTime DESC";
                    break;
                default:
                    $sql .= "ORDER BY r.review_dateTime DESC";
            }
            
            return pdo_query($sql, $product_id);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getAverageRating($productId) {
        try {
            $sql = "SELECT AVG(review_category) as avg_rating,
                           COUNT(*) as total_reviews
                    FROM reviews 
                    WHERE pro_id = ?";
            
            $result = pdo_query_one($sql, $productId);
            
            return [
                'rating' => $result && $result['avg_rating'] ? round($result['avg_rating'], 1) : 0,
                'count' => $result ? (int)$result['total_reviews'] : 0
            ];
        } catch (Exception $e) {
            return ['rating' => 0, 'count' => 0];
        }
    }

    public function addReview($userEmail, $productId, $reviewCategory, $reviewContent) {
        try {
            $this->db->beginTransaction();
    
            $sql = "INSERT INTO reviews (review_userEmail, pro_id, review_category, 
                                       review_content, review_dateTime) 
                    VALUES (?, ?, ?, ?, NOW())";
            $result = pdo_execute($sql, $userEmail, $productId, $reviewCategory, $reviewContent);
    
            $updateCatSql = "UPDATE review_categories 
                            SET review_count = review_count + 1 
                            WHERE review_name = ?";
            pdo_execute($updateCatSql, $reviewCategory);
    
            $this->db->commit();
            return $result;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getRatingDistribution($product_id) {
        $distribution = [];
        try {
            $sql = "SELECT review_category, COUNT(*) as count 
                    FROM reviews 
                    WHERE pro_id = ? 
                    GROUP BY review_category";
            $result = pdo_query($sql, $product_id);
            
            foreach ($result as $row) {
                $distribution[$row['review_category']] = $row['count'];
            }
        } catch (Exception $e) {
            // Trả về mảng trống nếu có lỗi
        }
        return $distribution;
    }

    public function getPurchaseCount($userEmail, $productId) {
        try {
            $sql = "SELECT COUNT(DISTINCT b.bill_id) as count 
                    FROM bills b
                    JOIN bill_details bd ON b.bill_id = bd.id_bill
                    WHERE b.bill_userEmail = ? 
                    AND bd.pro_id = ?
                    AND b.bill_status = 7";
            
            $result = pdo_query_one($sql, $userEmail, $productId);
            return ($result ? $result['count'] : 0);
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getReviewCount($userEmail, $productId) {
        try {
            $sql = "SELECT COUNT(*) as count 
                    FROM reviews 
                    WHERE review_userEmail = ? 
                    AND pro_id = ?";
            
            $result = pdo_query_one($sql, $userEmail, $productId);
            return ($result ? $result['count'] : 0);
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateVote($reviewId, $voteType, $action, $userEmail) {
        try {
            $this->db->beginTransaction();
            
            if ($action === 'add') {
                $deleteOld = "DELETE FROM review_votes 
                             WHERE review_id = ? AND user_email = ?";
                pdo_execute($deleteOld, $reviewId, $userEmail);
                
                $insertVote = "INSERT INTO review_votes (review_id, user_email, vote_type) 
                              VALUES (?, ?, ?)";
                pdo_execute($insertVote, $reviewId, $userEmail, $voteType);
            } else {
                $deleteVote = "DELETE FROM review_votes 
                              WHERE review_id = ? AND user_email = ?";
                pdo_execute($deleteVote, $reviewId, $userEmail);
            }
    
            $updateCounts = "UPDATE reviews r 
                            SET helpful = (SELECT COUNT(*) FROM review_votes 
                                         WHERE review_id = r.review_id AND vote_type = 'like'),
                                unhelpful = (SELECT COUNT(*) FROM review_votes 
                                           WHERE review_id = r.review_id AND vote_type = 'dislike')
                            WHERE review_id = ?";
            pdo_execute($updateCounts, $reviewId);
    
            $this->db->commit();
    
            $sql = "SELECT helpful, unhelpful FROM reviews WHERE review_id = ?";
            return pdo_query_one($sql, $reviewId);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    
    public function getUserVotes($userEmail) {
        try {
            $sql = "SELECT review_id, vote_type 
                    FROM review_votes 
                    WHERE user_email = ?";
            $votes = pdo_query($sql, $userEmail);
            
            $result = [];
            foreach ($votes as $vote) {
                $result[$vote['review_id']] = $vote['vote_type'];
            }
            return $result;
        } catch (Exception $e) {
            return [];
        }
    }

    public function canUserReview($userEmail, $productId) {
        try {
            if (!$userEmail || !$productId) {
                return false;
            }

            $purchaseCount = $this->getPurchaseCount($userEmail, $productId);
            $reviewCount = $this->getReviewCount($userEmail, $productId);

            return $reviewCount < $purchaseCount;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllProductReviews() {
        try {
            $sql = "SELECT pro_id as product_id, review_category as rating FROM reviews WHERE 1";
            return pdo_query($sql);
        } catch (Exception $e) {
            error_log("Lỗi lấy đánh giá sản phẩm: " . $e->getMessage());
            return [];
        }
    }
}
?>