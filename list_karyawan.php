<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_GET['editKaryawan'])) {
            $editKaryawan = $_GET['editKaryawan'];
            $query = $mysqli->query("SELECT * FROM tkaryawan WHERE id=" . $editKaryawan);
            $getRowKaryawan = $query->fetch_array();
        }
        //delete
        if (isset($_GET['deleteKaryawan'])) {
            $deleteKaryawan = $_GET['deleteKaryawan'];
            $query = $mysqli->query("DELETE FROM tkaryawan WHERE id='$deleteKaryawan' ");
            header("Location: list_karyawan.php");
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
                                    <b><i class="menu-icon fa fa-graduation-cap"></i> List Karyawan </b>
                                    <div class="row pull-right">
                                        <a href="karyawan.php" class="btn btn-mini btn-info"><i class="fa fa-plus"></i> Tambah Karyawan</a>                                        
                                        <a href="export_excel.php" class="btn btn-mini btn-primary"><i class="fa fa-file-excel-o"></i> Export Ke Excel</a>                                                                              
                                    </div>
                                </div>
                                <div class="module-body">
                                    <table class="table table-striped table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>                                              
                                            <th>Foto</th>                                                                                        
                                            <th>Perintah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = $mysqli->query("SELECT * FROM tkaryawan");
                                        foreach ($query as $data) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data['nama_lengkap']; ?></td>
                                                <td><img src="<?php echo $data['image']; ?>" class="thumbnail" style="width: 70px; height: 70px"> </td>
                                                                                          
                                                <td>
                                                    <a href="karyawan.php?editKaryawan=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                    <a href="detail_karyawan.php?detailKaryawan=<?php echo $data['id']; ?>" class="btn btn-success"><i class=" icon-eye-open"></i></a>
                                                    <a href="list_karyawan.php?deleteKaryawan=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>
                                                    
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                                
                                <br>
                                
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
                                $("select#cmbKota").html('<option value="">--Select Kota--</option>');
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