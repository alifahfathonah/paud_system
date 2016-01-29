<?php
session_start();
include "./config/connect.php";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Peserta_didik.xls");
?>
<div class="module-body">
    <table border="1">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Lengkap</td>
                <td>Jenis Kelamin</td>
                <td>Tempat Lahir</td>
                <td>Tanggal Lahir</td>
                <td>Agama</td>
                <td>Nama Ibu Kandung</td>
                <td>Pekerjaan Orang Tua</td>
                <td>Umur</td>
                <td>Alamat</td>            
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = $mysqli->query("SELECT s.id, s.nama_lengkap, g.jenis_kelamin, s.tanggal_lahir, r.agama, s.nama_ibu, e.pekerjaan, ci.kota, re.propinsi, co.negara, s.deskripsi FROM tpeserta_didik s JOIN tjenis_kelamin g ON s.jenis_kelamin = g.id JOIN tagama r ON s.agama = r.id JOIN tnegara co ON s.negara_id = co.id JOIN tpropinsi re ON s.propinsi_id = re.id JOIN tkota ci ON s.kota_id = ci.id JOIN tpekerjaan e ON s.pekerjaan_orangtua = e.id ");
            foreach ($query as $data) {
                ?>
                <?php
                $tgl_lahir = $data['tanggal_lahir'];
                $tgl_sekarang = date("Y-m-d");


                $sql = $mysqli->query("SELECT datediff ('$tgl_sekarang' , '$tgl_lahir') as selisih");
                $baca = mysqli_fetch_array($sql);

                $tahun = floor($baca['selisih'] / 365);
                $bulan = floor(($baca['selisih'] - ($tahun * 365)) / 30);
                $hari = $baca['selisih'] - $bulan * 30 - $tahun * 365;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama_lengkap']; ?></td>
                    <td><?php echo $data['jenis_kelamin']; ?></td>                   
                    <td><?php echo $data['kota']; ?></td>
                    <td><?php echo $data['tanggal_lahir']; ?></td>
                    <td><?php echo $data['agama']; ?></td>
                    <td><?php echo $data['nama_ibu']; ?></td>
                    <td><?php echo $data['pekerjaan']; ?></td>
                    <td><?php echo "$tahun tahun - $bulan bulan - $hari hari"; ?></td>
                    <td>
                        <?php echo $data['deskripsi']; ?>,
                        <?php echo $data['kota']; ?>,
                        <?php echo $data['propinsi']; ?>,
                        <?php echo $data['negara']; ?> 
                    </td>


                </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>