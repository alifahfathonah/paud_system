<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {

        if (isset($_POST['save'])) {
            $about = $_POST['about'];
            $create_at = date('Y-m-d');
            $update_at = date('Y-m-d');

            $query = $mysqli->query("INSERT INTO tabout(about,create_at,update_at) VALUES('$about','$create_at','$update_at')");
            if ($query) {
                header("Location: about.php");
            } else {
                echo "Something wrong ! please try again.";
            }
        }
        if (isset($_POST['update'])) {
            $id = $_GET['update'];
            $about = $_POST['about'];
            $create_at = date('Y-m-d');
            $update_at = date('Y-m-d');

            $query = $mysqli->query("UPDATE tabout SET about='$about', create_at='$create_at', update_at='$update_at' WHERE id='$id'");
            if ($query) {
                header("Location: about.php");
            } else {
                echo "failed";
            }
        }

        /*
         * Delete about
         */

        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $query = $mysqli->query("DELETE FROM tabout WHERE id='$id' ");
            header("Location: about.php");
        }
        ?>
        <?php include "./include/header.php"; ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include "./include/sidebar.php"; ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <i class="menu-icon fa fa-institution"></i> <b>Tentang SPS Kemuning</b>
                                </div>
                                <div class="module-body">
                                    <?php
                                    $getQuery = $mysqli->query("SELECT * FROM tabout");
                                    if (mysqli_num_rows($getQuery) == 1) {
                                        while ($row = $getQuery->fetch_array()) {
                                            ?>

                                            <?php if (isset($_GET['update'])) { ?>
                                                <form class="form-horizontal row-fluid" method="post">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Tentang SPS Kemuning</label>
                                                        <div class="controls">
                                                            <textarea class="span8" rows="10" name="about"><?php echo $row['about']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <button type="submit" class="btn btn-success" name="update">Edit</button>
                                                            <a href="about.php" class="btn btn-inverse">Batal</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php } else { ?>
                                                <form class="form-horizontal row-fluid" method="post">
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Tentang SPS Kemuning</label>
                                                        <div class="controls">
                                                            <textarea class="span8" rows="10" name="about" disabled=""><?php echo $row['about']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <a href="?update=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i> Edit</a>
                                                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?')"><i class="icon-trash"></i> Hapus</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php } ?>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <form class="form-horizontal row-fluid" method="post">
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Tentang SPS Kemuning</label>
                                                <div class="controls">
                                                    <textarea class="span8" rows="5" name="about"></textarea>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <div class="controls">
                                                    <button type="submit" class="btn btn-info" name="save">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                    ?>
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