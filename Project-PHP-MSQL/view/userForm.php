<?php
$action = 'store';
$buttonName = 'SAVE';
$formTitle = 'INSERT USER';
if ($user && $user['id']) {
    $action = 'edit';
    $formTitle = 'UPDATE USER';
}
?>
<form action="controller/updateRecord.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="hidden" name="action" value="<?= $action ?>">
    <h2><?= $formTitle ?></h2>
    <div class="row mb-3">
        <label for="username" class="col-form-label text-end form-label col-sm-2">Username: </label>
        <div class="col-sm-8">
            <input id="username" value="<?= $user['username'] ?>" class="col-sm-4 form-control required-field" name="username" data-type="username">
            <span class="error-msg" style="color:red; display:none;"></span>
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-form-label text-end form-label col-sm-2">Email: </label>
        <div class="col-sm-8">
            <input id="email" value="<?= $user['email'] ?>" class="col-sm-4 form-control required-field" name="email" data-type="email">
            <span class="error-msg" style="color:red; display:none;"></span>
        </div>
    </div>
    <div class="row mb-3">
        <label for="fiscalCode" class="col-form-label text-end form-label col-sm-2">Fiscal Code: </label>
        <div class="col-sm-8">
            <input id="fiscalCode" value="<?= $user['fiscalCode'] ?>" class="col-sm-4 form-control required-field" name="fiscalCode" data-type="fiscal">
            <span class="error-msg" style="color:red; display:none;"></span>
        </div>
    </div>
    <div class="row mb-3">
        <label for="age" class="col-form-label text-end l form-label col-sm-2">Age: </label>
        <div class="col-sm-8">
            <input id="age" value="<?= $user['age'] ?>" class="col-sm-4 form-control required-field" name="age" data-type="age">
            <span class="error-msg" style="color:red; display:none;"></span>
        </div>
    </div>
    <div class="row mb-4">
        <label for="avatar" class="col-form-label text-end form-label col-sm-2">Avatar:</label>
        <div class="col-sm-8">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?= getConfig('maxFileSize') ?>">
            <input type="file" accept=".jpg, .jpeg, .png" id="avatar" value="<?= $user['avatar'] ?>" class="form-control" name="avatar">
        </div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2 infoImagesBytes">
                <b>Types: </b> <?= implode(', ', getConfig('mimeTypes')) ?>
            </div>
            <div class="col-sm-8 offset-sm-2 infoImagesBytes">
                <b> Max file size: </b> <?= formatBytes(getConfig('maxFileSize')) ?>
            </div>
        </div>
    </div>
    <div class="row mb-3 d-flex justify-content-center align-items-sm-center">
        <div class="col-sm-3">
            <button href="index.php" type="submit" class="btn btn-primary"> <?= $buttonName ?> </button>
            <a href="index.php" class="btn btn-secondary"> Back to users </a>
            <?php
            if ($action === 'edit') { ?>
                <a href="controller/updateRecord.php?action=delete&id=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"> Elimina </a>
            <?php } ?>
        </div>
    </div>
</form>

<?php
require 'view/jqueryFunction.php';
jqueryScripts();
?>