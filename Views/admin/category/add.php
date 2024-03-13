<?php include "Views/admin/inc/header.php" ?>
<div class="container" style="padding-top: 2rem;">
    <h3>Forms</h3>
    <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
            <form class="form-horizontal" method="POST" action="">
                <div class="form-group" style="margin-left: 0; margin-right:0">
                    <label for="name" class="control-label">Tên danh mục</label>
                    <div>
                        <input type="text" required class="form-control1" name="name" id="name" placeholder="Tên danh mục">
                    </div>
                </div>
                <div class="form-group" style="margin-left: 0; margin-right:0">
                    <label for="url" class="control-label">Url danh mục</label>
                    <div>
                        <input type="text" required class="form-control1" name="url" id="url" placeholder="Url danh mục">
                    </div>
                </div>
                <div class="form-group" style="margin-left: 0; margin-right:0">
                    <label for="description" class="control-label">Mô tả</label>
                    <div>
                        <textarea name="description" id="description" cols="50" rows="5" class="form-control1" style="height: auto"></textarea>
                    </div>
                </div>
                <?php if(isset($errorMessage) && $errorMessage): ?>
                    <?php echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>" ?>
                <?php endif; ?>
                <?php if(isset($message) && $message): ?>
                    <?php echo "<div class='alert alert-success' role='alert'>$message</div>" ?>
                <?php endif; ?>
                <div class="form-group" style="margin-left: 0; margin-right:0">
                    <button type="submit" name="store_category" class="btn-success btn">Tạo danh mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "Views/admin/inc/footer.php" ?>