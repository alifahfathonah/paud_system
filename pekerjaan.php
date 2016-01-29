<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['save'])) {
            $pekerjaan = $mysqli->real_escape_string($_POST['pekerjaan']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $query = $mysqli->query("INSERT INTO tpekerjaan(pekerjaan,deskripsi) VALUES('$pekerjaan', '$deskripsi')");
            header("Location: pekerjaan.php");
            die();
        }

        if (isset($_GET['edit'])) {
            $edit = $_GET['edit'];
            $query = $mysqli->query("SELECT * FROM tpekerjaan WHERE id=" . $edit);
            $getRow = $query->fetch_array();
        }

        if (isset($_POST['update'])) {
            $edit = $_GET['edit'];
            $pekerjaan = $mysqli->real_escape_string($_POST['pekerjaan']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $query = $mysqli->query("UPDATE tpekerjaan SET pekerjaan='$pekerjaan', deskripsi='$deskripsi' WHERE id='$edit' ");
            if ($query) {
                header("Location: pekerjaan.php");
                die();
            } else {
                echo 'failed';
            }
        }
        /*
         * delete process
         */

        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $query = $mysqli->query("DELETE FROM tpekerjaan WHERE id='$id' ");
            header("Location: pekerjaan.php");
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
                                    <b><i class="fa fa-black-tie"></i> Pekerjaan</b>
                                </div>
                                <div class="module-body">
                                    <!-- form -->
                                    <form class="form-horizontal row-fluid" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Pekerjaan</label>
                                            <div class="controls">
                                                <input type="text" name="pekerjaan" required="" value="<?php
                                                if (isset($_GET['edit'])) {
                                                    echo $getRow['pekerjaan'];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Deskripsi</label>
                                            <div class="controls">
                                                <textarea class="span8" rows="5" name="deskripsi" required=""><?php
                                                    if (isset($_GET['edit'])) {
                                                        echo $getRow['deskripsi'];
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php if (isset($_GET['edit'])) { ?>
                                                    <button type="submit" class="btn btn-success" name="update">Edit</button>
                                                    <a href="pekerjaan.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="save">Simpan</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /form -->
                                    <br>
                                    <!-- data pekerjaan -->
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pekerjaan</th>
                                                <th>Deskripsi</th>
                                                <th>Perintah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $mysqli->query("SELECT * FROM tpekerjaan");
                                            $no = 1;
                                            foreach ($query as $data) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['pekerjaan']; ?></td>
                                                    <td><?php echo $data['deskripsi']; ?></td>
                                                    <td>
                                                        <a href="?edit=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                        <a href="?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- /data pekerjaan -->
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