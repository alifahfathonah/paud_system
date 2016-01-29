<?php
session_start();
include "./config/connect.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
        include "./include/header.php";

        if (isset($_GET['editPeserta_didik'])) {
            $editPeserta_didik = $_GET['editPeserta_didik'];
            $query = $mysqli->query("SELECT * FROM tpeserta_didik WHERE id=" . $editPeserta_didik);
            $getRowPeserta_didik = $query->fetch_array();
        }
        //delete
        if (isset($_GET['deletePeserta_didik'])) {
            $deletePeserta_didik = $_GET['deletePeserta_didik'];
            $query = $mysqli->query("DELETE FROM tpeserta_didik WHERE id='$deletePeserta_didik' ");
            header("Location: list_peserta_didik.php");
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
                                    <b><i class="menu-icon fa fa-odnoklassniki"></i> List Peserta Didik </b>
                                    <div class="row pull-right">
                                        <a href="peserta_didik.php" class="btn btn-mini btn-info"><i class="fa fa-plus"></i> Tambah Peserta Didik</a>                                        
                                        <a href="export_excel_peserta_didik.php" class="btn btn-mini btn-primary"><i class="fa fa-file-excel-o"></i> Export Ke Excel</a>
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
                                            $query = $mysqli->query("SELECT * FROM tpeserta_didik");
                                            foreach ($query as $data) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['nama_lengkap']; ?></td>
                                                    <td><img src="<?php echo $data['image']; ?>" class="thumbnail" style="width: 70px; height: 70px"> </td>

                                                    <td>
                                                        <a href="peserta_didik.php?editPeserta_didik=<?php echo $data['id']; ?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                                        <a href="detail_peserta_didik.php?detailPeserta_didik=<?php echo $data['id']; ?>" class="btn btn-success"><i class=" icon-eye-open"></i></a>
                                                        <a href="list_peserta_didik.php?deletePeserta_didik=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this data ?');"><i class="icon-trash"></i></a>

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
                $("#cmbCountry").change(function () {

                    //variable dari niali combo box country

                    var idCountry = $("#cmbCountry").val();

                    //mengirim dan mengambil data

                    $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: "_ajaxRegion.php",
                        data: "country_id=" + idCountry,
                        success: function (msg) {

                            //jika tidak ada data
                            if (msg == '') {
                                alert("Data tidak ada");
                            } else {
                                $("#cmbRegion").html(msg);
                            }

                            getAjaxAlamat();
                        }
                    })
                });

                $("#cmbRegion").change(getAjaxAlamat);
                function getAjaxAlamat() {

                    var idRegion = $("#cmbRegion").val();

                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "_ajaxCity.php",
                        data: "region_id=" + idRegion,
                        success: function (msg) {
                            if (msg == '') {
                                $("select#cmbCity").html('<option value="">--Select City--</option>');
                            } else {
                                $("select#cmbCity").html(msg);
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