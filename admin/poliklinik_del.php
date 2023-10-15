<?php
include_once("../library/koneksi.php");

if ($_GET) {
    if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
        $kd_poli = $_GET["nmr"];
        $del = "DELETE FROM poliklinik WHERE kd_poli = ?";
        $stmt = mysqli_prepare($server, $del);
        mysqli_stmt_bind_param($stmt, "s", $kd_poli);

        if (mysqli_stmt_execute($stmt)) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=poliklinik'>";
        } else {
            echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Error: " . mysqli_error($server) . "</b>
                </div></center>";
        }
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Data yang dihapus tidak ada!!</b>
            </div><center>";
    }
}
?>
