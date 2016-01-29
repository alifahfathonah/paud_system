<?php
session_start();
include "./config/connect.php";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Triwulan.xls");
?>
<table width="1202" border="1">

    <tr>
        <td colspan="15"><p align="center">DAFTAR FORMASI PENDIDIK PENDIDIKAN USIA DINI</p>
            <p align="center">HIMPUNAN KEPENDIDIKAN DAN TENAGA KEPENDIDIKAN INDONESIA KECAMATAN DEPOK</p>
            <p align="center">TRIWULAN : I / II / III / IV TAHUN 2015</p></td>
    </tr>
    <tr>
      <td colspan="15">&nbsp;</td>
    </tr>

    <tr>
      <td width="29">&nbsp;</td>
        <td colspan="2">NPSN</td>
        <td width="35">:</td>
        <td colspan="4">&nbsp;</td>
        <td width="25" rowspan="5">&nbsp;</td>
        <td width="149">Jumlah Anak:</td>
        <td colspan="2"><div align="center">L = </div></td>
        <td colspan="3"><div align="center">P = </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
        <td colspan="2">Nama Lembaga</td>
        <td>:</td>
        <td colspan="4">Pos PAUD Kemuning </td>
        <td>Rincian      :</td>
        <td width="71">L</td>
        <td width="70">P</td>
        <td width="137">Usia</td>
        <td width="63">L</td>
        <td width="62">P</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
        <td colspan="2">Alamat Lembaga</td>
        <td>:</td>
        <td colspan="4">Jl. Nusa Indah II Gang Nakula 30 C Dero</td>
        <td rowspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
        <td colspan="2">No Ijin Operasional</td>
        <td>:</td>
        <td colspan="4">07/Kep.KD/2011</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
        <td colspan="2">Jumlah Kelompok</td>
        <td>:</td>
        <td colspan="4"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
        <td colspan="2">Jumlah Total Anak</td>
        <td>:</td>
        <td colspan="4"></td>
        <td colspan="2">Jumlah Pertemuan/minggu:</td>
        <td colspan="2">&nbsp;</td>
        <td>Lama Pembelajaran:</td>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="15">&nbsp;</td>
    </tr>

</table>
<table border="1">
    <thead>
        <tr>
            <td width="26">No</td>
            <td width="133">Nama Pendidik</td>
            <td>L/P</td>
            <td width="55">NUPTK</td>
            <td width="43">Status</td>
            <td width="55">Agama</td>
            <td width="86">Tempat Lahir</td>
            <td>Tanggal Lahir</td>
            <td>TMT</td>
            <td>Masa Kerja Seluruhnya</td>
            <td width="83">Pendidikan</td>
            <td>Pelatihan Berjenjang</td>
            <td>Mengajar Kelompok</td>
            <td>Jumlah Jam</td>
            <td>Alamat Rumah</td>
        </tr>
  </thead>
    <tbody>
        <?php
        $no = 1;
        $query = $mysqli->query("SELECT t.id, t.nama_lengkap, g.jenis_kelamin, t.nuptk, t.status, r.agama, t.tanggal_lahir, t.tanggal_masuk, t.masakerja_seluruhnya, t.pendidikan_terakhir, t.jurusan, t.tahun_lulus, t.pelatihan_berjenjang, t.mengajar_kelompok, t.jumlah_jam, t.deskripsi, ci.kota, re.propinsi, co.negara FROM tkaryawan t JOIN tjenis_kelamin g ON t.jenis_kelamin = g.id JOIN tagama r ON t.agama = r.id JOIN tnegara co ON t.negara_id = co.id JOIN tpropinsi re on t.propinsi_id = re.id JOIN tkota ci ON t.kota_id = ci.id ");
        foreach ($query as $data) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['nama_lengkap']; ?></td>
                <td><?php echo $data['jenis_kelamin']; ?></td>
                <td><?php echo $data['nuptk']; ?></td>
                <td><?php
                    if ($data['status'] == 1) {
                        echo "Kawin";
                    } elseif ($data['status'] == 2) {
                        echo "Belum Kawin";
                    }
                    ?></td>
                <td><?php echo $data['agama']; ?></td>
                <td><?php echo $data['kota']; ?></td>
                <td><?php echo $data['tanggal_lahir']; ?></td>
                <td><?php echo $data['tanggal_masuk']; ?></td>
                <td><?php echo $data['masakerja_seluruhnya']; ?></td>
                <td><?php echo $data['pendidikan_terakhir']; ?>,
                    <?php echo $data['jurusan']; ?>,
                    <?php echo $data['tahun_lulus']; ?>
                </td>
                <td><?php echo $data['pelatihan_berjenjang']; ?></td>
                <td><?php echo $data['mengajar_kelompok']; ?></td>
                <td><?php echo $data['jumlah_jam']; ?></td>
                <td><?php echo $data['deskripsi']; ?>
                    <?php echo $data['kota']; ?>
                    <?php echo $data['propinsi']; ?>
                    <?php echo $data['negara']; ?> 
                </td>


            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>