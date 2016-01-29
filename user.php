<?php
session_start();
include "./config/connect.php";
include "./include/header.php";

if (isset($_POST['save'])) {
    $nama_pendek = $mysqli->real_escape_string($_POST['nama_pendek']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string(md5($_POST['password']));
    $rpassword = $mysqli->real_escape_string(md5($_POST['rpassword']));
    $status = $mysqli->real_escape_string($_POST['status']);
    $level = $mysqli->real_escape_string($_POST['level']);
    $create_at = date('Y-m-d');
    $update_at = date('Y-m-d');

    if ($password != $rpassword) {
        echo "<script type='text/javascript'>
	onload =function(){
	alert('Password doesn\'t match.');
	}        
	</script>";
    } else {
        $query = $mysqli->query("INSERT INTO tuser"
                . "(nama_pendek, username, password, rpassword, status, level, create_at, update_at)"
                . "VALUES('$nama_pendek','$username','$password','$rpassword','$status','$level','$create_at','$update_at')");
        if ($query) {
            header("location: user.php");
            die();
        } else {
            echo "Warning ! There is something wrong.";
        }
    }
}
/*
 * edit process
 */
if (isset($_GET['edit'])) {
    $query = $mysqli->query("SELECT * FROM tuser WHERE id=" . $_GET['edit']);
    $getRow = $query->fetch_array();
}

if (isset($_POST['update'])) {
    $edit = $_GET['edit'];
    $nama_pendek = $mysqli->real_escape_string($_POST['nama_pendek']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string(md5($_POST['passwordEdit']));
    $rpassword = $mysqli->real_escape_string(md5($_POST['rpasswordEdit']));
    $status = $mysqli->real_escape_string($_POST['status']);
    $level = $mysqli->real_escape_string($_POST['level']);
    $create_at = date('Y-m-d');
    $update_at = date('Y-m-d');

    // empty()
    if (empty($_POST['passwordEdit']) || empty($_POST['rpasswordEdit'])) {
        $query = $mysqli->query("UPDATE tuser SET nama_pendek='$nama_pendek', username='$username', status='$status', level='$level', update_at='$update_at' WHERE id='$edit' ");
        header("Location: user.php");
    } else {
        if ($password != $rpassword) {
            echo "<br><div style=text-align:center><h4 class=text-error>Update Failed. Password doesn't match</h4></div>";
        } elseif (strlen($_POST['passwordEdit']) < 7) {
            echo "<br><div style=text-align:center><h4 class=text-error>Update Failed. Password minimum 7 characters</h4></div>";
        } else {
            $query = $mysqli->query("UPDATE tuser SET nama_pendek='$nama_pendek', username='$username', password='$password', rpassword='$rpassword', status='$status', level='$level', update_at='$update_at' WHERE id='$edit' ");
            header("Location: user.php");
        }
    }
}

/*
 * delete process
 */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = $mysqli->query("SELECT * FROM tuser WHERE id='" . $id . "'");
    $getData = $query->fetch_array();
    if ($_SESSION['id'] == $getData['id']) {
        echo "<br><div style=text-align:center><h4>Delete Failed ! Anda tidak bisa menghapus data diri anda sendiri.</h4></div>";
    } else {
        $query = $mysqli->query("DELETE FROM tuser WHERE id=" . $_GET['delete']);
        header("Location: user.php");
        die();
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
                            <b><i class="icon-group"></i> Users</b>
                        </div>
                        <div class="module-body">
                            <form class="form-horizontal row-fluid" method="post">
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Nama Pendek</label>
                                    <div class="controls">
                                        <input type="text" name="nama_pendek" required="" value="<?php
                                        if (isset($_GET['edit'])) {
                                            echo $getRow['nama_pendek'];
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Username</label>
                                    <div class="controls">
                                        <input type="text" name="username" required="" value="<?php
                                        if (isset($_GET['edit'])) {
                                            echo $getRow['username'];
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Password</label>
                                    <div class="controls">
                                        <?php if (isset($_GET['edit'])) { ?>
                                            <input type="password" name="passwordEdit" id="password" value="">
                                            <small>Kosonngkan Password bila tidak ingin Memperbaruinya</small>
                                            <br><small class="text-error">*Min : 7 karakter</small>
                                        <?php } else { ?>
                                            <input type="password" name="password" required="" id="password" value="" pattern=".{7,}" title="7 characters minimum">
                                            <br><small class="text-error">*Min : 7 karakter</small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Repeat Password</label>
                                    <div class="controls">
                                        <?php if (isset($_GET['edit'])) { ?>
                                            <input type="password" name="rpasswordEdit" id="rpassword" value="">
                                            <small>Kosonngkan Password bila tidak ingin Memperbaruinya</small>
                                            <br><small class="text-error">*Min : 7 karakter</small>
                                        <?php } else { ?>
                                            <input type="password" name="rpassword" id="rpassword" oninput="check(this)" value="" pattern=".{7,}" title="7 characters minimum">
                                            <br><small class="text-error">*Min : 7 karakter</small>     
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <?php
                                        if (isset($_GET['edit'])) {
                                            if ($getRow['status'] == 1) {
                                                ?>
                                                <label class="radio inline">
                                                    <input type="radio" name="status" required="" id="optionsRadios1" value="1" checked="">
                                                    Aktif
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="status" required="" id="optionsRadios2" value="2">
                                                    Tidak Aktif
                                                </label>     
                                            <?php } else { ?>
                                                <label class="radio inline">
                                                    <input type="radio" name="status" required="" id="optionsRadios1" value="1">
                                                    Aktif
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="status" required="" id="optionsRadios2" value="2" checked="">
                                                    Tidak Aktif
                                                </label> 
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <label class="radio inline">
                                                <input type="radio" name="status" required="" id="optionsRadios1" value="1">
                                                Aktif
                                            </label> 
                                            <label class="radio inline">
                                                <input type="radio" name="status" required="" id="optionsRadios2" value="2">
                                                Tidak Aktif
                                            </label> 
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Level</label>
                                    <div class="controls">
                                        <select name="level" required="">
                                            <option value="">Select..</option>
                                            <?php
                                            if (isset($_GET['edit'])) {
                                                if ($getRow['level'] == 1) {
                                                    ?>
                                                    <option value="1" selected="">Administrator</option>
                                                    <option value="2">Operator</option>
                                                <?php } else { ?>
                                                    <option value="1">Administrator</option>
                                                    <option value="2" selected="">Operator</option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="1">Administrator</option>
                                                <option value="2">Operator</option>    
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <?php if (isset($_GET['edit'])) { ?>
                                            <button type="submit" class="btn btn-success" name="update">Edit</button>
                                            <a href="user.php" class="btn btn-inverse">Batal</a>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-info" name="save">Simpan</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pendek</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Perintah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = $mysqli->query("SELECT * FROM tuser");
                                    foreach ($query as $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data['nama_pendek']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['password']; ?></td>
                                            <td>
                                                <?php
                                                if ($data['status'] == 1) {
                                                    echo "<label class='label label-success'>Active</label>";
                                                } else {
                                                    echo "<label class='label label-warning'>Not Active</label>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($data['level'] == 1) {
                                                    echo 'Administrator';
                                                } else {
                                                    echo 'Operator';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($_SESSION['id'] == $data['id']) { ?>
                                                <a href="account.php?edit=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>    
                                                <?php } else { ?>
                                                    <a href="?edit=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>    
                                                    <a href="?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
                                                    <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password doesn\'t match');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
</script>
<?php include "./include/footer.php"; ?>