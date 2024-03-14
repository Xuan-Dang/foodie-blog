<?php include "Views/admin/inc/header.php" ?>
<div class="container" style="padding-top: 2rem;">
    <h3>Danh sách danh mục sản phẩm</h3>
    <div class="bs-example4" data-example-id="contextual-table" style="padding-right: 0; padding-left: 0;">
    <?php 
        if(isset($errorMessage) && $errorMessage) {
            echo "<div class='alert alert-danger' role='alert'>{$errorMessage}</div>";
        }
        if(isset($message) && $message) {
            echo "<div class='alert alert-danger' role='alert'>{$message}</div>";
        }
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th>Url danh mục</th>
                    <th>Mô tả danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    echo $categories
                ?>
            </tbody>
        </table>
        <?php 
            if(isset($pagination)) {
                echo $pagination;
            }
        ?>
    </div>
</div>
<?php include "Views/admin/inc/footer.php" ?>