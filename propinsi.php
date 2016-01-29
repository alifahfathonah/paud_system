<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['savePropinsi'])) {
            $propinsi = $mysqli->real_escape_string($_POST['propinsi']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $negara_id = $mysqli->real_escape_string($_POST['negara_id']);

            $query = $mysqli->query("INSERT INTO tpropinsi(propinsi, deskripsi, negara_id) VALUES('$propinsi','$deskripsi','$negara_id')");
            if ($query) {
                header("Location: propinsi.php");
            } else {
                echo "Failed to add data !";
            }
        }

        if (isset($_GET['editPropinsi'])) {
            $idEdit = $_GET['editPropinsi'];
            $query = $mysqli->query("SELECT * FROM tpropinsi WHERE id='$idEdit' ");
            $getRowPropinsi = $query->fetch_array();
        }

        if (isset($_POST['updatePropinsi'])) {
            $idUpdate = $_GET['editPropinsi'];
            $propinsi = $mysqli->real_escape_string($_POST['propinsi']);
            $negara_id = $mysqli->real_escape_string($_POST['negara_id']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);

            $query = $mysqli->query("UPDATE tpropinsi SET propinsi='$propinsi', deskripsi='$deskripsi', negara_id='$negara_id' WHERE id='$idUpdate' ");
            header("Location: propinsi.php");
            die();
        }

        /*
         * Propinsi delete process
         */

        if (isset($_GET['deletePropinsi'])) {
            $id = $_GET['deletePropinsi'];
            $query = $mysqli->query("DELETE FROM tpropinsi WHERE id='$id' ");
            header("Location: propinsi.php");
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
                                    <b><i class="fa fa-location-arrow"></i> Lokasi <a href="lokasi.php"> << Kembali</a></b>
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
                                                <?php
                                                if (isset($_GET['editPropinsi'])) {
                                                    $idEdit = $_GET['editPropinsi'];
                                                    $query = $mysqli->query("select * from tpropinsi where id='$idEdit'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" data-placeholder="Select here.." name="negara_id" required="">
                                                    <option value="">Select negara..</option>
                                                    <?php
                                                    if (isset($_GET['editPropinsi'])) {
                                                        $query = $mysqli->query("SELECT * FROM tnegara");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['negara_id'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['negara'] . "</option>";
                                                        }
                                                    } else {
                                                        $queryAll = $mysqli->query("SELECT * FROM tnegara");
                                                        //$dataAll = mysqli_fetch_array($queryAll);

                                                        foreach ($queryAll as $dataAll) {
                                                            ?>
                                                            <option value="<?php echo $dataAll['id'] ?>"><?php echo $dataAll['negara'] ?></option>   
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Propinsi</label>
                                            <div class="controls">
                                                <input type="text" name="propinsi" required="" value="<?php
                                                if (isset($_GET['editPropinsi'])) {
                                                    echo $getRowPropinsi['propinsi'];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Deskripsi</label>
                                            <div class="controls">
                                                <textarea class="span8" rows="5" name="deskripsi" required=""><?php
                                                    if (isset($_GET['editPropinsi'])) {
                                                        echo $getRowPropinsi['deskripsi'];
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php if (isset($_GET['editPropinsi'])) { ?>
                                                    <button type="submit" class="btn btn-success" name="updatePropinsi">Edit</button>
                                                    <a href="propinsi.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="savePropinsi">Simpan</button>
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
                                                <th>Propinsi</th>
                                                <th>Deskripsi</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = $mysqli->query("SELECT tpropinsi.id, tpropinsi.propinsi, tpropinsi.deskripsi, tnegara.negara FROM tpropinsi INNER JOIN tnegara ON tpropinsi.negara_id=tnegara.id");
                                            foreach ($query as $data) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['negara']; ?></td>
                                                    <td><?php echo $data['propinsi']; ?></td>
                                                    <td><?php echo $data['deskripsi']; ?></td>
                                                    <td>
                                                        <a href="propinsi.php?editPropinsi=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                        <a href="propinsi.php?deletePropinsi=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
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