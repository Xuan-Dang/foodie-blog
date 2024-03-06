    <?php include "Views/inc/header.php" ?>
    <!-- inner banner -->
    <section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-sm-5 pt-4 pb-sm-4">
                <?php if(isset($pageTitle)): ?>
                    <h2 class="inner-text-title font-weight-bold pt-5"><?php echo htmlspecialchars($pageTitle) ?></h2>
                <?php endif; ?>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.html">Home</a></li>
                    <?php if(isset($pageTitle)): ?>
                        <li class="active"><span class="fa fa-chevron-right mx-2" aria-hidden="true"></span><?php echo htmlspecialchars($pageTitle) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->
    <div style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- blog page -->
    <section class="w3l-text-11 py-5">
        <div class="container py-md-5 py-4">
            <div class="row">
                <div class="col-lg-8 text11-content">
                    <div class="row">
                        <?php if (isset($posts)) : ?>
                            <?php foreach ($posts as $index => $post) : ?>
                                <div class="col-sm-6 card mt-sm-0 my-3">
                                    <div class="card-header p-0 position-relative border-0">
                                        <a href="blog-single.html">
                                            <img class="card-img-bottom d-block radius-image" src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" alt="<?php echo htmlspecialchars($post["img_alt"]) ?>" title="<?php echo htmlspecialchars($post["img_title"]) ?>" loading="lazy" />
                                        </a>
                                        <a href="blog-single.html" class="category-style"><?php echo htmlspecialchars($post["cat_name"]) ?></a>
                                    </div>
                                    <div class="title-wrap title-wrap-2">
                                        <h4 class="title"><a href="blog-single.html"><?php echo htmlspecialchars($post["post_name"]) ?></a></h4>
                                        <ul class="admin-list mt-2 mb-4">
                                            <li><a href="blog-single.html"><i class="far fa-user"></i><?php echo htmlspecialchars($post["username"]) ?>
                                                </a></li>
                                            <li><a href="blog-single.html"><i class="far fa-comment-dots"></i>3 Comments</a>
                                            </li>
                                        </ul>
                                        <p><?php echo htmlspecialchars($post["post_description"]) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- pagination -->
                    <?php if(isset($pagination)): ?>
                        <?php echo $pagination ?>
                    <?php endif; ?>
                </div>
                <div class="sidebar-side col-lg-4 pl-lg-5 mt-lg-0 mt-5">
                    <aside class="sidebar">
                        <!-- Popular Post Widget-->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title">
                                <h4>Recent Posts</h4>
                            </div>
                            <article class="post">
                                <img src="assets/images/blog-s1.jpg" alt="">
                                <div class="text">
                                    <a href="blog-single.html">Sed do eiusmod tempor ut </a>
                                    <div class="post-info">Feb 11, 2021</div>
                                </div>
                            </article>

                            <article class="post">
                                <img src="assets/images/blog-s2.jpg" alt="">
                                <div class="text">
                                    <a href="blog-single.html">Et dolore magna aliqua </a>
                                    <div class="post-info">Feb 22, 2021</div>
                                </div>

                            </article>

                            <article class="post">
                                <img src="assets/images/blog-s3.jpg" alt="">
                                <div class="text"><a href="blog-single.html">Amkmm Ut enim ad minim</a>
                                    <div class="post-info">Feb 13, 2021</div>
                                </div>
                            </article>

                            <article class="post">
                                <img src="assets/images/blog-s4.jpg" alt="">
                                <div class="text"><a href="blog-single.html">Amkmm Ut enim ad minim</a>
                                    <div class="post-info">Feb 14, 2021</div>
                                </div>
                            </article>
                        </div>

                        <!-- Category Widget -->
                        <div class="sidebar-widget sidebar-blog-category">
                            <div class="sidebar-title">
                                <h4>Categories</h4>
                            </div>
                            <ul class="blog-cat">
                                <li><a href="#link">Foodie
                                        <label>4</label></a></li>
                                <li><a href="#link">Cook
                                        <label>8</label></a></li>
                                <li><a href="#link"> Recipes
                                        <label>8</label></a></li>
                                <li><a href="#link"> Guides
                                        <label>3</label></a></li>
                            </ul>
                        </div>

                        <!-- about Widget -->
                        <div class="sidebar-widget about-widget">
                            <div class="sidebar-title">
                                <h4>About Us</h4>
                            </div>
                            <div class="d-flex">
                                <div class="img-about-w3 mr-3">
                                    <img src="assets/images/testi1.jpg" alt="" class="img-fluid" />
                                </div>
                                <div class="right-ab-block">
                                    <h3>Dee Zynah</h3>
                                    <p>Duis aute irure dolor in reprehenderit in esse cillum dolore.</p>
                                </div>
                            </div>
                        </div>

                        <!-- ads Widget -->
                        <div class="sidebar-widget">
                            <div class="sidebar-title">
                                <h4>Ads</h4>
                            </div>
                            <div class="ads-img-ab">
                                <a href="blog.html"><img src="assets/images/ads.jpg" class="img-fluid" alt="" /></a>
                            </div>
                        </div>
                        <!-- social media Widget-->
                        <div class="sidebar-widget social-style">
                            <div class="sidebar-title">
                                <h4>Social Media</h4>
                            </div>
                            <a href="#facebook"><i class="fab fa-facebook-f"></i>Facebook</a>
                            <a href="#twitter"><i class="fab fa-twitter"></i>Twitter</a>
                            <a href="#instagram"><i class="fab fa-instagram"></i>Instagram</a>
                            <a href="#googleplus"><i class="fab fa-google-plus-g"></i>Google Plus</a>
                            <a href="#youtube"><i class="fab fa-youtube"></i>Youtube</a>
                            <a href="#viemo"><i class="fab fa-vimeo-v"></i>Viemo</a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- //blog page -->
    <div style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <?php include "Views/inc/footer.php" ?>