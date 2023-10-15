<?php
include_once("../library/koneksi.php");

if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    // Check if the action is "edit" (you might need to adjust the action value as needed)
    if ($_GET["aksi"] === "edit") {
        $edit = "SELECT * FROM dokter WHERE kd_dokter='" . $_GET["nmr"] . "'";
        $editDb = mysqli_query($server, $edit);
        $editData = mysqli_fetch_assoc($editDb);

        if ($_POST["dkt"]) {
            // Sanitize user inputs
            $pol = $_POST["pol"];
            $tgl = $_POST["tgl"];
            $user = $_POST["user"];
            $nama = $_POST["nama"];
            $sip = $_POST["sip"];
            $tmp = $_POST["tmp"];
            $no = $_POST["no"];
            $alt = $_POST["alt"];

            // Update the doctor's data
            $updateQuery = "UPDATE dokter SET kd_poli='$pol', tgl_kunjungan='$tgl', kd_user='$user', nm_dokter='$nama', sip='$sip', tmpat_lhr='$tmp', no_tlp='$no', alamat='$alt' WHERE kd_dokter='" . $_GET["nmr"] . "'";
            $updateResult = mysqli_query($server, $updateQuery);

            if ($updateResult) {
                echo "<meta http-equiv='refresh' content='0; url=?menu=dokter'>";
                echo "<center><div class='alert alert-success alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <b>Berhasil mengedit data!!</b>
                </div><center>";
            } else {
                echo "<center><div class='alert alert-warning alert-dismissable'>
                      <button type='button' class='close' data-dismiss'alert' aria-hidden='true'>&times;</button>
                        <b>Error updating data: " . mysqli_error($server) . "</b>
                </div><center>";
            }
        }
    }
}
?>
