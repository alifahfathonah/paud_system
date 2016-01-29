<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        ?>
        <?php include "./include/header.php"; ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include "./include/sidebar.php"; ?>
                    <div class="span9">
                        <div class="content">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Selamat Datang <?php echo $_SESSION['nama_pendek'] ?> !</strong> Silahkan Mengatur Sistem Anda.
                            </div>
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <?php
                                    $queryKaryawan = $mysqli->query("SELECT * FROM tkaryawan");
                                    $totalKaryawan = mysqli_num_rows($queryKaryawan);
                                    ?>
                                    <a href="list_karyawan.php" class="btn-box big span6"><i class="fa fa-graduation-cap"></i><b><?php echo $totalKaryawan; ?></b>
                                        <p class="text-muted">
                                            Total Karyawan</p>
                                    <?php 
                                    $queryPeserta_didik = $mysqli->query("SELECT * FROM tpeserta_didik");
                                    $totalPeserta_didik = mysqli_num_rows($queryPeserta_didik);
                                    ?>
                                    </a><a href="list_peserta_didik.php" class="btn-box big span6"><i class="fa fa-odnoklassniki"></i><b><?php echo $totalPeserta_didik ?></b>
                                        <p class="text-muted">
                                            Total Peserta Didik</p>
                                    </a>
                                </div>
                                <?php
                                    $queryKegiatan = $mysqli->query("SELECT * FROM tkegiatan");
                                    $totalKegiatan = mysqli_num_rows($queryKegiatan);
                                ?>
                                <div class="btn-box-row row-fluid">
                                    <a href="kegiatan.php" class="btn-box big span12"><i class="fa fa-soccer-ball-o"></i><b><?php echo $totalKegiatan; ?></b>
                                        <p class="text-muted">
                                            Kegiatan</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "./include/footer.php"; ?>

        <?php
    } else {
        echo "Sorry, Your not authorization !";
        //header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>