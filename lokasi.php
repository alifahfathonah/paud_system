<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";
        ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include "./include/sidebar.php"; ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <b><i class="fa fa-location-arrow"></i> Lokasi</b>
                                </div>
                                <div class="module-body">
                                    <div class="btn-box-row row-fluid">
                                        <a href="negara.php" class="btn-box big span4">
                                            <i class="icon-globe"></i>

                                            <?php
                                            $queryNegara = $mysqli->query("SELECT * FROM tnegara");
                                            $totalNegara = mysqli_num_rows($queryNegara);
                                            ?>

                                            <p><?php echo $totalNegara; ?></p>
                                            <b>Negara</b>
                                        </a>
                                        <a href="propinsi.php" class="btn-box big span4">
                                            <i class="fa fa-location-arrow"></i>
                                            <?php
                                            $queryPropinsi = $mysqli->query("SELECT * FROM tpropinsi");
                                            $totalPropinsi = mysqli_num_rows($queryPropinsi);
                                            ?>

                                            <p><?php echo $totalPropinsi; ?></p>
                                            <b>Propinsi</b>
                                        </a>
                                        <a href="kota.php" class="btn-box big span4">
                                            <i class="icon-road"></i>
                                            <?php
                                            $queryKota = $mysqli->query("SELECT * FROM tkota");
                                            $totalKota = mysqli_num_rows($queryKota);
                                            ?>

                                            <p><?php echo $totalKota; ?></p>
                                            <b>Kota</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "./include/footer.php";
    } else {
        echo "Sorry, Your not authorization !";
        //header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>