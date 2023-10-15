<?php
include_once("../library/koneksi.php");

if(isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    $kd_obat = $_GET["nmr"];

    $del = "DELETE FROM obat WHERE kd_obat = ?";
    $stmt = mysqli_prepare($server, $del);
    mysqli_stmt_bind_param($stmt, "s", $kd_obat);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ?menu=obat");
        exit();
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <b>Error deleting data: " . mysqli_error($server) . "</b>
            </div></center>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <b>Data yang dihapus tidak ada!!</b>
            </div></center>";
}
?>
