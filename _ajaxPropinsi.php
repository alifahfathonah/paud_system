<?php
include "./config/connect.php";
$query = $mysqli->query("select * from tpropinsi where negara_id='". $_POST["negara_id"] ."'");

foreach ($query as $data) {
    ?>
    <option value="<?php echo $data["id"] ?>"><?php echo $data["propinsi"] ?></option><br>
    <?php
}
?>
   