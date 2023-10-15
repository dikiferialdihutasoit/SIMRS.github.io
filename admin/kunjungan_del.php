<?php
include_once("../library/koneksi.php");
if ($_GET) {
    if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
        $kd_kunjungan = mysqli_real_escape_string($server, $_GET["nmr"]);
        $del = "DELETE FROM kunjungan WHERE kd_kunjungan='$kd_kunjungan'";
        $delDb = mysqli_query($server, $del) or die("Error hapus data " . mysqli_error($server));
        if ($delDb) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=kunjungan'>";
        }
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Data yang dihapus tidak ada!!</b>
			</div><center>";
    }
}
?>
