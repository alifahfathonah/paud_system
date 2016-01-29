<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_POST['saveKaryawan'])) {
            $nama_lengkap = $mysqli->real_escape_string($_POST['nama_lengkap']);
            $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
            $nuptk = $mysqli->real_escape_string($_POST['nuptk']);
            $status = $mysqli->real_escape_string($_POST['status']);
            $agama = $mysqli->real_escape_string($_POST['agama']);
            $tempat_lahir = $mysqli->real_escape_string($_POST['tempat_lahir']);
            $tanggal_lahir = $mysqli->real_escape_string($_POST['tanggal_lahir']);
            $tanggal_masuk = $mysqli->real_escape_string($_POST['tanggal_masuk']);
            $masakerja_seluruhnya = $mysqli->real_escape_string($_POST['masakerja_seluruhnya']);
            $pendidikan_terakhir = $mysqli->real_escape_string($_POST['pendidikan_terakhir']);
            $tahun_lulus = $mysqli->real_escape_string($_POST['tahun_lulus']);
            $jurusan = $mysqli->real_escape_string($_POST['jurusan']);
            $pelatihan_berjenjang = $mysqli->real_escape_string($_POST['pelatihan_berjenjang']);
            $mengajar_kelompok = $mysqli->real_escape_string($_POST['mengajar_kelompok']);
            $jumlah_jam = $mysqli->real_escape_string($_POST['jumlah_jam']);
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
                    $query = $mysqli->query("INSERT INTO tkaryawan(nama_lengkap, jenis_kelamin, nuptk, status, agama, tempat_lahir, tanggal_lahir, tanggal_masuk, masakerja_seluruhnya, pendidikan_terakhir, tahun_lulus, jurusan, pelatihan_berjenjang, mengajar_kelompok, jumlah_jam, negara_id, propinsi_id, kota_id, deskripsi, image, create_at, update_at) VALUES
        ('$nama_lengkap', '$jenis_kelamin', '$nuptk', '$status', '$agama', '$tempat_lahir', '$tanggal_lahir', '$tanggal_masuk', '$masakerja_seluruhnya', '$pendidikan_terakhir', '$tahun_lulus', '$jurusan', '$pelatihan_berjenjang', '$mengajar_kelompok', '$jumlah_jam', '$negara_id', '$propinsi_id', '$kota_id', '$deskripsi', '$image', '$create_at', '$update_at')");
                    if ($query) {
                        header("Location: karyawan.php");
                    } else {
                        echo $mysqli->errno;
                    }
                }
            }
        }
        /*
         * edit proccess
         */

        if (isset($_GET['editKaryawan'])) {
            $editKaryawan = $_GET['editKaryawan'];
            $query = $mysqli->query("SELECT * FROM tkaryawan WHERE id=" . $editKaryawan);
            $getRowKaryawan = $query->fetch_array();
        }
//update proses//
        if (isset($_POST['updateKaryawan'])) {
            $updateKaryawan = $_GET['editKaryawan'];
            $nama_lengkap = $mysqli->real_escape_string($_POST['nama_lengkap']);
            $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
            $nuptk = $mysqli->real_escape_string($_POST['nuptk']);
            $status = $mysqli->real_escape_string($_POST['status']);
            $agama = $mysqli->real_escape_string($_POST['agama']);
            $tempat_lahir = $mysqli->real_escape_string($_POST['tempat_lahir']);
            $tanggal_lahir = $mysqli->real_escape_string($_POST['tanggal_lahir']);
            $tanggal_masuk = $mysqli->real_escape_string($_POST['tanggal_masuk']);
            $masakerja_seluruhnya = $mysqli->real_escape_string($_POST['masakerja_seluruhnya']);
            $pendidikan_terakhir = $mysqli->real_escape_string($_POST['pendidikan_terakhir']);
            $tahun_lulus = $mysqli->real_escape_string($_POST['tahun_lulus']);
            $jurusan = $mysqli->real_escape_string($_POST['jurusan']);
            $pelatihan_berjenjang = $mysqli->real_escape_string($_POST['pelatihan_berjenjang']);
            $mengajar_kelompok = $mysqli->real_escape_string($_POST['mengajar_kelompok']);
            $jumlah_jam = $mysqli->real_escape_string($_POST['jumlah_jam']);
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
                $query = $mysqli->query("UPDATE tkaryawan SET 
                    nama_lengkap='$nama_lengkap', 
                    jenis_kelamin='$jenis_kelamin', 
                    nuptk='$nuptk',
                    status='$status', 
                    agama='$agama', 
                    tempat_lahir='$tempat_lahir', 
                    tanggal_lahir='$tanggal_lahir', 
                    tanggal_masuk='$tanggal_masuk', 
                    masakerja_seluruhnya='$masakerja_seluruhnya',
                    pendidikan_terakhir='$pendidikan_terakhir', 
                    tahun_lulus='$tahun_lulus',
                    jurusan='$jurusan', 
                    pelatihan_berjenjang='$pelatihan_berjenjang',
                    mengajar_kelompok='$mengajar_kelompok',
                    jumlah_jam='$jumlah_jam',
                    negara_id='$negara_id',
                    propinsi_id='$propinsi_id',
                    kota_id='$kota_id',
                    deskripsi='$deskripsi',
                    create_at='$create_at',
                    update_at='$update_at'
                    WHERE id='$updateKaryawan' ");

                header("Location: karyawan.php");
                die();
            } elseif (!empty($imageName)) {
                if ($imageType == "image/jpg" || $imageType == "image/png" || $imageType == "image/jpeg") {
                    $image = $folder . basename($imageName);
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                        $sql = $mysqli->query("UPDATE tkaryawan SET 
                    nama_lengkap='$nama_lengkap', 
                    jenis_kelamin='$jenis_kelamin', 
                    nuptk='$nuptk',
                    status='$status', 
                    agama='$agama', 
                    tempat_lahir='$tempat_lahir', 
                    tanggal_lahir='$tanggal_lahir', 
                    tanggal_masuk='$tanggal_masuk', 
                    masakerja_seluruhnya='$masakerja_seluruhnya',
                    pendidikan_terakhir='$pendidikan_terakhir', 
                    tahun_lulus='$tahun_lulus',
                    jurusan='$jurusan', 
                    pelatihan_berjenjang='$pelatihan_berjenjang',
                    mengajar_kelompok='$mengajar_kelompok',
                    jumlah_jam='$jumlah_jam',
                    negara_id='$negara_id',
                    propinsi_id='$propinsi_id',
                    kota_id='$kota_id',
                    deskripsi='$deskripsi',
                    image='$image',
                    create_at='$create_at',
                    update_at='$update_at'
                    WHERE id='$updateKaryawan' ");
                        if ($sql) {
                            header("Location: karyawan.php");
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
        } else {
            
        }
        /*
         * delete process
         */
        if (isset($_GET['deleteKaryawan'])) {
            $deleteKaryawan = $_GET['deleteKaryawan'];
            $query = $mysqli->query("DELETE FROM tkaryawan WHERE id='$deleteKaryawan' ");
            header("Location: karyawan.php");
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
                                    <b><i class="menu-icon fa fa-graduation-cap"></i> Form Karyawan </b>
                                    <div class="row pull-right">
                                        <a href="list_karyawan.php" class="btn btn-mini btn-inverse"><i class="fa fa-list"></i> List Karyawan </a>
                                    </div>
                                </div>
                                <div class="module-body">
                                    <br />

                                    <form class="form-horizontal row-fluid" method="POST" enctype="multipart/form-data">
                                        <div class="control-group">
                                            <input type="hidden" name="id" value="<?php
                                            if (isset($_GET['editKaryawan'])) {
                                                echo $getRowKaryawan['id'];
                                            }
                                            ?>">
                                            <label class="control-label" for="basicinput">Nama Lengkap</label>
                                            <div class="controls">
                                                <input type="text" name="nama_lengkap" class="span8 tip" value= "<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['nama_lengkap'];
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Jenis Kelamin</label>
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    $editKaryawan = $_GET['editKaryawan'];
                                                    $query = $mysqli->query("select * from tkaryawan where id='$editKaryawan'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" name="jenis_kelamin" required="" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['jenis_kelamin'];
                                                }
                                                ?>">
                                                    <option value="">Pilih Jenis Kelamin..</option>
                                                    <?php
                                                    if (isset($_GET['editKaryawan'])) {
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
                                            <label class="control-label" for="basicinput">NUPTK</label>
                                            <div class="controls">
                                                <input type="text" name="nuptk" class="span8 tip" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['nuptk'];
                                                }
                                                ?>" >
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Status</label>
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    if ($getRowKaryawan['status'] == 1) {
                                                        ?>
                                                        <label class="radio inline">
                                                            <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
                                                            Kawin
                                                        </label> 
                                                        <label class="radio inline">
                                                            <input type="radio" name="status" id="optionsRadios2" value="2">
                                                            Belum Kawin
                                                        </label> 
                                                    <?php } else {
                                                        ?>
                                                        <label class="radio inline">
                                                            <input type="radio" name="status" id="optionsRadios1" value="1">
                                                            Kawin
                                                        </label> 
                                                        <label class="radio inline">
                                                            <input type="radio" name="status" id="optionsRadios2" value="2" checked="">
                                                            Belum Kawin
                                                        </label> 
                                                    <?php }
                                                    ?>

                                                <?php } else { ?>
                                                    <label class="radio inline">
                                                        <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
                                                        Kawin
                                                    </label> 
                                                    <label class="radio inline">
                                                        <input type="radio" name="status" id="optionsRadios2" value="2">
                                                        Belum Kawin
                                                    </label>                                                  
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Agama</label>
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    $editKaryawan = $_GET['editKaryawan'];
                                                    $query = $mysqli->query("select * from tkaryawan where id='$editKaryawan'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" name="agama" required="">
                                                    <option value="">Pilih Agama..</option>
                                                    <?php
                                                    if (isset($_GET['editKaryawan'])) {
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
                                            <label class="control-label" for="basicinput">Tempat lahir</label>
                                             <div class="controls">
                                                <?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    $query = $mysqli->query("SELECT * FROM tkaryawan WHERE id ='" . $editKaryawan . "'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" data-placeholder="Pilih here.." name="tempat_lahir" required="" >
                                                    <option value="">Pilih Tempat..</option>
                                                    <?php
                                                    if (isset($_GET['editKaryawan'])) {
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
                                                <?php if (isset($_GET['editKaryawan'])) { ?>
                                                    <input type="date" name="tanggal_lahir" value="<?php echo $getRowKaryawan['tanggal_lahir'] ?>" required="">
                                                <?php } else { ?>
                                                    <input type="date" name="tanggal_lahir" required="">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Tanggal Masuk</label>
                                            <div class="controls">
                                                <?php if (isset($_GET['editKaryawan'])) { ?>
                                                    <input type="date" name="tanggal_masuk" required="" value="<?php echo $getRowKaryawan['tanggal_masuk'] ?>">
                                                <?php } else { ?>
                                                    <input type="date" name="tanggal_masuk" required="">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Masa Kerja Seluruhnya</label>
                                            <div class="controls">
                                                <input type="text" name="masakerja_seluruhnya" class="span8 tip" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['masakerja_seluruhnya'];
                                                }
                                                ?>">
                                            </div>
                                        </div>                                         
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Pendidikan</label>
                                            <div class="controls">                                                
                                                <?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    if ($getRowKaryawan['pendidikan_terakhir'] == "SMA") {
                                                        ?>
                                                        <select name="pendidikan_terakhir">
                                                            <option selected="">Pilih Pendidikan Terakhir..</option>
                                                            <option >SMA</option>
                                                            <option >SMK</option>                                                        
                                                            <option>Diploma</option>
                                                            <option>S1</option>
                                                            <option>S2</option>
                                                        </select>                                                 
                                                    <?php } elseif ($getRowKaryawan['pendidikan_terakhir'] == "SMK") { ?>
                                                        <select name="pendidikan_terakhir">
                                                            <option>Pilih Pendidikan Terakhir..</option>
                                                            <option >SMA</option>
                                                            <option selected="">SMK</option>                                                  
                                                            <option>Diploma</option>
                                                            <option>S1</option>
                                                            <option>S2</option>
                                                        </select>        
                                                    <?php } elseif ($getRowKaryawan['pendidikan_terakhir'] == "Diploma") { ?>
                                                        <select name="pendidikan_terakhir">
                                                            <option>Pilih Pendidikan Terakhir..</option>
                                                            <option >SMA</option>
                                                            <option >SMK</option>                                                           
                                                            <option selected="">Diploma</option>
                                                            <option>S1</option>
                                                            <option>S2</option>
                                                        </select>   
                                                    <?php } elseif ($getRowKaryawan['pendidikan_terakhir'] == "S1") { ?>
                                                        <select name="pendidikan_terakhir">
                                                            <option>Pilih Pendidikan Terakhir..</option>
                                                            <option >SMA</option>
                                                            <option >SMK</option>
                                                            <option>MA</option>
                                                            <option >Diploma</option>
                                                            <option selected="">S1</option>
                                                            <option>S2</option>
                                                        </select>   
                                                    <?php } else { ?>
                                                        <select name="pendidikan_terakhir">
                                                            <option selected="">Pilih Pendidikan Terakhir..</option>
                                                            <option >SMA</option>
                                                            <option >SMK</option>
                                                            <option>MA</option>
                                                            <option>Diploma</option>
                                                            <option>S1</option>
                                                            <option>S2</option>
                                                        </select>     
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <select name="pendidikan_terakhir">
                                                        <option selected="">Pilih Pendidikan Terakhir..</option>
                                                        <option >SMA</option>
                                                        <option >SMK</option>
                                                        <option>MA</option>
                                                        <option>Diploma</option>
                                                        <option>S1</option>
                                                        <option>S2</option>
                                                    </select>     
                                                <?php } ?>
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput"></label>
                                            <div class="controls">
                                                <?php if (isset($_GET['editKaryawan'])) { ?>
                                                    <select name="tahun_lulus">
                                                        <option value="">Pilih Tahun Lulus..</option>
                                                        <?php
                                                        for ($i = 1970; $i <= 2025; $i++) {

                                                            echo" <option>$i</option>";
                                                        }
                                                        ?>
                                                    </select> Tahun lulus sebelumnya : <b><?php echo $getRowKaryawan['tahun_lulus']; ?></b>
                                                    <br> <i>* Kosongkan jika tidak ingin dipebarui.</i>
                                                <?php } else { ?>
                                                    <select name="tahun_lulus" required="">
                                                        <option value="">Pilih Tahun Lulus..</option>
                                                        <?php
                                                        for ($i = 1970; $i <= 2025; $i++) {

                                                            echo" <option>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                <?php } ?>

                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput"></label>
                                            <div class="controls">
                                                <input type="text" name="jurusan" placeholder="Pilih Jurusan.." class="span8 tip" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['jurusan'];
                                                }
                                                ?>">
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Pelatihan Berjenjang</label>
                                            <div class="controls">
                                                <input type="text" name="pelatihan_berjenjang" class="span8 tip" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['pelatihan_berjenjang'];
                                                }
                                                ?>">
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Mengajar Kelompok</label>
                                            <div class="controls">
                                                <input type="text" name="mengajar_kelompok" class="span8 tip" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['mengajar_kelompok'];
                                                }
                                                ?>">
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Jumlah Jam</label>
                                            <div class="controls">
                                                <input type="text" name="jumlah_jam" class="span8 tip" value="<?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    echo $getRowKaryawan['jumlah_jam'];
                                                }
                                                ?>">
                                            </div>
                                        </div> 

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Alamat</label>
                                            <!-- Negara -->                                          
                                            <div class="controls">
                                                <?php
                                                if (isset($_GET['editKaryawan'])) {
                                                    $query = $mysqli->query("SELECT * FROM tkaryawan WHERE id ='" . $editKaryawan . "'");
                                                    $data = mysqli_fetch_assoc($query);
                                                }
                                                ?>
                                                <select tabindex="1" data-placeholder="Pilih here.." name="negara_id" required="" id="cmbNegara">
                                                    <option value="">Pilih negara..</option>
                                                    <?php
                                                    if (isset($_GET['editKaryawan'])) {
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
                                                    if (isset($_GET['editKaryawan'])) {
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
                                                    if (isset($_GET['editKaryawan'])) {
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
                                                    if (isset($_GET['editKaryawan'])) {
                                                        echo $getRowKaryawan['deskripsi'];
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><b>Foto</b></label>
                                            <?php if (isset($_GET['editKaryawan'])) { ?>
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
                                                <?php if (isset($_GET['editKaryawan'])) { ?>
                                                    <button type="submit" class="btn btn-success" name="updateKaryawan">Edit</button>
                                                    <a href="karyawan.php" class="btn btn-inverse">Batal</a>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-info" name="saveKaryawan">Simpan</button>
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