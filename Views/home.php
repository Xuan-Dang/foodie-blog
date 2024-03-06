    <?php include "Views/inc/header.php" ?>
    <!-- banner blog section -->
    <section class="w3l-banner-blog py-3">
        <div class="w3l-main-blog py-4">
            <div class="owl-blog owl-carousel owl-theme">
                <?php if (isset($hotPosts)) : ?>
                    <?php foreach ($hotPosts as $index => $post) : ?>
                        <div class="item">
                            <div class="news-img position-relative">
                                <a href="blog-single.html">
                                    <img src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" alt="<?php echo htmlspecialchars($post["img_alt"]) ?>" title="<?php echo htmlspecialchars($post["img_title"]) ?>" loading="lazy" class="img-fluid img-responsive">
                                </a>
                                <div class="title-wrap">
                                    <h4 class="title"><a href="blog-single.html"><?php echo htmlspecialchars($post["post_name"]) ?></a></h4>
                                    <ul class="admin-list mt-2 mb-4">
                                        <li>
                                            <a href="#blog">
                                                <i class="far fa-user"></i><?php echo htmlspecialchars($post["username"]) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#blog">
                                                <i class="far fa-comment-dots"></i>9 Comments
                                            </a>
                                        </li>
                                    </ul>
                                    <p><?php echo htmlspecialchars($post["post_description"]) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- //banner blog section -->

    <!-- 3 col section -->
    <section class="w3l-blog-sec py-3">
        <div class="container">
            <div class="row justify-content-center">
                <?php if (isset($newPosts)) : ?>
                    <?php foreach ($newPosts as $index => $post) : ?>
                        <div class="col-xl-4 col-md-6 my-2">
                            <div class="blog-info">
                                <div class="position-relative">
                                    <a href="#blog">
                                        <img class="img-fluid" src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" alt="<?php echo htmlspecialchars($post["img_alt"]) ?>" title="<?php echo htmlspecialchars($post["img_title"]) ?>" loading="lazy" />
                                    </a>
                                    <a href="blog-single.html" class="category-style"><?php echo htmlspecialchars($post["cat_name"]) ?></a>
                                </div>
                                <div class="title-wrap title-wrap-2">
                                    <h4 class="title"><a href="#blog"><?php echo htmlspecialchars($post["post_name"]) ?></a></h4>
                                    <ul class="admin-list mt-2 mb-4">
                                        <li><a href="#blog"><i class="far fa-user"></i><?php echo htmlspecialchars($post["username"]) ?>
                                            </a></li>
                                        <li><a href="#blog"><i class="far fa-comment-dots"></i>9 Comments</a>
                                        </li>
                                    </ul>
                                    <p><?php echo htmlspecialchars($post["post_description"]) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- //3 col section -->
    <?php include "Views/inc/footer.php" ?>