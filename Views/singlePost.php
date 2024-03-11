<?php
if (isset($post)) {
    $pageTitle = htmlspecialchars($post["p_name"]);

    $metaDescription = htmlspecialchars($post["p_desc"]);
}
?>
<?php include "Views/inc/header.php" ?>
<!-- inner banner -->
<section class="inner-banner py-5" style="background-image: url('Public/<?php echo htmlspecialchars($post["img_url"]) ?>')">
    <div class="w3l-breadcrumb py-lg-5">
        <div class="container pt-sm-5 pt-4 pb-sm-4">
            <h1 class="inner-text-title font-weight-bold py-3"><?php echo htmlspecialchars($post["p_name"]) ?></h1>
            <ul class="breadcrumbs-custom-path">
                <li><a href="?controller=index">Home</a></li>
                <li class="active"><span class="fa fa-chevron-right mx-2" aria-hidden="true"></span><?php echo htmlspecialchars($post["p_name"]) ?>
                </li>
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
    <div class="text11 py-md-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text11-content">
                    <img src="Public/<?php echo htmlspecialchars($post["img_url"]) ?>" class="img-fluid radius-image" alt="">
                    <h2 class="title font-weight-bold mt-4"><?php echo htmlspecialchars($post["p_name"]) ?></h2>
                    <ul class="admin-list mt-2 mb-4">
                        <li><a href="blog-single.html"><i class="far fa-user"></i><?php echo htmlspecialchars($post["username"]) ?>
                            </a></li>
                        <li><a href="blog-single.html"><i class="far fa-comment-dots"></i>8 Comments</a>
                        </li>
                    </ul>
                    <?php echo $post["p_content"]; ?>
                    <div class="item mt-5">
                        <?php if (isset($relatePosts) && count($relatePosts) > 0) : ?>
                            <h3 class="aside-title">Maybe You are interested in </h3>
                            <div class="row">
                                <?php foreach ($relatePosts as $index => $relatePost) : ?>
                                    <div class="col-sm-6">
                                        <div class="list-view list-view1">
                                            <div class="grids5-info">
                                                <a href="?controller=post&action=show&url=<?php echo htmlspecialchars($relatePost["post_url"]) ?>&id=<?php echo htmlspecialchars($relatePost["post_id"]) ?>" class="d-block zoom"><img src="Public/<?php echo htmlspecialchars($relatePost["img_url"]) ?>" alt="<?php echo htmlspecialchars($relatePost["img_alt"]) ?>" class="img-fluid radius-image news-image"></a>
                                                <div class="blog-info align-self">
                                                    <a href="?controller=post&action=show&url=<?php echo htmlspecialchars($relatePost["post_url"]) ?>&id=<?php echo htmlspecialchars($relatePost["post_id"]) ?>" class="blog-desc1">
                                                        <?php echo htmlspecialchars($relatePost["post_name"]) ?>
                                                    </a>
                                                    <div class="author align-items-center mb-1">
                                                        <a href="#url"><?php echo htmlspecialchars($relatePost["username"]) ?></a> in <a href="#url"><?php echo htmlspecialchars($relatePost["cat_name"]) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="author-cardview my-5">
                        <div class="row author-card author-listhny align-items-center">
                            <div class="author-left col-md-3 mb-md-0 mb-4 pl-lg-0">
                                <a href="#url">
                                    <img class="img-fluid img-curve" src="Public/<?php echo htmlspecialchars($post["user_avatar"]) ?>" alt="<?php echo htmlspecialchars($post["username"]) ?> avatar">
                                </a>
                            </div>
                            <div class="author-right col-md-9 position-relative">

                                <h4 class="mt-0 mb-1"><a href="#url" class="title-team-28"><?php echo htmlspecialchars($post["username"]) ?></a>
                                </h4>
                                <p class="para-team mb-0"><?php echo htmlspecialchars($post["about_user"]) ?></p>

                                <div class="social mt-4">
                                    <li><a href="#facebook" class="facebook"><span class="fab fa-facebook-f"></span></a></li>
                                    <li><a href="#twitter" class="twitter"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#instagram" class="instagram"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#linkedin" class="linkedin"><span class="fab fa-linkedin-in"></span></a></li>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="comments">
                        <h3 class="aside-title ">Recent comments(2)</h3>
                        <div class="comments-grids">
                            <div class="media-grid">
                                <div class="media">
                                    <a class="comment-img" href="#url"><img src="assets/images/testi1.jpg" class="img-fluid" width="100px" alt="placeholder image"></a>
                                    <div class="media-body comments-grid-right">
                                        <h5>Jack Harry</h5>
                                        <ul class="p-0 comment">
                                            <li class="">Sep 17th, 2021 at 11:00 am</li>
                                            <li>
                                                <a href="#comment" class="replay"><i class="fas fa-reply"></i>
                                                    Reply</a>
                                            </li>
                                        </ul>
                                        <p>Mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec purus
                                            quis
                                            tempor. Phasellus ipsum bibendum eu nec purus quis tempor dolor set.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="media-grid">
                                <div class="media">
                                    <a class="comment-img" href="#url"><img src="assets/images/testi2.jpg" class="img-fluid" width="100px" alt="placeholder image"></a>
                                    <div class="media-body comments-grid-right">
                                        <h5>Charlie</h5>
                                        <ul class="p-0 comment">
                                            <li class="">Sep 17th, 2021 at 05:45 pm </li>
                                            <li>
                                                <a href="#comment" class="replay"><i class="fas fa-reply"></i>
                                                    Reply</a>
                                            </li>
                                        </ul>
                                        <p>Mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec purus
                                            quis
                                            tempor. Phasellus eu nec purus quis tempor.
                                        </p>
                                        <div class="media mb-0 border-0 px-0 media-2 mt-5">
                                            <a class="comment-img" href="#url"><img src="assets/images/testi3.jpg" class="img-fluid" width="100px" alt="placeholder image"></a>
                                            <div class="media-body comments-grid-right">
                                                <h5>Jack Harry</h5>
                                                <ul class="p-0 comment">
                                                    <li class="">Sep 17th, 2021 at 11:00 am</li>
                                                    <li>
                                                        <a href="#comment" class="replay"><i class="fas fa-reply"></i> Reply</a>
                                                    </li>
                                                </ul>
                                                <p>Mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec
                                                    purus quis
                                                    tempor. dolor set.</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="leave-comment-form" id="comment">
                        <h3 class="aside-title">Leave a Comment</h3>
                        <form action="#" method="post">
                            <div class="input-grids">
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <input type="text" name="Name" class="form-control" placeholder="Name" required="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <input type="email" name="Email" class="form-control" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <input type="text" name="Website" class="form-control" placeholder="Website" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="Comment" class="form-control" placeholder="Your Comment" required=""></textarea>
                                </div>

                            </div>
                            <div class="submit text-right">
                                <button class="btn btn-style">Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php include "Views/inc/sidebar.php"; ?>
            </div>
        </div>
    </div>
</section>
<!-- //blog page -->
<div style="margin: 8px auto; display: block; text-align:center;">

    <!---728x90--->

</div>
<?php include "Views/inc/footer.php" ?>