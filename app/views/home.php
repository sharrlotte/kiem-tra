<?php require_once 'app/views/shares/header.php'; ?>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error'];
        unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Sinh viên</h2>
                    <p class="card-text">Quản lý sinh viên</p>
                    <a href="index.php?controller=student&action=index" class="btn btn-primary">Chuyển đến</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Categories</h2>
                    <p class="card-text">Explore products by categories.</p>
                    <a href="index.php?controller=category&action=index" class="btn btn-primary">Go to Categories</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/views/shares/footer.php'; ?>
