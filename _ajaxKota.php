<?php
include "./config/connect.php";
$query = $mysqli->query("select * from tkota where propinsi_id='". $_POST["propinsi_id"] ."'");

foreach ($query as $data) {
    ?>
    <option value="<?php echo $data["id"] ?>"><?php echo $data["kota"] ?></option><br>
    <?php
}
?>