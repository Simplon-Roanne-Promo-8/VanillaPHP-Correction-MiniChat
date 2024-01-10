<?php if (!empty($_GET['success'])) {?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['success'] ?>
    </div>
<?php } ?>

<?php if (!empty($_GET['error'])) {?>
    <div class="alert alert-danger" role="alert">
        <?= $_GET['error'] ?>
    </div>
<?php } ?>