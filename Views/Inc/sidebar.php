<div class="sidebar-side col-lg-4 pl-lg-5 mt-lg-0 mt-5">
    <aside class="sidebar">
        <!-- Popular Post Widget-->
        <div class="sidebar-widget popular-posts">
            <div class="sidebar-title">
                <h4>Recent Posts</h4>
            </div>
            <?php if (isset($newestPosts)) : ?>
                <?php foreach ($newestPosts as $index => $post) : ?>
                    <article class="post">
                        <img src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" alt="<?php echo htmlspecialchars($post["img_alt"]) ?>" title="<?php echo htmlspecialchars($post["img_title"]) ?>">
                        <div class="text">
                            <a href="blog-single.html"><?php echo htmlspecialchars($post["p_name"]) ?></a>
                            <div class="post-info"><?php echo date_format(new DateTime(htmlspecialchars($post["p_created"])), "d/m/Y") ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Category Widget -->
        <div class="sidebar-widget sidebar-blog-category">
            <div class="sidebar-title">
                <h4>Categories</h4>
            </div>
            <ul class="blog-cat">
                <?php if (isset($categories)) : ?>
                    <?php foreach ($categories as $index => $category) : ?>
                        <li>
                            <a href="?controller=post&page=1&category=<?php echo htmlspecialchars($category["cat_id"]) ?>"><?php echo htmlspecialchars($category["cat_name"]) ?>
                                <label><?php echo htmlspecialchars($category["post_count"]) ?></label>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
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