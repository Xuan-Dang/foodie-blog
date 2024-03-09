<div class="sidebar-side col-lg-4 pl-lg-5 mt-lg-0 mt-5">
    <aside class="sidebar">
        <!-- Popular Post Widget-->
        <div class="sidebar-widget popular-posts">
            <?php if (isset($sidebarData["posts"])) : ?>
                <div class="sidebar-title">
                    <h4>Recent Posts</h4>
                </div>
                <?php if (count($sidebarData["posts"]) > 0) : ?>
                    <?php foreach ($sidebarData["posts"] as $index => $post) : ?>
                        <article class="post">
                            <img src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" alt="<?php echo htmlspecialchars($post["img_alt"]) ?>" title="<?php echo htmlspecialchars($post["img_title"]) ?>">
                            <div class="text">
                                <a href="blog-single.html"><?php echo htmlspecialchars($post["p_name"]) ?></a>
                                <div class="post-info">
                                    <?php echo date_format(new DateTime(htmlspecialchars($post["p_created"])), "d/m/Y") ?></div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Không tìm thấy bài viết nào</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Category Widget -->
        <div class="sidebar-widget sidebar-blog-category">
            <ul class="blog-cat">
                <?php if (isset($sidebarData["categories"])) : ?>
                    <div class="sidebar-title">
                        <h4>Categories</h4>
                    </div>
                    <?php if (count($sidebarData["categories"]) > 0) : ?>
                        <?php foreach ($sidebarData["categories"] as $index => $category) : ?>
                            <li>
                                <a href="?controller=post&page=1&category=<?php echo htmlspecialchars($category["cat_id"]) ?>"><?php echo htmlspecialchars($category["cat_name"]) ?>
                                    <label><?php echo htmlspecialchars($category["post_count"]) ?></label>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Không tìm tháy danh mục sản phẩm nào</p>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>

        <!-- about Widget -->
        <div class="sidebar-widget about-widget">
            <?php if (isset($sidebarData["about"]) && count($sidebarData["about"]) > 0) : ?>
                <div class="sidebar-title">
                    <h4>About Us</h4>
                </div>
                <div class="d-flex">
                    <?php foreach ($sidebarData["about"] as $index => $value) : ?>
                        <div class="img-about-w3 mr-3">
                            <img src="Public/<?php echo htmlspecialchars($value["img"]) ?>" alt="" class="img-fluid" />
                        </div>
                        <div class="right-ab-block">
                            <h3><?php echo htmlspecialchars($value["name"]) ?></h3>
                            <p><?php echo htmlspecialchars($value["description"]) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- ads Widget -->
        <div class="sidebar-widget">
            <?php if (isset($sidebarData["ad"]) && count($sidebarData["ad"]) > 0) : ?>
                <?php foreach ($sidebarData["ad"] as $index => $value) : ?>
                    <div class="ads-img-ab">
                        <a href="blog.html"><img src="<?php echo htmlspecialchars($value["img"]) ?>" alt="<?php echo htmlspecialchars($value["img_alt"]) ?>" class="img-fluid" alt="" /></a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- social media Widget-->
        <div class="sidebar-widget social-style">
            <?php if (isset($sidebarData["socials"]) && count($sidebarData["socials"]) > 0) : ?>
                <div class="sidebar-title">
                    <h4>Social Media</h4>
                </div>
                <?php foreach ($sidebarData["socials"] as $index => $value) : ?>
                    <a href="<?php echo $value["url"] ?>"><i class="<?php echo $value["icon"] ?>"></i><?php echo $value["name"] ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </aside>
</div>