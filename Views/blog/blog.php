<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/site/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog Classic<span>Blog</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Classic</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <!-- blog-post -->

                    <?php   
                            if ($blogs_content != null) {
                            foreach ($blogs_content as $blog){        
                    ?>

                    <article class="entry">
                        <figure class="entry-media">
                            <a href="?act=blog_detail&id_blog=<?=$blog['blog_id']?>">
                                <img src="uploaded/<?= $blog['blog_image'] ?>">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#"><?= $blog['author_email'] ?></a>
                                </span>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="?act=blog_detail&id_blog=<?=$blog['blog_id']?>"><?= $blog['blog_title'] ?></a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <a href="#">Lifestyle</a>,
                                <a href="#">Shopping</a>
                            </div><!-- End .entry-cats -->

                            <div class="entry-content">
                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget
                                    blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate
                                    volutpat, uctus metus libero eu augue.</p>
                                <a href="single.html" class="read-more">Continue Reading</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->

                    <?php } }
                    ?>

                    <!-- blog-post -->


                    <nav aria-label=" Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1"
                                    aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Search</h3><!-- End .widget-title -->

                            <form action="#">
                                <label for="ws" class="sr-only">Search in blog</label>
                                <input type="search" class="form-control" name="ws" id="ws" placeholder="Search in blog"
                                    required>
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
                            <h3 class="widget-title">About Blog</h3><!-- End .widget-title -->

                            <div class="widget-text-content">
                                <p>Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, pulvinar nunc
                                    sapien ornare nisl.</p>
                            </div><!-- End .widget-text-content -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->