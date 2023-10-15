<?php
include_once("../library/koneksi.php");
if(isset($_GET['aksi']) && isset($_GET['nmr'])) {
    $no_rm = $_GET['nmr'];

    $edit = mysqli_query($server, "SELECT * FROM rekam_medis WHERE no_rm='$no_rm'");
    $editDb = mysqli_fetch_assoc($edit);

    if(isset($_POST['rm'])) {
        $kd_tindakan = $_POST['tdk'];
        $kd_obat = $_POST['obt'];
        $kd_user = $_POST['pn'];
        $no_pasien = $_POST['pas'];
        $diagnosa = $_POST['diag'];
        $resep = $_POST['res'];
        $keluhan = $_POST['kel'];
        $ket = $_POST['ket'];
        $tgl_pemeriksaan = time();

        // Prepare the UPDATE statement with parameters
        $updateQuery = "UPDATE rekam_medis SET kd_tindakan=?, kd_obat=?, kd_user=?, no_pasien=?, diagnosa=?, resep=?, keluhan=?, ket=?, tgl_pemeriksaan=? WHERE no_rm=?";
        $updateStmt = mysqli_prepare($server, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "ssssssssi", $kd_tindakan, $kd_obat, $kd_user, $no_pasien, $diagnosa, $resep, $keluhan, $ket, $tgl_pemeriksaan, $no_rm);

        if (mysqli_stmt_execute($updateStmt)) {
            // Successful update
            echo "<meta http-equiv='refresh' content='0; url=?menu=rekam'>";
            echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Berhasil mengedit data!!</b>
            </div><center>";
        } else {
            // Failed to update
            echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Error updating data: " . mysqli_error($server) . "</b>
            </div><center>";
        }
    }
}
?>
<div class="span9">
	<div class="well" style="fixed:center;">
		<b>SIRS - Guthul Developer</b>
		<p style="margin-top:10px;">
			<form action="" method="post" class="form-horizontal">
				<!-- Your form fields here -->
			</form>
		</p>
	</div>
</div>
<?php ?>
