<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['savePeserta_didik'])) {
            $nama_lengkap = $mysqli->real_escape_string($_POST['nama_lengkap']);
            $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
            $tempat_lahir = $mysqli->real_escape_string($_POST['tempat_lahir']);
            $tanggal_lahir = $mysqli->real_escape_string($_POST['tanggal_lahir']);
            $agama = $mysqli->real_escape_string($_POST['agama']);
            $nama_ibu = $mysqli->real_escape_string($_POST['nama_ibu']);
            $pekerjaan_orangtua = $mysqli->real_escape_string($_POST['pekerjaan_orangtua']);
            $negara_id = $mysqli->real_escape_string($_POST['negara_id']);
            $propinsi_id = $mysqli->real_escape_string($_POST['propinsi_id']);
            $kota_id = $mysqli->real_escape_string($_POST['kota_id']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $create_at = date('Y-m-d');
            $update_at = date('Y-m-d');

            $folder = "images/";

            $imageName = $_FILES['image']['name'];
            $imageType = $_FILES['image']['type'];
            $imageSize = $_FILES['image']['size'];

            if ($imageType == "image/jpg" || $imageType == "image/png" || $imageType == "image/jpeg") {
                $image = $folder . basename($imageName);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                    $query = $mysqli->query("INSERT INTO tpeserta_didik(nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, nama_ibu, pekerjaan_orangtua, negara_id, propinsi_id, kota_id, deskripsi, image, create_at, update_at) 
                                            VALUES('$nama_lengkap', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$agama', '$nama_ibu', '$pekerjaan_orangtua', '$negara_id', '$propinsi_id', '$kota_id', '$deskripsi', '$image', '$create_at', '$update_at')");
                    if ($query) {
                        header("Location: peserta_didik.php");
                    } else {
                        echo $mysqli->errno;
                    }
                }
            }
        }

        if (isset($_GET['editPeserta_didik'])) {
            $editPeserta_didik = $_GET['editPeserta_didik'];
            $query = $mysqli->query("SELECT * FROM tpeserta_didik WHERE id=" . $editPeserta_didik);
            $getRowPeserta_didik = $query->fetch_array();
        }
        //update proses//

        if (isset($_POST['updatePeserta_didik'])) {
            $updatePeserta_didik = $_GET['editPeserta_didik'];
            $nama_lengkap = $mysqli->real_escape_string($_POST['nama_lengkap']);
            $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
            $tempat_lahir = $mysqli->real_escape_string($_POST['tempat_lahir']);
            $tanggal_lahir = $mysqli->real_escape_string($_POST['tanggal_lahir']);
            $agama = $mysqli->real_escape_string($_POST['agama']);
            $nama_ibu = $mysqli->real_escape_string($_POST['nama_ibu']);
            $pekerjaan_orangtua = $mysqli->real_escape_string($_POST['pekerjaan_orangtua']);
            $negara_id = $mysqli->real_escape_string($_POST['negara_id']);
            $propinsi_id = $mysqli->real_escape_string($_POST['propinsi_id']);
            $kota_id = $mysqli->real_escape_string($_POST['kota_id']);
            $deskripsi = $mysqli->real_escape_string($_POST['deskripsi']);
            $create_at = date('Y-m-d');
            $update_at = date('Y-m-d');

            $folder = "images/";

            $imageName = $_FILES['image']['name'];
            $imageType = $_FILES['image']['type'];
            $imageSize = $_FILES['image']['size'];


            if (empty($imageName)) {

                $query = $mysqli->query("UPDATE tpeserta_didik SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', agama='$agama', nama_ibu='$nama_ibu', pekerjaan_orangtua='$pekerjaan_orangtua', negara_id='$negara_id', propinsi_id='$propinsi_id', kota_id='$kota_id', update_at='$update_at' WHERE id='$updatePeserta_didik' ");
                header("Location: peserta_didik.php");
                die();
                
            } elseif (!empty($imageName)) {
                if ($imageType == "image/jpg" || $imageType == "image/png" || $imageType == "image/jpeg") {
                    $image = $folder . basename($imageName);
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                        $sql = $mysqli->query("UPDATE tpeserta_didik SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', agama='$agama', nama_ibu='$nama_ibu', pekerjaan_orangtua='$pekerjaan_orangtua', negara_id='$negara_id', propinsi_id='$propinsi_id', kota_id='$kota_id', image='$image', update_at='$update_at' WHERE id='$updatePeserta_didik' ");
                        if ($sql) {
                            header("Location: peserta_didik.php");
                        } else {
                            echo $mysqli->errno;
                        }
                    } else {
                        echo "gagal upload";
                    }
                } else {
                    echo "type image salah";
                }
            }
        }
        /*
         * delete process
         */

        if (isset($_GET['deletePeserta_didik'])) {
            $deletePeserta_didik = $_GET['deletePeserta_didik'];
            $query = $mysqli->query("DELETE FROM tpeserta_didik WHERE id='$deletePeserta_didik' ");
            header("Location: peserta_didik.php");
            die();
        }
        ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include './include/sidebar.php'; ?>
                    <div class="span9">
                        <div class="content">

                            <div class="module">
                                <div class="module-head">
                                    <b><i class="menu-icon fa fa-odnoklassniki"></i> Form Peserta Didik </b>
                                    <div class="row pull-right">
                                        <a href="list_peserta_didik.php" class="btn btn-mini btn-inverse"><i class="fa fa-list"></i> List Peserta Didik </a>
                                    </div>
                                </div>
                                <div class="module-body">
                                    <br />

                                    <form class="form-horizontal row-fluid" method="POST" enctype="multipart/form-data">
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Nama Lengkap</label>
                                            <div class="controls">
                                                <input type="text" name="nama_lengkap" class="span8 tip" value="<?php
                    if (isset($_GET['editPeserta_didik'])) {
                        echo $getRowPeserta_didik['nama_lengkap'];
                    }
                    ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Jenis Kelamin</label>
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editPeserta_didik'])) {
                                                    $editPeserta_didik = $_GET['editPeserta_didik'];
                                                    $query = $mysqli->query("select * from tpeserta_didik where id='$editPeserta_didik'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" name="jenis_kelamin" required="">
                                                    <option value="">Pilih Jenis Kelamin..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
                                                        $query = $mysqli->query("SELECT * FROM tjenis_kelamin");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['jenis_kelamin'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['jenis_kelamin'] . "</option>";
                                                        }
                                                    } else {
                                                        $queryAll = $mysqli->query("SELECT * FROM tjenis_kelamin");
                                                        //$dataAll = mysqli_fetch_array($queryAll);

                                                        foreach ($queryAll as $dataAll) {
                                                            ?>
                                                            <option value="<?php echo $dataAll['id'] ?>"><?php echo $dataAll['jenis_kelamin'] ?></option>   
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php ?>
                                                </select>
                                            </div>
                                        </div>
                                      <div class="control-group">
                                            <label class="control-label" for="basicinput">Tempat lahir</label>
                                             <div class="controls">
                                                <?php
                                                if (isset($_GET['editPeserta_didik'])) {
                                                    $query = $mysqli->query("SELECT * FROM tpeserta_didik WHERE id ='" . $editPeserta_didik . "'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" data-placeholder="Pilih here.." name="tempat_lahir" required="" >
                                                    <option value="">Pilih Tempat..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
                                                        $query = $mysqli->query("SELECT * FROM tkota");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['tempat_lahir'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['kota'] . "</option>";
                                                        }
                                                    } else {
                                                        $query = $mysqli->query("SELECT id, kota FROM tkota");
                                                        foreach ($query as $data) {
                                                            ?>
                                                            <option value="<?php echo $data['id']; ?>"><?php echo $data['kota']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Tanggal Lahir</label>
                                            <div class="controls">
                                                 
                                                 <?php
                                                if (isset($_GET['editPeserta_didik'])) { ?>
                                                <input type="date" name="tanggal_lahir" value="<?php  echo $getRowPeserta_didik['tanggal_lahir']; ?>" required="">
                                              <?php }else{ ?>
                                                 <input type="date" name="tanggal_lahir" required="">
                                               <?php
                                               }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Agama</label>
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editPeserta_didik'])) {
                                                    $editPeserta_didik = $_GET['editPeserta_didik'];
                                                    $query = $mysqli->query("select * from tpeserta_didik where id='$editPeserta_didik'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" name="agama" required="">
                                                    <option value="">Pilih Agama..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
                                                        $query = $mysqli->query("SELECT * FROM tagama");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['agama'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['agama'] . "</option>";
                                                        }
                                                    } else {
                                                        $queryAll = $mysqli->query("SELECT * FROM tagama");
                                                        //$dataAll = mysqli_fetch_array($queryAll);

                                                        foreach ($queryAll as $dataAll) {
                                                            ?>
                                                            <option value="<?php echo $dataAll['id'] ?>"><?php echo $dataAll['agama'] ?></option>   
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Nama Ibu</label>
                                            <div class="controls">
                                                <input type="text" name="nama_ibu" class="span8 tip" value="<?php
                                            if (isset($_GET['editPeserta_didik'])) {
                                                echo $getRowPeserta_didik['nama_ibu'];
                                            }
                                                    ?>">
                                            </div>
                                        </div> 
                                        <br>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Pekerjaan Orang Tua</label>
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editPeserta_didik'])) {
                                                    $editPeserta_didik = $_GET['editPeserta_didik'];
                                                    $query = $mysqli->query("select * from tpeserta_didik where id='$editPeserta_didik'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" name="pekerjaan_orangtua" required="">
                                                    <option value="">Pilih Pekerjaan Orang Tua..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
                                                        $query = $mysqli->query("SELECT * FROM tpekerjaan");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['pekerjaan_orangtua'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['pekerjaan'] . "</option>";
                                                        }
                                                    } else {
                                                        $queryAll = $mysqli->query("SELECT * FROM tpekerjaan");
                                                        //$dataAll = mysqli_fetch_array($queryAll);

                                                        foreach ($queryAll as $dataAll) {
                                                            ?>
                                                            <option value="<?php echo $dataAll['id'] ?>"><?php echo $dataAll['pekerjaan'] ?></option>   
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Alamat</label>
                                            <!-- Negara -->                                          
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editPeserta_didik'])) {
                                                    $query = $mysqli->query("SELECT * FROM tpeserta_didik WHERE id ='" . $editPeserta_didik . "'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" data-placeholder="Pilih here.." name="negara_id" required="" id="cmbNegara">
                                                    <option value="">Pilih negara..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
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
                                        <br>
                                        <!-- Propinsi -->
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput"></label>
                                            <div class="controls">
                                                <select tabindex="1" data-placeholder="Pilih here.." name="propinsi_id" required="" id="cmbPropinsi">
                                                    <option value="">Pilih propinsi..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
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
                                        <br>                                       
                                        <!-- Kota -->
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput"></label>
                                            <div class="controls">
                                                <select tabindex="1" data-placeholder="Pilih here.." name="kota_id" required="" id="cmbKota">
                                                    <option value="">Pilih kota..</option>
                                                    <?php
                                                    if (isset($_GET['editPeserta_didik'])) {
                                                        $query = $mysqli->query("SELECT * FROM tkota");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $selected = $data['kota_id'] == $row['id'] ? "selected" : "";

                                                            echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['kota'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <!--deskripsi-->
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput"></label>
                                            <div class="controls">
                                                <textarea class="span8" rows="5" name="deskripsi" required=""><?php
                                            if (isset($_GET['editPeserta_didik'])) {
                                                echo $getRowPeserta_didik['deskripsi'];
                                            }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><b>Foto</b></label>
                                            <?php if (isset($_GET['editPeserta_didik'])) { ?>
                                                <div class="controls">
                                                    <input type="file" name="image" >
                                                    <br> <i>* Kosongkan jika anda tidak ingin memperbaruinya</i>
                                                </div>
                                            <?php } else { ?>
                                                <div class="controls">
                                                    <input type="file" name="image" required="required">
                                                </div>                                      
                                            <?php } ?>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php if (isset($_GET['editPeserta_didik'])) { ?>
                                                    <button type="submit" class="btn btn-success" name="updatePeserta_didik">Edit</button>
                                                    <a href="peserta_didik.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="savePeserta_didik">Simpan</button>
                                                <?php } ?>
                                            </div>
                                        </div>                              
                                    </form>  
                                </div>                                                             
                            </div>
                        </div>
                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
        </div><!--/.wrapper-->

        <!--/.wrapper-->
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

                            getAjaxAlamat();
                        }
                    })
                });

                $("#cmbPropinsi").change(getAjaxAlamat);
                function getAjaxAlamat() {

                    var idPropinsi = $("#cmbPropinsi").val();

                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "_ajaxKota.php",
                        data: "propinsi_id=" + idPropinsi,
                        success: function (msg) {
                            if (msg == '') {
                                $("select#cmbKota").html('<option value="">--Pilih Kota--</option>');
                            } else {
                                $("select#cmbKota").html(msg);
                            }

                        }
                    });
                }
            });


        </script>


        <?php
        include './include/footer.php';
    } else {
        echo "Sorry, Your not authorization !";
        //header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>