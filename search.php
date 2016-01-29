<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";
       
        if (isset($_GET['detailPeserta_didik'])) {
            $detailPeserta_didik= $_GET['detailPeserta_didik'];
            $query = $mysqli->query("SELECT * FROM tpeserta_didik WHERE id=" . $detailPeserta_didik);
            $getRowPeserta_didik = $query->fetch_array();
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
                                    <b><i class="menu-icon fa fa-odnoklassniki"></i> Detail Peserta Didik </b>
                                    <div class="row pull-right">
                                        <a href="peserta_didik.php" class="btn btn-mini btn-info"><i class="fa fa-plus"></i> Tambah Peserta Didik</a>                                       
                                        <a href="index.php" class="btn btn-mini btn-primary"><i class="icon-backward"></i> Kembali</a>
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
                                                $search = $_POST['search'];
                                                $query = $mysqli->query("SELECT s.id, s.image, s.nama_lengkap, g.jenis_kelamin, s.tanggal_lahir, r.agama, s.nama_ibu, e.pekerjaan, ci.kota, re.propinsi, co.negara, s.deskripsi FROM tpeserta_didik s JOIN tjenis_kelamin g ON s.jenis_kelamin = g.id JOIN tagama r ON s.agama = r.id JOIN tnegara co ON s.negara_id = co.id JOIN tpropinsi re ON s.propinsi_id = re.id JOIN tkota ci ON s.kota_id = ci.id JOIN tpekerjaan e ON s.pekerjaan_orangtua = e.id where s.id='" . $search . "'");
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
                                                                        <td>Jenis Kelamin :</td>
                                                                        <td><?php echo $data['jenis_kelamin']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tempat Lahir :</td>
                                                                        <td><?php echo $data['kota']; ?></td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>Tanggal Lahir :</td>
                                                                        <td><?php echo $data['tanggal_lahir']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Agama :</td>
                                                                        <td><?php echo $data['agama']; ?></td>
                                                                    </tr>                                                                                                                                    
                                                                    <tr>
                                                                        <td>Nama Ibu :</td>
                                                                        <td><?php echo $data['nama_ibu']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pekerjaan Orang Tua :</td>
                                                                        <td><?php echo $data['pekerjaan']; ?></td>
                                                                    </tr>                                                               
                                                                    <tr>
                                                                        <td>Alamat :</td>
                                                                        <td>
                                                                            <?php echo $data['deskripsi']; ?>
                                                                            <?php echo $data['kota']; ?>
                                                                            <?php echo $data['propinsi']; ?>
                                                                            <?php echo $data['negara']; ?>,                                                                                                              
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
                                                    <a href="peserta_didik.php?editPeserta_didik=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>                      
                                                    <a href="list_peserta_didik.php?deletePeserta_didik=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
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