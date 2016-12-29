<?php
require_once 'config.php';
if (!isset($_POST['searchText']) ) {
	header('Location: index.php');
}
$stmt = $db->prepare("SELECT * FROM post WHERE text LIKE ?" );
$text = '%'.$_POST['searchText'].'%';


?>
<!DOCTYPE html>
<html>
<head>
    <title>[XBlog]</title>
    <meta charset="utf-8">
    <meta name="keywords" content="content">
    <meta name="description" content="content">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require_once 'header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" id="signin">

                	<?php
					if ($stmt)
					if ( $stmt->bind_param("s", $text) )
					if ( $stmt->execute() )
					if ( ( $result = $stmt->get_result() ) )
					if ($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							echo '<p>'.substr($row["text"], 0, 20).' ...</p>';
							echo '<a href="'.$row["id"].'" class="post-link"> read more</a><br>';
						}
					}
					?>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
