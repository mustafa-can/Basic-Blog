<?php
session_start();
$signin = (isset($_SESSION['username']) ? true : false);
require_once 'config.php';
$result = $db->query("SELECT * FROM post ORDER BY post_time DESC");

?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" id="post-links">
                <ul>
                    <p id="asd">Posts:</p>
                    <?php
                        while ( $row = $result->fetch_assoc() ) {
                            $result_writer = $db->query("SELECT * FROM blog WHERE id=".$row['blog_id']);
                            if ($writer = $result_writer->fetch_assoc()) {
                                echo '<li><a href="'.$row["id"].'" class="post-link">'.$row["tag"]. ' [ '.$writer["username"].' ] '.'</a></li>';
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="current-post">
                <h3 id="current-post-topic" class="text-center">Read Great Posts About Everything</h3><br>
                <blockquote id="current-post-text" cite="http://">
                    Post text is shown here...
                </blockquote><br>
                <p id="current-post-author" class="text-muted"><i></i></p><br>
                <div class="" id="current-post-comments"><p>Comments are shown here...</p></div>
            </div>
        </div>
    </div>
    <?php require_once 'script.php'; ?>
</body>
</html>
