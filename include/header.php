<?php
//session_start();
include "config/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PAUD Sistem</title>
        <link type="text/css" href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!---->
        <link type="text/css" href="assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- From CDN -->
        <link type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom Css -->
        <link type="text/css" href="assets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="assets/css/style_paud.css" rel="stylesheet">
        <link type="text/css" href='assets/css/google-fonts.css'rel='stylesheet'>

        <script src="assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">PAUD Sistem</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">

                        <form action="search.php" method="post" class="navbar-search pull-left input-append">
                            <select value=" " name="search" id="keyword" title="Student ID" class="txt_field">
                                <option>Pilih Peserta Didik..</option>
                                <?php
                                $queryAll = $mysqli->query("SELECT * FROM tpeserta_didik");
                                foreach ($queryAll as $dataAll) {
                                    ?>
                                    <option value="<?php echo $dataAll['id'] ?>"><?php echo $dataAll['nama_lengkap'] ?></option>   
                                    <?php
                                }
                                ?>
                            </select>
                            <button class="btn" type="submit" name="submit">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li><a href="index.php">Beranda </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="assets/images/prinsip-pendidikan-anak-usia-dini.jpg" class="nav-avatar" />
                                    <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="account.php">Pengaturan Akun</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Keluar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
