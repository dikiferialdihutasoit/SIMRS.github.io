<?php
include_once("../library/koneksi.php");

if(isset($_GET["aksi"]) && isset($_GET["nmr"])){
    $no_pasien = $_GET["nmr"];
    
    // Ensure that $no_pasien is a valid number or you may encounter SQL injection vulnerabilities.
    
    $del = "DELETE FROM pasien WHERE no_pasien='" . mysqli_real_escape_string($server, $no_pasien) . "'";
    $delDb = mysqli_query($server, $del);
    
    if ($delDb) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=pasien'>";
    } else {
        echo "Error: " . mysqli_error($server);
    }
} else {
    echo "<center><div class='alert alert-warning alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <b>Data yang dihapus tidak ada!!</b>
    </div><center>";
}
?>
