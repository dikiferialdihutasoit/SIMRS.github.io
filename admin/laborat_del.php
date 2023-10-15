<?php
include_once("../library/koneksi.php");
if(isset($_GET['aksi']) && isset($_GET['nmr'])){
    $nmr = mysqli_real_escape_string($server, $_GET['nmr']);
    $del = "DELETE FROM laboratorium WHERE kd_lab='$nmr'";
    
    if (mysqli_query($server, $del)) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=laborat'>";
    } else {
        echo "Error hapus data " . mysqli_error($server);
    }
} else {
    echo "<center><div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>Data yang dihapus tidak ada!!</b>
        </div></center>";
}
?>
