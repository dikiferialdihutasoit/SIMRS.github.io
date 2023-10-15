<?php
if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    include_once("../library/koneksi.php");
    $kd_poli = $_GET["nmr"];
    $editQuery = "SELECT * FROM poliklinik WHERE kd_poli = ?";
    $stmt = mysqli_prepare($server, $editQuery);
    mysqli_stmt_bind_param($stmt, "s", $kd_poli);

    if (mysqli_stmt_execute($stmt)) {
        $editResult = mysqli_stmt_get_result($stmt);
        $editDb = mysqli_fetch_assoc($editResult);

        if (isset($_POST["poli"])) {
            include_once("../library/koneksi.php");
            $newNama = $_POST["nama"];
            $newLantai = $_POST["lnt"];

            $updateQuery = "UPDATE poliklinik SET nm_poli = ?, lantai = ? WHERE kd_poli = ?";
            $updateStmt = mysqli_prepare($server, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "sss", $newNama, $newLantai, $kd_poli);

            if (mysqli_stmt_execute($updateStmt)) {
                echo "<meta http-equiv='refresh' content='0; url=?menu=poliklinik'>";
                echo "<center><div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Berhasil mengedit data!!</b>
                </div></center>";
            } else {
                echo "<center><div class='alert alert-warning alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Error: " . mysqli_error($server) . "</b>
                </div></center>";
            }
        }
    }
}
?>
<div class="span9">
    <div class="well" style="text-align:center;">
        <b>SIRS - Guthul Developer</b>
        <p style="margin-top:10px;">
            <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-4">Nama Poliklinik</label>
                    <div class="col-lg-2">
                        <input type="text" required value="<?php echo $editDb["nm_poli"]; ?>" class="form-control" name="nama" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Lantai</label>
                    <div class="col-lg-4">
                        <input type="text" value="<?php echo $editDb["lantai"]; ?>" required class="form-control" name="lnt" />
                    </div>
                </div>
                <div class="form-actions no-margin-bottom" style="text-align:center;">
                    <input type="submit" name="poli" value="Simpan" class="btn btn-primary" />
                </div>
            </form>
        </p>
    </div>
</div>
