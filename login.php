
<!DOCTYPE html>
<html>
<head>
    <?php require_once 'head.php'; ?>
</head>
<body>
    <?php require_once 'header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" id="signin">
                <form id="signin-form">
                    <div id="message-signin" class="alert alert-success" role="alert"></div>
                    <div class="form-group">
                        <label for="username">Username or mail:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <input type="hidden" name="signin" value="1">
                    <button type="submit" class="btn btn-default" id="signin-btn">Sign in</button>
                    <a href="#" type="submit" class="btn btn-danger pull-right" id="signup-show-btn">Sign up</a>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" id="signup">
                <form id="signup-form">
                    <div id="message-signup" class="alert alert-danger" role="alert"></div>
                    <div class="form-group">
                        <label for="new-username">Username:</label>
                        <input type="text" class="form-control" id="new-username" name="new-username" required>
                    </div>
                    <div class="form-group">
                        <label for="new-mail">Mail:</label>
                        <input type="text" class="form-control" id="new-mail" name="new-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">Password:</label>
                        <input type="password" class="form-control" id="new-password" name="new-password" required>
                    </div>
                    <input type="hidden" name="signup" value="1">
                    <button type="button" class="btn btn-default" id="signup-btn">Sign up</button>
                    <button type="button" class="btn btn-danger pull-right" id="signup-cancel-btn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once 'script.php'; ?>
</body>
</html>
