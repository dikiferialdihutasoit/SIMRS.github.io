<?php
include_once("../library/koneksi.php");
if(isset($_GET['aksi']) && isset($_GET['nmr'])) {
    $no_rm = $_GET['nmr'];

    // Prepare the DELETE statement with a parameter
    $delQuery = "DELETE FROM rekam_medis WHERE no_rm = ?";
    $delStmt = mysqli_prepare($server, $delQuery);
    mysqli_stmt_bind_param($delStmt, "s", $no_rm);

    if (mysqli_stmt_execute($delStmt)) {
        // Successful deletion
        echo "<meta http-equiv='refresh' content='0; url=?menu=rekam'>";
    } else {
        // Failed to delete
        echo "<center><div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Error deleting data: " . mysqli_error($server) . "</b>
        </div><center>";
    }
} else {
    echo "<center><div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Data yang dihapus tidak ada!!</b>
        </div><center>";
}
?>
