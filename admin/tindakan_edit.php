<?php
if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    include_once("../library/koneksi.php");
    $kd_tindakan = $_GET["nmr"];
    $editSql = "SELECT * FROM tindakan WHERE kd_tindakan = ?";
    
    if ($stmt = mysqli_prepare($server, $editSql)) {
        mysqli_stmt_bind_param($stmt, "s", $kd_tindakan);
        $editDb = mysqli_stmt_execute($stmt);
        
        if ($editDb) {
            $result = mysqli_stmt_get_result($stmt);
            $editData = mysqli_fetch_assoc($result);
        } else {
            echo "<center><div class='alert alert-danger alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Error: " . mysqli_error($server) . "</b>
            </div><center>";
        }
        mysqli_stmt_close($stmt);
    }
    
    if (isset($_POST["tdk"])) {
        $nama = $_POST["nama"];
        $ket = $_POST["ket"];
        $updateSql = "UPDATE tindakan SET nm_tindakan = ?, ket = ? WHERE kd_tindakan = ?";
        
        if ($stmt = mysqli_prepare($server, $updateSql)) {
            mysqli_stmt_bind_param($stmt, "sss", $nama, $ket, $kd_tindakan);
            $updateDb = mysqli_stmt_execute($stmt);
            
            if ($updateDb) {
                echo "<meta http-equiv='refresh' content='0; url=?menu=tindakan'>";
                echo "<center><div class='alert alert-success alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <b>Berhasil mengedit data!!</b>
                </div><center>";
            } else {
                echo "<center><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <b>Error: " . mysqli_error($server) . "</b>
                </div><center>";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<div class="box">
    <header>
        <h5>Edit Tindakan</h5>
    </header>
    <div class="body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-lg-4">Nama Tindakan</label>
                <div class="col-lg-4">
                    <input type="text" value="<?php echo $editData["nm_tindakan"];?>" required name="nama" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Keterangan</label>
                <div class="col-lg-4">
                    <textarea type="text" required name="ket" class="form-control"><?php echo $editData["ket"];?></textarea>
                </div>
            </div>
            <div class="form-actions no-margin-bottom" style="text-align:center;">
                <input type="submit" name="tdk" value="Simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
