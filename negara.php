<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['saveNegara'])) {
            $negara = $mysqli->real_escape_string($_POST['negara']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);

            $query = $mysqli->query("INSERT INTO tnegara(negara, deskripsi) VALUES('$negara','$deskripsi')");
            if ($query) {
                header("Location: negara.php");
                ?>
                <script>
                    window.onload = function () {
                        $('#tab1').addClass('active');
                    }
                </script>

                <?php
            } else {
                echo "Failed to add data !";
            }
        }

        if (isset($_GET['editNegara'])) {
            $idEdit = $_GET['editNegara'];
            $query = $mysqli->query("SELECT * FROM tnegara WHERE id='$idEdit' ");
            $getRowNegara = $query->fetch_array();
        }

        if (isset($_POST['updateNegara'])) {
            $idUpdate = $_GET['editNegara'];
            $negara = $mysqli->real_escape_string($_POST['negara']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);

            $query = $mysqli->query("UPDATE tnegara SET negara='$negara', deskripsi='$deskripsi' WHERE id='$idUpdate' ");
            header("Location: negara.php");
            die();
        }


        /*
         * Negara delete process
         */

        if (isset($_GET['deleteNegara'])) {
            $id = $_GET['deleteNegara'];
            $query = $mysqli->query("DELETE FROM tnegara WHERE id='$id' ");
            header("Location: negara.php");
            die();
        }
        ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include "./include/sidebar.php"; ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <b><i class="fa fa-location-arrow"></i> Locations <a href="lokasi.php"> << Kembali</a></b>
                                    <div class="row pull-right">
                                        <a href="negara.php" class="btn btn-mini btn-inverse">Negara</a>
                                        <a href="propinsi.php" class="btn btn-mini btn-warning">Propinsi</a>
                                        <a href="kota.php" class="btn btn-mini btn-info">Kota</a>
                                    </div>
                                </div>
                                <div class="module-body">
                                    <!-- form -->
                                    <form class="form-horizontal row-fluid" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Negara</label>
                                            <div class="controls">
                                                <input type="text" name="negara" required="" value="<?php
                                                if (isset($_GET['editNegara'])) {
                                                    echo $getRowNegara['negara'];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Deskripsi</label>
                                            <div class="controls">
                                                <textarea class="span8" rows="5" name="deskripsi" required=""><?php
                                                    if (isset($_GET['editNegara'])) {
                                                        echo $getRowNegara['deskripsi'];
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php if (isset($_GET['editNegara'])) { ?>
                                                    <button type="submit" class="btn btn-success" name="updateNegara">Edit</button>
                                                    <a href="negara.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="saveNegara">Simpan</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /form -->
                                    <br>
                                    <!-- data gender -->
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Negara</th>
                                                <th>Deskripsi</th>
                                                <th>Perintah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = $mysqli->query("SELECT * FROM tnegara");
                                            foreach ($query as $data) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['negara']; ?></td>
                                                    <td><?php echo $data['deskripsi']; ?></td>
                                                    <td>
                                                        <a href="negara.php?editNegara=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                        <a href="negara.php?deleteNegara=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- /data gender -->
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