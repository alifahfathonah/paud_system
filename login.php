<?php
session_start();
include './config/connect.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = $mysqli->query("SELECT * FROM tuser where username='$username'");
    $getRowLogin = $query->fetch_array();

    if (empty($username)) {
        echo "<script type='text/javascript'>onload=function(){alert('Username is empty')}</script>";
        header("Location: login.php");
    } elseif (empty($password)) {
        echo "<script type='text/javascript'>onload=function(){alert('Password is empty')}</script>";
        header("Location: login.php");
    } elseif ($username == $getRowLogin['username'] && $password == $getRowLogin['password']) {
        header("Location: index.php");
        $_SESSION['id'] = $getRowLogin['id'];
        $_SESSION['nama_pendek'] = $getRowLogin['nama_pendek'];
        $_SESSION['username'] = $getRowLogin['username'];
        $_SESSION['password'] = $getRowLogin['password'];
        $_SESSION['level'] = $getRowLogin['level'];
    } else {
        echo "<script type='text/javascript'>onload=function(){alert('Username dan Password Salah ! Silahkan Coba Lagi')}</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PAUD Sistem</title>
        <link type="text/css" href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="assets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i>
                    </a>

                    <a class="brand" href="index.php">
                        PAUD Sistem
                    </a>
                </div>
            </div><!-- /navbar-inner -->
        </div><!-- /navbar -->



        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="module module-login span4 offset4">
                        <form class="form-vertical" method="post">
                            <div class="module-head">
                                <h3>Login</h3>
                            </div>
                            <div class="module-body">
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <input class="span12" type="text" id="inputEmail" placeholder="Username" name="username" required="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <input class="span12" type="password" id="inputPassword" placeholder="Password" name="password" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="module-foot">
                                <div class="control-group">
                                    <div class="controls clearfix">
                                        <button type="submit" class="btn btn-primary pull-right" name="login">Masuk</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.wrapper-->
        <?php include "./include/footer.php"; ?>
    </body>
</html>