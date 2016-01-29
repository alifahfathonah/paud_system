<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['saveKota'])) {
            $kota = $mysqli->real_escape_string($_POST['kota']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $propinsi_id = $mysqli->real_escape_string($_POST['propinsi_id']);
            $negara_id = $mysqli->real_escape_string($_POST['negara_id']);

            $query = $mysqli->query("INSERT INTO tkota(id, kota, deskripsi, propinsi_id, negara_id) VALUES('', '$kota','$deskripsi','$propinsi_id','$negara_id')");
            if ($query) {
                header("Location: kota.php");
            } else {
                echo "Failed to add data !";
            }
        }

        if (isset($_GET['editKota'])) {
            $idEdit = $_GET['editKota'];
            $query = $mysqli->query("SELECT * FROM tkota WHERE id='$idEdit' ");
            $getRowKota = $query->fetch_array();
        }


        if (isset($_POST['updateKota'])) {
            $idUpdate = $_GET['editKota'];
            $kota = $mysqli->real_escape_string($_POST['kota']);
            $propinsi = $mysqli->real_escape_string($_POST['propinsi_id']);
            $negara = $mysqli->real_escape_string($_POST['negara_id']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);

            $query = $mysqli->query("UPDATE tkota SET kota='$kota', deskripsi='$deskripsi', propinsi_id='$propinsi', negara_id='$negara' WHERE id='$idUpdate' ");
            header("Location: kota.php");
            die();
        }
        /*
         * Kota delete process
         */

        if (isset($_GET['deleteKota'])) {
            $id = $_GET['deleteKota'];
            $query = $mysqli->query("DELETE FROM tkota WHERE id='$id' ");
            header("Location: kota.php");
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
                                                if (isset($_GET['editKota'])) {
                                                    $query = $mysqli->query("SELECT * FROM tkota WHERE id ='" . $idEdit . "'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" data-placeholder="Select here.." name="negara_id" required="" id="cmbNegara">
                                                    <option value="">Pilih Negara..</option>
                                                    <?php
                                                    if (isset($_GET['editKota'])) {
                                                        $query = $mysqli->query("SELECT * FROM tnegara");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['negara_id'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['negara'] . "</option>";
                                                        }
                                                    } else {
                                                        $query = $mysqli->query("SELECT id as idNegara, negara FROM tnegara");
                                                        foreach ($query as $data) {
                                                            ?>
                                                            <option value="<?php echo $data['idNegara']; ?>"><?php echo $data['negara']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Propinsi</label>
                                            <div class="controls">
                                                <select tabindex="1" data-placeholder="Select here.." name="propinsi_id" required="" id="cmbPropinsi">
                                                    <option value="">Pilih propinsi..</option>
                                                    <?php
                                                    if (isset($_GET['editKota'])) {
                                                        $query = $mysqli->query("SELECT * FROM tpropinsi");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['propinsi_id'] == $row['id'] ? "selected" : "";
                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['propinsi'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Kota</label>
                                            <div class="controls">
                                                <input type="text" name="kota" required="" value="<?php
                                                if (isset($_GET['editKota'])) {
                                                    echo $getRowKota['kota'];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Deskripsi</label>
                                            <div class="controls">
                                                <textarea class="span8" rows="5" name="deskripsi" required=""><?php
                                                    if (isset($_GET['editKota'])) {
                                                        echo $getRowKota['deskripsi'];
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php if (isset($_GET['editKota'])) { ?>
                                                    <button type="submit" class="btn btn-success" name="updateKota">Edit</button>
                                                    <a href="kota.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="saveKota">Simpan</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /form -->
                                    <br>
                                    <br>
                                    <!-- data gender -->
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Negara</th>
                                                <th>Propinsi</th>
                                                <th>Kota</th>
                                                <th>Deskripsi</th>
                                                <th>Perintah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query = $mysqli->query("SELECT tkota.id, tkota.kota, tpropinsi.propinsi, tkota.deskripsi, tnegara.negara FROM tkota INNER JOIN tnegara ON tkota.negara_id=tnegara.id INNER JOIN tpropinsi ON tkota.propinsi_id = tpropinsi.id");
                                            foreach ($query as $data) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['negara']; ?></td>
                                                    <td><?php echo $data['propinsi']; ?></td>
                                                    <td><?php echo $data['kota']; ?></td>
                                                    <td><?php echo $data['deskripsi']; ?></td>
                                                    <td>
                                                        <a href="kota.php?editKota=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                        <a href="kota.php?deleteKota=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
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
        <script type="text/javascript">
            $(function () {
                $("#cmbNegara").change(function () {

                    //variable dari niali combo box negara

                    var idNegara = $("#cmbNegara").val();

                    //mengirim dan mengambil data

                    $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: "_ajaxPropinsi.php",
                        data: "negara_id=" + idNegara,
                        success: function (msg) {

                            //jika tidak ada data
                            if (msg == '') {
                                alert("Data tidak ada");
                            } else {
                                $("#cmbPropinsi").html(msg);
                            }

                        }
                    })
                });
            });
        </script>



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