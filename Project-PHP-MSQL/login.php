<?php
session_start();
require_once 'functions.php';
if (isUserLoggedin()) {
    header('Location: index.php');
    exit;
}

$bytes = random_bytes(32);
$token = bin2hex($bytes);
$_SESSION['_csrf'] = $token;
require_once 'view/top.php';
?>
<section class="container">
    <div id="loginform">
        <form action="view/verifyLogin.php" method="post">
            <input type="hidden" name="_csrf" value="<?= $token ?>">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control required-field" id="email" data-type="email" aria-describedby="emailHelp" placeholder="Enter Email">
                <span class="error-msg" style="color:red; display:none;"></span>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="col-form-label text-end form-label">Password: </label>
                <input id="password" value="" class="col-sm-4 form-control required-field" name="password" data-type="password" placeholder="Password">
                <span class="error-msg" style="color:red; display:none;"></span>
            </div>
            <div class="form-group form-check mb-3">
                <input type="checkbox" name="rememberme" class="form-check-input required-field" id="exampleCheck1" data-type="checkbox">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                <span class="error-msg" style="color:red; display:none;"></span>
            </div>
            <div class="form-group text-center btn-lg">
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>
        </form>
    </div>
</section>
<?php
require 'view/jqueryFunction.php';
jqueryScripts();
require_once 'view/footer.php';
