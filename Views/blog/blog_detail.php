<?php
    
    ?>
     <main class="main">
         <div class="page-header text-center" style="background-image: url('assets/site/images/page-header-bg.jpg')">
             <div class="container">
                 <h1 class="page-title"><?=$content_blog['blog_title']?></span></h1>
             </div>
         </div>
         <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
             <div class="container">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                     <li class="breadcrumb-item"><a href="#">Blog</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Default With Sidebar</li>
                 </ol>
             </div>
         </nav>
         <div class="page-content">
             <div class="container">
                 <div class="row g-0">
                     <div class="col-lg-9">
                         <article class="entry single-entry">
                             <figure class="entry-media">
                                 <img src="uploaded/<?= $content_blog['blog_image'] ?>">
                             </figure>
 
                             <div class="entry-body">
                                 <div class="entry-meta">
                                     <span class="entry-author">
                                         by <a href="#">John Doe</a>
                                     </span>
                                     <span class="meta-separator">|</span>
                                     <a href="#">Nov 22, 2018</a>
                                     <span class="meta-separator">|</span>
                                     <a href="#">2 Comments</a>
                                 </div><!-- End .entry-meta -->
 
                                 <h2 class="entry-title">
                                     Cras ornare tristique elit.
                                 </h2><!-- End .entry-title -->
 
                                 <div class="entry-cats">
                                     in <a href="#">Lifestyle</a>,
                                     <a href="#">Shopping</a>
                                 </div><!-- End .entry-cats -->
                                 <div class="entry-content">
 
                                     <?php echo $content_blog['blog_content']; ?>
 
                                     <div class="col-md-auto mt-2 mt-md-0">
                                         <div class="social-icons social-icons-color">
                                             <span class="social-label">Share this post:</span>
                                             <a href="#" class="social-icon social-facebook" title="Facebook"
                                                 target="_blank">
                                                 <i class="icon-facebook-f"></i>
                                             </a>
                                             <a href="#" class="social-icon social-twitter" title="Twitter"
                                                 target="_blank">
                                                 <i class="icon-twitter"></i>
                                             </a>
                                             <a href="#" class="social-icon social-pinterest" title="Pinterest"
                                                 target="_blank">
                                                 <i class="icon-pinterest"></i>
                                             </a>
                                             <a href="#" class="social-icon social-linkedin" title="Linkedin"
                                                 target="_blank">
                                                 <i class="icon-linkedin"></i>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
 
                                 <div class="entry-author-details">
                         </article><!-- End .entry -->
 
                         <!-- <nav class="pager-nav" aria-label="Page navigation">
                             <a class="pager-link pager-link-prev" href="#" aria-label="Previous" tabindex="-1">
                                 Previous Post
                                 <span class="pager-link-title">Cras iaculis ultricies nulla</span>
                             </a>
 
                             <a class="pager-link pager-link-next" href="#" aria-label="Next" tabindex="-1">
                                 Next Post
                                 <span class="pager-link-title">Praesent placerat risus</span>
                             </a>
                         </nav>End .pager-nav -->
 
                         <div class="related-posts">
                             <h3 class="title">Related Posts</h3><!-- End .title -->
 
                             <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                                         "nav": false, 
                                         "dots": true,
                                         "margin": 20,
                                         "loop": false,
                                         "responsive": {
                                             "0": {
                                                 "items":1
                                             },
                                             "480": {
                                                 "items":2
                                             },
                                             "768": {
                                                 "items":3
                                             }
                                         }
                                     }'>
                                 <?php  foreach($related_blogs as $related_blog ){ ?>
                                 <article class="entry entry-grid">
                                     <figure class="entry-media">
                                         <a href="?act=blog_detail&id_blog=<?=$related_blog['blog_id']?>">
                                             <img src="uploaded /<?=$related_blog['blog_image']?>" alt="image desc">
                                         </a>
                                     </figure><!-- End .entry-media -->
 
                                     <div class="entry-body">
                                         <div class="entry-meta">
                                             <a href="?act=blog_detail&id_blog=<?=$related_blog['blog_id']?>">
                                                 <?=$related_blog['author_email']?>
                                             </a>
                                             <span class="meta-separator">|</span>
                                         </div><!-- End .entry-meta -->
 
                                         <h2 class="entry-title">
                                             <a
                                                 href="?act=blog_detail&id_blog=<?=$related_blog['blog_id']?>"><?=$related_blog['blog_title']?></a>
                                         </h2><!-- End .entry-title -->
 
                                         <div class="entry-cats">
                                             <p>Blog view : <?=$related_blog['blog_view']?></p>
                                         </div><!-- End .entry-cats -->
                                     </div><!-- End .entry-body -->
                                 </article><!-- End .entry -->
                                 <?php } ?>
 
 
 
 
 
                             </div><!-- End .owl-carousel -->
                             <br>
                             <div class="widget widget-text">
                                 <h3 class="title">Related Products</h3><!-- End .title -->
 
                             </div>
                             <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                                 data-toggle="owl" data-owl-options='{
                     "nav": true, 
                     "dots": true,
                     "margin": 20,
                     "loop": false,
                     "responsive": {
                         "0": {
                             "items":2
                         },
                         "600": {
                             "items":2
                         },
                         "992": {
                             "items":3
                         },
                         "1200": {
                             "items":4
                         }
                     }
                 }'>
                                 <?php 
                     if(isset($related_products) && $related_products != NULL){
                         foreach($related_products as $item){
                     
                 ?>
 
                                 <div class="product product-2">
                                     <figure class="product-media">
                                         <span class="product-label label-circle label-new">New</span>
                                         <a href="?act=product&id=<?=$item['product_id']?>">
                                             <img src="uploaded/<?=$item['product_img']?>" alt="Product image"
                                                 class="product-image">
                                         </a>
 
                                         <div class="product-action-vertical">
                                             <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                     to
                                                     wishlist</span></a>
                                         </div><!-- End .product-action -->
 
                                         <div class="product-action product-action-dark">
                                             <a href="?act=cart&xuli=add&product_id=<?=$item['product_id']?>&quantity=1" class="btn-product btn-cart" title="Add to cart"><span>add
                                                     to cart</span></a>
                                             <a href="popup/quick_view.php" class="btn-product btn-quickview"
                                                 title="Quick view"><span>quick view</span></a>
                                         </div><!-- End .product-action -->
                                     </figure><!-- End .product-media -->
 
                                     <div class="product-body">
                                         <h3 class="product-title"><a href="#"><?=$item['product_name'];?> </a></h3>
                                         <!-- End .product-title -->
                                         <div class="product-price">
                                             <?=number_format($item['product_price'],0,",",".")?> đ
                                         </div><!-- End .product-price -->
                                         <div class="ratings-container">
                                             <div class="ratings">
                                                 <div class="ratings-val" style="width: 80%;"></div>
                                                 <!-- End .ratings-val -->
                                             </div><!-- End .ratings -->
                                             <span class="ratings-text">( 4 Reviews )</span>
                                         </div><!-- End .rating-container -->
 
                                         <div class="product-nav product-nav-dots">
                                             <a href="#" style="background: #edd2c8;"><span class="sr-only">Color
                                                     name</span></a>
                                             <a href="#" style="background: #eaeaec;"><span class="sr-only">Color
                                                     name</span></a>
                                             <a href="#" class="active" style="background: #333333;"><span
                                                     class="sr-only">Color
                                                     name</span></a>
                                         </div><!-- End .product-nav -->
                                     </div><!-- End .product-body -->
                                 </div><!-- End .product -->
                                 <?php
             }}else{
             echo "No data found";
             }
             ?>
                             </div><!-- End .owl-carousel -->
 
 
 
 
                         </div><!-- End .related-posts -->
 
                         <div class="comments">
 
 
                             <ul>
                                 <!-- comment-user-->
                                 <?php
                                  
                                 foreach($comments as $comment){
                                  ?>
 
                                 <li>
                                     <div class="comment">
                                         <figure class="comment-media">
                                             <a href="#">
                                                 <img src="uploaded/<?= $comment['user_images'] ?>">
                                             </a>
                                         </figure>
                                         <div class="comment-body">
                                             <div class="comment-user">
                                                 <h4><a href="#"><?= $comment['user_name'] ?></a></h4>
                                                 <span class="comment-date"><?= $comment['comment_dateTime'] ?></span>
                                             </div><!-- End .comment-user -->
 
                                             <div class="comment-content">
                                                 <p><?= $comment['comment_content'] ?></p>
                                             </div><!-- End .comment-content -->
                                         </div><!-- End .comment-body -->
                                     </div><!-- End .comment -->
                                 </li>
                                 <?php } ?>
                                 <!-- comment-user-->
 
                             </ul>
                         </div><!-- End .comments -->
                         <div class="reply">
                             <div class="heading">
                                 <h3 class="title">Leave A Reply</h3><!-- End .title -->
                                 <p class="title-desc">Your email address will not be published. Required fields are
                                     marked *</p>
                             </div><!-- End .heading -->
 
 
                             <?php if(isset($_SESSION['login'])) {?>
                             <form action="?act=comment" method="post">
                                 <input type="hidden" name="blog_id" value="<?=$id?>">
                                 <label for="reply-message" name="comment_content" class="sr-only">Comment</label>
                                 <textarea name="message" id="reply-message" cols="30" rows="4" class="form-control"
                                     required placeholder="Comment *"></textarea>
                                 <!-- End .row -->
                                 <button type="submit" class="btn btn-outline-primary-2">
                                     <span>POST COMMENT</span>
                                     <i class="icon-long-arrow-right"></i>
                                 </button>
                             </form>
                             <?php
                             } else {?>
                             <p>Please <a href="?act=taikhoan">Login</a> to comment.</p>
                             <?php }?>
 
                         </div><!-- End .reply -->
                     </div><!-- End .col-lg-9 -->
 
                     <aside class="col-lg-3">
                         <div class="sidebar">
                             <div class="widget widget-search">
                                 <h3 class="widget-title">Search</h3><!-- End .widget-title -->
 
                                 <form action="?act=blog" method="post">
                                     <label for="ws" class="sr-only">Search in blog</label>
                                     <input type="search" class="form-control" name="key_word" id="ws"
                                         placeholder="Search in blog" required>
                                     <button type="submit" class="btn"><i class="icon-search"></i><span
                                             class="sr-only">Search</span></button>
                                 </form>
                             </div><!-- End .widget -->
 
 
                             <div class="widget">
                                 <h3 class="widget-title">Popular Posts</h3><!-- End .widget-title -->
 
                                 <ul class="posts-list">
                                     <?php
                                             foreach($popular_posts as $post) {
                                             echo '<li>
                                             <figure>
                                             <a href="?act=blog_detail&id_blog=' . $post["blog_id"] . '">
                                     <img src="uploaded/' . $post["blog_image"] . '" alt="post">
                                             </a>
                                             </figure>
                                             <div>
                                             <h4><a href="?act=blog_detail&id_blog=' . $post["blog_id"] . '">' . $post["blog_title"] . '</a></h4>
                                             </div>
                                             </li>' ; } ?>
                                 </ul><!-- End .posts-list -->
                             </div><!-- End .widget -->
                             <div class="widget widget-text">
                                 <h1 class="widget-title">Best Seller Products</h1><!-- End .widget-title -->
 
                             </div>
                             <?php 
                     if(isset($product_populars) && $product_populars != NULL){
                         foreach($product_populars as $item){
                     
                 ?>
 
                             <div class="product product-2">
                                 <figure class="product-media">
                                     <span class="product-label label-circle label-new">New</span>
                                     <a href="?act=product&id=<?=$item['product_id']?>">
                                         <img src="uploaded/<?=$item['product_img']?>" alt="Product image"
                                             class="product-image">
                                     </a>
 
                                     <div class="product-action-vertical">
                                         <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                 wishlist</span></a>
                                     </div><!-- End .product-action -->
 
                                     <div class="product-action product-action-dark">
                                         <a href="?act=cart&xuli=add&product_id=<?=$item['product_id']?>&quantity=1" class="btn-product btn-cart" title="Add to cart"><span>add
                                                 to cart</span></a>
                                         <a href="popup/quick_view.php" class="btn-product btn-quickview"
                                             title="Quick view"><span>quick view</span></a>
                                     </div><!-- End .product-action -->
                                 </figure><!-- End .product-media -->
 
                                 <div class="product-body">
 
                                     <h3 class="product-title"><a href="#"><?=$item['product_name'];?> </a></h3>
                                     <!-- End .product-title -->
                                     <div class="product-price">
                                         <?=number_format($item['product_price'],0,",",".")?> đ
                                     </div><!-- End .product-price -->
                                     <div class="ratings-container">
                                         <div class="ratings">
                                             <div class="ratings-val" style="width: 80%;"></div>
                                             <!-- End .ratings-val -->
                                         </div><!-- End .ratings -->
                                         <span class="ratings-text">( 4 Reviews )</span>
                                     </div><!-- End .rating-container -->
 
                                     <div class="product-nav product-nav-dots">
                                         <a href="#" style="background: #edd2c8;"><span class="sr-only">Color
                                                 name</span></a>
                                         <a href="#" style="background: #eaeaec;"><span class="sr-only">Color
                                                 name</span></a>
                                         <a href="#" class="active" style="background: #333333;"><span
                                                 class="sr-only">Color
                                                 name</span></a>
                                     </div><!-- End .product-nav -->
                                 </div><!-- End .product-body -->
                             </div><!-- End .product -->
                             <?php
             }}else{
             echo "No data found";
             }
             ?>
 
 
 
 
                         </div><!-- End .sidebar sidebar-shop -->
                     </aside><!-- End .col-lg-3 -->
                 </div><!-- End .row -->
             </div><!-- End .container -->
         </div><!-- End .page-content -->
     </main><!-- End .main -->