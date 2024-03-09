    <?php include "Views/inc/header.php" ?>
    <!-- inner banner -->
    <section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-sm-5 pt-4 pb-sm-4">
                <?php if (isset($pageTitle)) : ?>
                    <h2 class="inner-text-title font-weight-bold pt-5"><?php echo htmlspecialchars($pageTitle) ?></h2>
                <?php endif; ?>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.html">Home</a></li>
                    <?php if (isset($pageTitle)) : ?>
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
                                        <a href="?controller=post&action=show&url=<?php echo htmlspecialchars($post["post_url"]) ?>&id=<?php echo htmlspecialchars($post["post_id"]) ?>">
                                            <img class="card-img-bottom d-block radius-image" src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" alt="<?php echo htmlspecialchars($post["img_alt"]) ?>" title="<?php echo htmlspecialchars($post["img_title"]) ?>" loading="lazy" />
                                        </a>
                                        <a href="?controller=post&action=show&url=<?php echo htmlspecialchars($post["post_url"]) ?>&id=<?php echo htmlspecialchars($post["post_id"]) ?>" class="category-style"><?php echo htmlspecialchars($post["cat_name"]) ?></a>
                                    </div>
                                    <div class="title-wrap title-wrap-2">
                                        <h4 class="title"><a href="?controller=post&action=show&url=<?php echo htmlspecialchars($post["post_url"]) ?>&id=<?php echo htmlspecialchars($post["post_id"]) ?>"><?php echo htmlspecialchars($post["post_name"]) ?></a></h4>
                                        <ul class="admin-list mt-2 mb-4">
                                            <li><a href="?controller=posts&user=1"><i class="far fa-user"></i><?php echo htmlspecialchars($post["username"]) ?>
                                                </a></li>
                                            <li><a href="?controller=posts&user=1"><i class="far fa-comment-dots"></i>3 Comments</a>
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
                    <?php if (isset($pagination)) : ?>
                        <?php echo $pagination ?>
                    <?php endif; ?>
                </div>
                <?php include "Views/inc/sidebar.php" ?>
            </div>
        </div>
    </section>
    <!-- //blog page -->
    <div style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <?php include "Views/inc/footer.php" ?>