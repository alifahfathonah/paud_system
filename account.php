<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        /*
         * Edit account
         */

        if (isset($_GET['edit'])) {
            $query = $mysqli->query("SELECT * FROM tuser WHERE id=" . $_SESSION['id']);
            $getRow = $query->fetch_array();
        }

        /*
         * Update account
         */

        if (isset($_POST['update'])) {
            $edit = $_GET['edit'];
            $nama_pendek = $mysqli->real_escape_string($_POST['nama_pendek']);
            $username = $mysqli->real_escape_string($_POST['username']);
            $password = $mysqli->real_escape_string(md5($_POST['passwordEdit']));
            $rpassword = $mysqli->real_escape_string(md5($_POST['rpasswordEdit']));
            $update_at = date('Y-m-d');

            // empty()
            if (empty($_POST['passwordEdit']) || empty($_POST['rpasswordEdit'])) {
                $query = $mysqli->query("UPDATE tuser SET nama_pendek='$nama_pendek', username='$username', update_at='$update_at' WHERE id='$edit' ");
                header("Location: logout.php");
            } elseif ($password != $rpassword) {
                echo "<br><div style=text-align:center><h4 class=text-error>Update Failed. Password doesn't match</h4></div>";
            } elseif (strlen($_POST['passwordEdit']) < 7) {
                echo "<br><div style=text-align:center><h4 class=text-error>Update Failed. Password minimum 7 characters</h4></div>";
            } else {
                $query = $mysqli->query("UPDATE tuser SET nama_pendek='$nama_pendek', username='$username', password='$password', rpassword='$rpassword', update_at='$update_at' WHERE id='$edit' ");
                header("Location: logout.php");
            }
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
                                    <b><i class="icon-key"></i> Account</b>
                                </div>
                                <div class="module-body">
                                    <?php if (isset($_GET['edit'])) { ?>
                                        <form class="form-horizontal row-fluid" method="post">
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Nama Pendek</label>
                                                <div class="controls">
                                                    <input type="text" name="nama_pendek" required="" value="<?php echo $getRow['nama_pendek']; ?>">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Username</label>
                                                <div class="controls">
                                                    <input type="text" name="username" required="" value="<?php echo $getRow['username']; ?>">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Password</label>
                                                <div class="controls">
                                                    <input type="password" name="passwordEdit">
                                                    <small>Empty password, if you do not want to update</small>
                                                    <br><small class="text-error">*Min : 7 characters</small>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Repeat Password</label>
                                                <div class="controls">
                                                    <input type="password" name="rpasswordEdit">
                                                    <small>Empty Repeat password, if you do not want to update</small>
                                                    <br><small class="text-error">*Min : 7 characters</small>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="submit" value="Update" name="update" class="btn btn-success">
                                                    <a href="account.php" class="btn btn-inverse"> Batal</a>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } else {
                                        ?>
                                        <form class="form-horizontal row-fluid" method="post">
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Nama Pendek</label>
                                                <div class="controls">
                                                    <input type="text" name="nama_pendek" required="" value="<?php echo $_SESSION['nama_pendek']; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Username</label>
                                                <div class="controls">
                                                    <input type="text" name="username" required="" value="<?php echo $_SESSION['username']; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Password</label>
                                                <div class="controls">
                                                    <input type="password" name="password" id="password" value="<?php echo $_SESSION['password']; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <a href="?edit=<?php echo $_SESSION['id'] ?>" class="btn btn-warning"><i class="icon-pencil"></i> Edit</a>
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