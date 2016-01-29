<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";
        /*
         * edit proccess
         */    
        if (isset($_GET['detailKaryawan'])) {
            $detailKaryawan = $_GET['detailKaryawan'];
            $query = $mysqli->query("SELECT * FROM tkaryawan WHERE id=" . $detailKaryawan);
            $getRowKaryawan = $query->fetch_array();
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
                                    <b><i class="menu-icon fa fa-graduation-cap"></i> Detail Karyawan </b>
                                    <div class="row pull-right">
                                        <a href="karyawan.php" class="btn btn-mini btn-info"><i class="fa fa-plus"></i> Tambah Karyawan</a>
                                        <a href="list_karyawan.php" class="btn btn-mini btn-primary"><i class="icon-backward"></i> Kembali</a>
                                    </div>
                                </div>
                                <div class="module-body">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <!--                                                <h3 class="panel-title">User information</h3>-->
                                            </div>
                                            <div class="panel-body">
                                                <?php
                                                $query = $mysqli->query("SELECT t.id, t.image, t.nama_lengkap, g.jenis_kelamin, t.nuptk, t.status, r.agama, t.tanggal_lahir, t.tanggal_masuk, t.masakerja_seluruhnya, t.pendidikan_terakhir, t.tahun_lulus, t.jurusan, t.pelatihan_berjenjang, t.mengajar_kelompok, t.jumlah_jam, t.deskripsi, ci.kota, re.propinsi, co.negara FROM tkaryawan t JOIN tjenis_kelamin g ON t.jenis_kelamin = g.id JOIN tagama r ON t.agama = r.id JOIN tnegara co ON t.negara_id = co.id JOIN tpropinsi re on t.propinsi_id = re.id JOIN tkota ci ON t.kota_id = ci.id WHERE t.id=" . $_GET['detailKaryawan']);
                                                foreach ($query as $data) {
                                                    ?>
                                                    <div class="row-fluid">
                                                        <div class="span3">
                                                            <img src="<?php echo $data['image']; ?>" class="thumbnail" style="width: 150px; height: 150px">
                                                        </div>
                                                        <div class="span6">
                                                            <strong><?php echo $data['nama_lengkap'] ?></strong><br><br>
                                                            <table class="table table-condensed table-responsive table-user-information">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Jenis Kelamin                  :</td>
                                                                        <td><?php echo $data['jenis_kelamin']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>NUPTK                   :</td>
                                                                        <td><?php echo $data['nuptk']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Status                  :</td>
                                                                        <td>
                                                                            <?php
                                                                            if($data['status'] == 1){
                                                                                echo "Kawin";
                                                                            }elseif($data['status'] == 2){
                                                                                echo "Belum Kawin";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Agama                :</td>
                                                                        <td><?php echo $data['agama']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tempat Lahir              :</td>
                                                                        <td><?php echo $data['kota']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tanggal Lahir           :</td>
                                                                        <td><?php echo $data['tanggal_lahir']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tanggal Masuk           :</td>
                                                                        <td><?php echo $data['tanggal_masuk']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Masa Kerja Seluruhnya  :</td>
                                                                        <td><?php echo $data['masakerja_seluruhnya']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pendidikan              :</td>
                                                                        <td><?php echo $data['pendidikan_terakhir']; ?>,
                                                                            <?php echo $data['jurusan']; ?>,
                                                                            <?php echo $data['tahun_lulus']; ?>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>Pelatihan berjenjang         :</td>
                                                                        <td><?php echo $data['pelatihan_berjenjang']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mengajar Kelompok          :</td>
                                                                        <td><?php echo $data['mengajar_kelompok']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jumlah Jam         :</td>
                                                                        <td><?php echo $data['jumlah_jam']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Alamat                 :</td>
                                                                        <td>
                                                                            <?php echo $data['deskripsi']; ?>,
                                                                            <?php echo $data['kota']; ?>,
                                                                            <?php echo $data['propinsi']; ?>,
                                                                            <?php echo $data['negara']; ?>                                                                                                              
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="panel-footer">
                                                <span class="pull-right">
                                                    <a href="karyawan.php?editKaryawan=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>                      
                                                    <a href="list_karyawan.php?deleteKaryawan=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                            </div>
                        </div>



                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
        </div><!--/.wrapper-->




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