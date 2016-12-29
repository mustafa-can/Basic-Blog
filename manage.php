<?php
    session_start();
    $signin = (isset($_SESSION['username']) ? true : false);
    if ($signin == false) header('Location: index.php');
    require_once 'config.php';
    $result = $db->query("SELECT * FROM post WHERE blog_id=".$_SESSION['blog_id']." ORDER BY post_time DESC");
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
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" id="links">
                    <ul>
                        <li><a href="#" id="add-post">+ Add Post</a></li><br>
                        <p>Previous Posts:</p>
                        <?php
                            while ( $row = $result->fetch_assoc() )
                                echo '<li><a href="#" class="update-link" id="'.$row["id"].'">'.$row["tag"].'</a></li>';
                        ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="post-edit">
                    <form id="post-form">
                        <div id="result" class="alert alert-success" role="alert"></div>
                        <div class="form-group">
                            <label for="tag">Topic:</label>
                            <input type="text" class="form-control" id="tag" name="tag" required>
                        </div>
                        <div class="form-group">
                            <label for="post-text">Text:</label>
                            <textarea rows="8" cols="40" name="post-text" id="post-text" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sort-order">Sort Order:</label>
                            <input type="text" class="form-control" id="sort-order" name="sort-order" required>
                        </div>
                        <button type="submit" class="btn btn-default" id="save">Save</button>
                        <a href="#" type="submit" class="btn btn-danger pull-right" id="delete-post">Delete This Post</a>
                    </form>
                    <div class="" id="comments"></div>
                </div>
            </div>
        </div>
        <?php require_once 'script.php'; ?>
    </body>
</html>
