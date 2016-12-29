<?php
    session_start();
    $signin = (isset($_SESSION['username']) ? true : false);
    if ($signin == false) header('Location: index.php');
    require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'head.php'; ?>
    </head>
    <body>
        <?php include_once 'header.php' ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" id="signin">
                    <form id="change-password-form">
                        <div id="message-change-password" class="alert alert-success" role="alert"></div>
                        <div class="form-group">
                            <label for="password-old">Old Password:</label>
                            <input type="password" class="form-control" id="password-old" name="password-old" required>
                        </div>
                        <div class="form-group">
                            <label for="password-new">New Password:</label>
                            <input type="password" class="form-control" id="password-new" name="password-new" required>
                        </div>
                        <input type="hidden" name="change-password" value="1">
                        <button type="submit" class="btn btn-default" id="change-password-btn">Change</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once 'script.php'; ?>
    </body>
</html>
