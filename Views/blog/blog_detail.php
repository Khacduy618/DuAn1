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
                <div class="row">
                    <div class="col-lg-9">
                        <article class="entry single-entry">
                            <figure class="entry-media">
                                <img src="assets/site/images/blog/<?= $content_blog['blog_image'] ?>">
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

                                <div class="entry-content editor-content">
                                    <?php
                                echo $content_blog['blog_content']
                                 ?>

                                    <div class="col-md-auto mt-2 mt-md-0">
                                        <div class="social-icons social-icons-color">
                                            <span class="social-label">Share this post:</span>
                                            <a href="#" class="social-icon social-facebook" title="Facebook"
                                                target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon social-twitter" title="Twitter"
                                                target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon social-pinterest" title="Pinterest"
                                                target="_blank"><i class="icon-pinterest"></i></a>
                                            <a href="#" class="social-icon social-linkedin" title="Linkedin"
                                                target="_blank"><i class="icon-linkedin"></i></a>
                                        </div><!-- End .soial-icons -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .entry-footer row no-gutters -->
                            </div><!-- End .entry-body -->

                            <div class="entry-author-details">
                                <figure class="author-media">
                                    <a href="#">
                                        <img src="assets/site/images/blog/single/author.jpg" alt="User name">
                                    </a>
                                </figure><!-- End .author-media -->

                                <div class="author-body">
                                    <div class="author-header row no-gutters flex-column flex-md-row">
                                        <div class="col">
                                            <h4><a href="#">John Doe</a></h4>
                                        </div><!-- End .col -->
                                        <div class="col-auto mt-1 mt-md-0">
                                            <a href="#" class="author-link">View all posts by John Doe <i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .col -->
                                    </div><!-- End .row -->

                                    <div class="author-content">
                                        <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae,
                                            eu vulputate magna eros eu erat. Aliquam erat volutpat. </p>
                                    </div><!-- End .author-content -->
                                </div><!-- End .author-body -->
                            </div><!-- End .entry-author-details-->
                        </article><!-- End .entry -->

                        <nav class="pager-nav" aria-label="Page navigation">
                            <a class="pager-link pager-link-prev" href="#" aria-label="Previous" tabindex="-1">
                                Previous Post
                                <span class="pager-link-title">Cras iaculis ultricies nulla</span>
                            </a>

                            <a class="pager-link pager-link-next" href="#" aria-label="Next" tabindex="-1">
                                Next Post
                                <span class="pager-link-title">Praesent placerat risus</span>
                            </a>
                        </nav><!-- End .pager-nav -->

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
                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="assets/site/images/blog/grid/3cols/post-1.jpg" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">Nov 22, 2018</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">2 Comments</a>
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="single.html">Cras ornare tristique elit.</a>
                                        </h2><!-- End .entry-title -->

                                        <div class="entry-cats">
                                            in <a href="#">Lifestyle</a>,
                                            <a href="#">Shopping</a>
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->

                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="assets/site/images/blog/grid/3cols/post-2.jpg" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">Nov 21, 2018</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">0 Comments</a>
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="single.html">Vivamus ntulla necante.</a>
                                        </h2><!-- End .entry-title -->

                                        <div class="entry-cats">
                                            in <a href="#">Lifestyle</a>
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->

                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="assets/site/images/blog/grid/3cols/post-3.jpg" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">Nov 18, 2018</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">3 Comments</a>
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="single.html">Utaliquam sollicitudin leo.</a>
                                        </h2><!-- End .entry-title -->

                                        <div class="entry-cats">
                                            in <a href="#">Fashion</a>,
                                            <a href="#">Lifestyle</a>
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->

                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="assets/site/images/blog/grid/3cols/post-4.jpg" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">Nov 15, 2018</a>
                                            <span class="meta-separator">|</span>
                                            <a href="#">4 Comments</a>
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="single.html">Fusce pellentesque suscipit.</a>
                                        </h2><!-- End .entry-title -->

                                        <div class="entry-cats">
                                            in <a href="#">Travel</a>
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->
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

                                <form action="#">
                                    <label for="ws" class="sr-only">Search in blog</label>
                                    <input type="search" class="form-control" name="ws" id="ws"
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
                                    <img src="assets/site/images/blog/sidebar/' . $post["blog_image"] . '" alt="post">
                                            </a>
                                            </figure>
                                            <div>
                                            <h4><a href="?act=blog_detail&id_blog=' . $post["blog_id"] . '">' . $post["blog_title"] . '</a></h4>
                                            </div>
                                            </li>' ; } ?>
                                </ul><!-- End .posts-list -->
                            </div><!-- End .widget -->




                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->