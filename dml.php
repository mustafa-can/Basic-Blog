<?php
    session_start();
    require_once 'config.php';
    $stmt = null;
    if ( isset($_POST['add_post']) ) {
        $stmt = $db->prepare("INSERT INTO post (blog_id, sort_order, tag, text) VALUES (?, ?, ?, ? )" );
        $blog_id = $_SESSION['blog_id'];
        $sort_order = $_POST['sort-order'];
        $tag = $_POST['tag'];
        $post_text = $_POST['post-text'];
        if ($stmt)
        if($stmt->bind_param("iiss", $blog_id, $sort_order , $tag, $post_text ) )
            $stmt->execute();
    }
    else if ( isset($_POST['update_post']) ) { //****
        $stmt = $db->prepare("UPDATE post SET sort_order = ?, tag = ?, text = ? WHERE id=".$_POST['update_post'] );
        $sort_order = $_POST['sort-order'];
        $tag = $_POST['tag'];
        $post_text = $_POST['post-text'];
        if ($stmt)
        if ($stmt->bind_param("iss", $sort_order, $tag, $post_text ) )
        if ( $stmt->execute() )
            echo $_POST['update_post'].'#_#'.$tag;
        else echo 0;
    }
    else if ( isset($_GET['delete_post']) ) {
        $sql = $db->query("DELETE FROM post WHERE id=".$_GET['delete_post'] );
        header('Location: manage.php');
        //when not deleted just do nothing
    }
    else if ( isset($_GET['get_post']) ) {
        if ( $sql = $db->query("SELECT * FROM post WHERE id=".$_GET['get_post'] ) ) {
            echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
        }
        else echo 0;
    }
    else if ( isset($_GET['get_comment']) ) {
        if ( $sql = $db->query("SELECT * FROM comment WHERE post_id=".$_GET['get_comment']." ORDER BY comment_time ASC" ) ) {
            echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
        }
        else echo 0;
    }
    else if ( isset($_GET['del_comment']) ) {
        if ( $db->query("DELETE FROM comment WHERE id=".$_GET['del_comment'] ) )
            echo 1;
        else echo 0;
    }
    else if ( isset($_GET['get_blog']) ) {
        if ( $db->query( "SELECT * FROM blog WHERE id=".$_GET['get_blog'] ) ) {
            echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
        }
        else echo 0;
    }
    else if ( isset($_POST['signup']) ) {
        $stmt = $db->prepare("INSERT INTO blog (username, mail, password) VALUES (?, ?, ?)" );
        $username = $_POST['new-username'];
        $mail = $_POST['new-mail'];
        $password = md5( $_POST['new-password'] );
        if ($stmt)
        if ($stmt->bind_param("sss", $username, $mail , $password ) )
        if ( $stmt->execute() ) echo 1;
        else echo 0;
    }
    else if ( isset($_POST['signin']) ) {
        $stmt = $db->prepare("SELECT * FROM blog WHERE (username=? OR mail=?) AND password=?" );
        $username = $_POST['username'];
        $password = md5( $_POST['password'] );
        if ( $stmt )
        if ( $stmt->bind_param("sss", $username, $username , $password ) )
        if ( $stmt->execute() )
        if ( $result = $stmt->get_result() )
        if ($result->num_rows > 0){
    		$row = $result->fetch_array();
    		$_SESSION['username'] = $row['username'];
    		$_SESSION['blog_id'] = $row['id'];
            echo 1;
    	}else
    		echo 0;
    }
    else if(isset( $_GET['signout'] ) ) {
        session_destroy();
        echo 1;
    }
    else if ( isset($_POST['change-password']) ) {
        $stmt = $db->prepare("SELECT * FROM blog WHERE password=? AND username=?" );
        $username = $_SESSION['username'];
        $old_password = md5($_POST['password-old']);
        $new_password = md5($_POST['password-new']);
        //just cool
        if ($stmt)
        if ( $stmt->bind_param("ss", $old_password, $username) )
        if ( $stmt->execute() )
        if ( ( $result = $stmt->get_result() ) )
        if ($result->num_rows > 0){
            $change = $db->query("UPDATE blog SET password='$new_password' WHERE username='$username'" );
            if ($db->affected_rows > 0) echo 1;
            else echo 0;
        }
        else echo 0;
    }
    else if(isset( $_GET['term'] ) ) {
        $stmt = $db->prepare("SELECT tag FROM post WHERE tag LIKE ?" );
        $tag = '%'.$_GET['term'].'%';
        if ($stmt)
        if ( $stmt->bind_param("s", $tag) )
        if ( $stmt->execute() )
        if ( ( $result = $stmt->get_result() ) )
        if ($result->num_rows > 0){
            $arr = $result->fetch_all(MYSQLI_NUM);
            echo json_encode($arr);
        }
    }

    if ($stmt != null ) $stmt->close();
    $db->close();
?>
