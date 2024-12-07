<?php

require_once "./Models/reviews.php";
require_once "./Controllers/ReviewControllers.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Khởi tạo các biến cần thiết
$reviewModel = new Review();
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$isLoggedIn = isset($_SESSION['login']['user_email']);
$userEmail = $isLoggedIn ? $_SESSION['login']['user_email'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';

// Lấy thông tin đánh giá và số lần mua hàng
$reviews = $reviewModel->getReviewsByProduct($product_id, $sort);
$ratingInfo = $reviewModel->getAverageRating($product_id);

// Khởi tạo biến đếm số lần mua và đánh giá
$purchaseCount = $isLoggedIn ? $reviewModel->getPurchaseCount($userEmail, $product_id) : 0;
$reviewCount = $isLoggedIn ? $reviewModel->getReviewCount($userEmail, $product_id) : 0;

// Điều kiện hiển thị form
$canReview = $isLoggedIn && ($purchaseCount > $reviewCount);
?>

<ul class="nav nav-pills justify-content-center" role="tablist">
    <li class="nav-item">
        <a class="nav-link " id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab"
            aria-controls="product-desc-tab" aria-selected="true">Technical Specifications
            </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab"
            aria-controls="product-review-tab" aria-selected="false">
            Reviews (<?= $ratingInfo['count'] ?? 0 ?>)
        </a>
    </li>
</ul>

<div class="tab-content">
    <!-- Tab Product Details -->
    <div class="tab-pane fade " id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
        <div class="product-desc-content">
            <?php if (isset($detail) && $detail): ?>
                <div class="product-specs row">
                    <!-- Cột bên trái -->
                    <div class="col-md-6">
                        <div class="row gap-2">
                            <p class="col-4"><strong>Operating System:</strong></p>
                            <p ><?php echo htmlspecialchars($detail['os']); ?></p>
                        </div>
                        <div class="row">
                            <p  class="col-4""><strong>Display & Camera:</strong></p>
                            <p><?php echo htmlspecialchars($detail['screen_cam']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>Graphics Card:</strong></p>
                            <p><?php echo htmlspecialchars($detail['gpu']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>CPU:</strong></p>
                            <p><?php echo htmlspecialchars($detail['cpu']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>Battery:</strong></p>
                            <p><?php echo htmlspecialchars($detail['pin']); ?></p>
                        </div>
                    </div>
                    
                    <!-- Cột bên phải -->
                    <div class="col-md-6">
                        <div class="row">
                            <p class="col-4"><strong>Colors:</strong></p>
                            <p><?php echo htmlspecialchars($detail['colors']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>Dimensions:</strong></p>
                            <p><?php echo htmlspecialchars($detail['sizes']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>RAM:</strong></p>
                            <p><?php echo htmlspecialchars($detail['ram']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>Storage:</strong></p>
                            <p><?php echo htmlspecialchars($detail['rom']); ?></p>
                        </div>
                        <div class="row">
                            <p class="col-4"><strong>Bluetooth:</strong></p>
                            <p><?php echo htmlspecialchars($detail['bluetooth']); ?></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="error-message">
                    <p>Technical Specifications not found</p>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <!-- Tab Reviews -->
    <div class="tab-pane fade show active" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
        <div class="review-section container py-4">
            <!-- Average Rating Section -->
            <div class="row mb-4">
                <div class="col-md-4 text-center">
                    <h4>Average Rating</h4>
                    <div class="display-4 font-weight-bold text-warning mb-2">
                        <?= number_format($ratingInfo['rating'], 1) ?>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="rating-stars mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?= $i <= round($ratingInfo['rating']) ? 'text-warning' : 'text-muted' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="text-muted"><?= $ratingInfo['count'] ?> reviews</div>
                </div>
                
                <!-- Phần phân phối đánh giá -->
                <div class="col-md-8">
                    <div class="rating-bars">
                        <?php
                        $ratingDistribution = $reviewModel->getRatingDistribution($product_id);
                        for ($i = 5; $i >= 1; $i--):
                            $count = $ratingDistribution[$i] ?? 0;
                            $percent = $ratingInfo['count'] > 0 ? ($count / $ratingInfo['count'] * 100) : 0;
                        ?>
                        <div class="rating-bar">
                            <span class="rating-label"><?= $i ?> sao</span>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: <?= $percent ?>%"></div>
                            </div>
                            <span class="rating-count"><?= $count ?></span>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Form -->
        <?php if ($canReview): ?>
            <div class="review-form card mb-4">
                <div class="card-body">
                    <h4>Write Your Review</h4>                    
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['success_message']); ?>
                            <?php unset($_SESSION['success_message']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['error_message']); ?>
                            <?php unset($_SESSION['error_message']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="index.php?act=product-review" id="reviewForm">
                        <input type="hidden" name="id" value="<?= $product_id ?>">
                        <div class="form-group mb-3">
                            <label>Rating:</label>
                            <div class="star-rating">
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <input type="radio" id="star<?= $i ?>" name="review_category" value="<?= $i ?>" required/>
                                        <label for="star<?= $i ?>">★</label>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Review Content:</label>
                            <textarea name="review_content" class="form-control" required 
                                    minlength="10" rows="4" 
                                    placeholder="Share your experience with this product..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <?php if (!$isLoggedIn): ?>
                <div class="alert alert-warning">
                    Please <a href="index.php?act=login">login</a> to review this product.
                </div>
            <?php elseif ($purchaseCount == 0): ?>
                <div class="alert alert-info">
                    You need to purchase this product to write a review.
                </div>
            <?php elseif ($purchaseCount <= $reviewCount): ?>
                <div class="alert alert-success">
                    You have already reviewed this product. Thank you for your feedback!
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Review List -->
        <div class="reviews">
            <div class="review-heading d-flex align-items-center justify-content-between mb-4">
                <h3 class="title">Customer Reviews</h3>
                <div class="select-custom">
                    <select name="review-sort" id="review-sort" class="form-control">
                        <option value="latest" <?= $sort === 'latest' ? 'selected' : '' ?>>Latest</option>
                        <option value="rating-desc" <?= $sort === 'rating-desc' ? 'selected' : '' ?>>Highest Rating</option>
                        <option value="rating-asc" <?= $sort === 'rating-asc' ? 'selected' : '' ?>>Lowest Rating</option>
                        <option value="helpful" <?= $sort === 'helpful' ? 'selected' : '' ?>>Most Helpful</option>
                    </select>
                </div>
            </div>

            <div id="reviews-container">
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="review-item" data-review-id="<?= $review['review_id'] ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="user-info">
                                        <div class="avatar">
                                            <i class="la la-user-circle"></i>
                                        </div>
                                        <div class="reviewer-name">
                                            <?= htmlspecialchars($review['user_full_name'] ?? $review['user_name']) ?>
                                        </div>
                                        <div class="reviewer-email">
                                            <?= htmlspecialchars($review['review_userEmail']) ?>
                                        </div>
                                        <div class="review-date">
                                            <i class="la la-clock"></i>
                                            <?= date('d/m/Y H:i', strtotime($review['review_dateTime'])) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="review-content-wrapper">
                                    <div class="ratings-container mb-3">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: <?= ($review['review_category']/5)*77 ?>%;"></div>
                                            </div>
                                            <span class="ratings-text"><?= $review['review_category'] ?> sao</span>
                                        </div>
                                        <div class="review-content">
                                            <?= nl2br(htmlspecialchars($review['review_content'])) ?>
                                        </div>
                                        <div class="review-actions">
                                            <button type="button" 
                                                    class="vote-btn <?php echo (isset($userVotes[$review['review_id']]) && $userVotes[$review['review_id']] === 'like') ? 'active' : ''; ?>" 
                                                    onclick="handleVote(this, <?= $review['review_id'] ?>, 'like')"
                                                    data-review-id="<?= $review['review_id'] ?>" 
                                                    data-type="like">
                                                <i class="la la-thumbs-up"></i>
                                                <span class="vote-count"><?= $review['helpful'] ?? 0 ?></span>
                                            </button>
                                            <button type="button" 
                                                    class="vote-btn <?php echo (isset($userVotes[$review['review_id']]) && $userVotes[$review['review_id']] === 'dislike') ? 'active' : ''; ?>" 
                                                    onclick="handleVote(this, <?= $review['review_id'] ?>, 'dislike')"
                                                    data-review-id="<?= $review['review_id'] ?>" 
                                                    data-type="dislike">
                                                <i class="la la-thumbs-down"></i>
                                                <span class="vote-count"><?= $review['unhelpful'] ?? 0 ?></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No reviews yet for this product.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
window.votes = JSON.parse(localStorage.getItem('reviewVotes') || '{}');

document.addEventListener('DOMContentLoaded', function () {
    initializeVotes();

    const stars = document.querySelectorAll('.star-rating input[type="radio"]');
    const labels = document.querySelectorAll('.star-rating label');

    stars.forEach((star, index) => {
        star.addEventListener('change', function () {
            const rating = this.value;
            labels.forEach((label, i) => {
                label.style.color = i < rating ? '#f8b739' : '#bbb';
            });
        });
    });

    const reviewSort = document.getElementById('review-sort');
    if (reviewSort) {
        reviewSort.addEventListener('change', function () {
            const sortType = this.value;
            const productId = <?= $product_id ?>;

            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', sortType);
            window.location.href = currentUrl.toString();
        });
    }
});

function initializeVotes() {
    if (isLoggedIn) {
        fetch('index.php?act=get-user-votes')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.votes = data.data;
                    updateVoteButtons();
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

function updateVoteButtons() {
    document.querySelectorAll('.vote-btn').forEach(button => {
        const reviewId = button.dataset.reviewId;
        const type = button.dataset.type;
        if (window.votes[reviewId] === type) {
            button.classList.add('active');
        }
    });
}

window.handleVote = function (button, reviewId, type) {
    if (!isLoggedIn) {
        alert('Please login to perform this action');
        return;
    }

    const currentVote = window.votes[reviewId];
    const actionBlock = button.closest('.review-actions');
    const oppositeType = type === 'like' ? 'dislike' : 'like';
    const oppositeButton = actionBlock.querySelector(`[data-type="${oppositeType}"]`);

    let action;
    if (currentVote === type) {
        action = 'remove';
        delete window.votes[reviewId];
        button.classList.remove('active');
    } else {
        action = 'add';
        window.votes[reviewId] = type;
        button.classList.add('active');
        if (oppositeButton) oppositeButton.classList.remove('active');
    }

    sendVoteToServer(reviewId, type, action)
        .then(response => {
            if (response.success && response.data) {
                button.querySelector('.vote-count').textContent = response.data[type === 'like' ? 'helpful' : 'unhelpful'];
                if (oppositeButton) {
                    oppositeButton.querySelector('.vote-count').textContent = response.data[type === 'like' ? 'unhelpful' : 'helpful'];
                }
                localStorage.setItem('reviewVotes', JSON.stringify(window.votes));
            } else {
                rollbackVoteUI(button, currentVote, oppositeButton);
                alert(response.error || 'Có lỗi xảy ra');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            rollbackVoteUI(button, currentVote, oppositeButton);
            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
        });
};

function rollbackVoteUI(button, currentVote, oppositeButton) {
    const reviewId = button.dataset.reviewId;
    if (currentVote) {
        window.votes[reviewId] = currentVote;
        button.classList.remove('active');
        if (currentVote === button.dataset.type) {
            button.classList.add('active');
        } else if (oppositeButton) {
            oppositeButton.classList.add('active');
        }
    } else {
        delete window.votes[reviewId];
        button.classList.remove('active');
    }
}

window.sendVoteToServer = function (reviewId, voteType, action) {
    const formData = new FormData();
    formData.append('reviewId', reviewId);
    formData.append('voteType', voteType);
    formData.append('action', action);

    return fetch('index.php?act=handle-review-vote', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .catch(error => {
        console.error('Error:', error);
        throw error;
    });
};

</script>

<style>
/* CSS cho phần đánh giá trung bình */
.review-section {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    max-width: 100%;
    overflow-x: hidden;
    padding: 20px;
}

.rating-stars i {
    font-size: 24px;
    margin: 0 2px;
}

.rating-bars {
    padding: 10px 0;
    max-width: 100%;
}

.rating-bar {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    padding: 0 15px;
}

.rating-label {
    min-width: 45px;
    margin-right: 10px;
    font-size: 14px;
}

.rating-count {
    min-width: 30px;
    margin-left: 10px;
    font-size: 14px;
}

.progress {
    flex-grow: 1;
    height: 8px;
    background-color: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    transition: width 0.3s ease;
}

/* CSS cho form đánh giá */
.star-rating {
    display: inline-block;
    padding: 20px;
}

.star-rating input[type="radio"] {
    display: none;
}

.star-rating label {
    color: #bbb;
    font-size: 2rem;
    padding: 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.stars {
    display: inline-flex;
    flex-direction: row;
}

.stars label {
    margin: 0 2px;
}

.stars label:hover,
.stars label:hover ~ label {
    color: #f8b739;
}

.stars input[type="radio"]:checked ~ label {
    color: #f8b739;
}

.stars label:hover ~ label {
    color: #bbb !important;
}

.stars:hover label {
    color: #f8b739;
}

/* CSS cho danh sách đánh giá */
.reviews {
    margin-top: 30px;
}

.review-heading {
    margin-bottom: 20px;
}

.select-custom {
    position: relative;
    min-width: 180px;
}

.select-custom select {
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 8px 12px;
    width: 100%;
    appearance: none;
    background: #fff url('data:image/svg+xml;utf8,<svg fill="%23333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 8px center;
}

.review-item {
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #eee;
    border-radius: 8px;
    background: #fff;
    transition: box-shadow 0.3s ease;
}

.user-info {
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
    margin-bottom: 10px;
}

.avatar i {
    font-size: 48px;
    color: #666;
}

.reviewer-name {
    font-weight: 600;
    color: #333;
    margin: 5px 0;
}

.reviewer-email {
    font-size: 13px;
    color: #666;
    margin-bottom: 5px;
}

.review-date {
    color: #999;
    font-size: 13px;
    margin-top: 5px;
}

.review-date i {
    margin-right: 5px;
}

.ratings-container {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.ratings {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 20px;
    background: url('path/to/star-empty.svg') repeat-x;
}

.ratings-val {
    position: absolute;
    height: 100%;
    background: url('path/to/star-full.svg') repeat-x;
    background-size: 20px 20px;
    width: calc(var(--rating, 0) * 20%);

}


.review-content {
    margin: 15px 0;
    line-height: 1.6;
    font-size: 14px; /* Kích thước mặc định */
}

.review-content:focus,
.review-content::selection {
    font-size: 16px; /* Tăng kích thước khi được select */
    background-color: #f0f8ff; /* Màu nền khi select */
    transition: all 0.2s ease;
}

/* CSS cho nút vote */
.vote-btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 15px;
    margin-right: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s;
}

.vote-btn:hover {
    background: #f5f5f5;
}

.vote-btn.active {
    background-color: #007bff;
    color: white;
}

.vote-btn.active i {
    color: white;
}

.vote-btn i {
    margin-right: 5px;
    font-size: 18px;
}

.vote-count {
    font-weight: bold;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .review-item .row {
        flex-direction: column;
    }
    
    .user-info {
        margin-bottom: 15px;
    }
    
    .select-custom {
        width: 100%;
        margin-top: 10px;
    }
}
</style>
<script>
    const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.isLoggedIn) {
            fetch('index.php?act=get-user-votes')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Object.keys(data.data).forEach(reviewId => {
                            window.votes[reviewId] = {
                                userVote: data.data[reviewId],
                                like: data.data[reviewId] === 'like' ? 1 : 0,
                                dislike: data.data[reviewId] === 'dislike' ? 1 : 0
                            };
                        });
                        localStorage.setItem('reviewVotes', JSON.stringify(window.votes));
                        updateVoteButtons();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>