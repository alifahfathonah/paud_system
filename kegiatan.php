<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['save'])) {
            $kegiatan = $mysqli->real_escape_string($_POST['kegiatan']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $query = $mysqli->query("INSERT INTO tkegiatan(kegiatan,deskripsi) VALUES('$kegiatan', '$deskripsi')");
            header("Location: kegiatan.php");
            die();
        }

        if (isset($_GET['edit'])) {
            $edit = $_GET['edit'];
            $query = $mysqli->query("SELECT * FROM tkegiatan WHERE id=" . $edit);
            $getRow = $query->fetch_array();
        }

        if (isset($_POST['update'])) {
            $edit = $_GET['edit'];
            $kegiatan = $mysqli->real_escape_string($_POST['kegiatan']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $query = $mysqli->query("UPDATE tkegiatan SET kegiatan='$kegiatan', deskripsi='$deskripsi' WHERE id='$edit' ");
            if ($query) {
                header("Location: kegiatan.php");
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
            $query = $mysqli->query("DELETE FROM tkegiatan WHERE id='$id' ");
            header("Location: kegiatan.php");
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
                                    <b><i class="fa fa-soccer-ball-o"></i> Kegiatan</b>
                                </div>
                                <div class="module-body">
                                    <!-- form -->
                                    <form class="form-horizontal row-fluid" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Kegiatan</label>
                                            <div class="controls">
                                                <input type="text" name="kegiatan" required="" value="<?php
                                                if (isset($_GET['edit'])) {
                                                    echo $getRow['kegiatan'];
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
                                                    <a href="kegiatan.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="save">Simpan</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /form -->
                                    <br>
                                    <!-- data kegiatan -->
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kegiatan</th>
                                                <th>Deskripsi</th>
                                                <th>Perintah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $mysqli->query("SELECT * FROM tkegiatan");
                                            $no = 1;
                                            foreach ($query as $data) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['kegiatan']; ?></td>
                                                    <td><?php echo $data['deskripsi']; ?></td>
                                                    <td>
                                                        <a href="kegiatan.php?edit=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                        <a href="kegiatan.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- /data kegiatan -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <<?php
        include "./include/footer.php";
    } else {
        echo "Sorry, Your not authorization !";
        //header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>