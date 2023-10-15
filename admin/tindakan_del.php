<?php
include_once("../library/koneksi.php");

if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    $kd_tindakan = $_GET["nmr"];
    $del = "DELETE FROM tindakan WHERE kd_tindakan=?";
    
    if ($stmt = mysqli_prepare($server, $del)) {
        mysqli_stmt_bind_param($stmt, "s", $kd_tindakan);
        $delDb = mysqli_stmt_execute($stmt);

        if ($delDb) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=tindakan'>";
        } else {
            echo "<center><div class='alert alert-danger alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Error: " . mysqli_error($server) . "</b>
            </div><center>";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Data yang dihapus tidak ada!!</b>
            </div><center>";
}
?>
