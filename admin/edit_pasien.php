<?php
if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    include_once("../library/koneksi.php");
    $edit = mysqli_query($server, "SELECT * FROM pasien WHERE no_pasien='" . $_GET["nmr"] . "'");
    $editDb = mysqli_fetch_assoc($edit);

    if (isset($_POST["pasien"])) {
        include_once("../library/koneksi.php");

        // Sanitize user inputs
        $nama = mysqli_real_escape_string($server, $_POST["nama"]);
        $jk = mysqli_real_escape_string($server, $_POST["jk"]);
        $agama = mysqli_real_escape_string($server, $_POST["agama"]);
        $alamat = mysqli_real_escape_string($server, $_POST["alamat"]);
        $tgl = mysqli_real_escape_string($server, $_POST["tgl"]);
        $usia = mysqli_real_escape_string($server, $_POST["usia"]);
        $nomor = mysqli_real_escape_string($server, $_POST["nomor"]);
        $kk = mysqli_real_escape_string($server, $_POST["kk"]);
        $hub_kel = mysqli_real_escape_string($server, $_POST["hub_kel"]);

        mysqli_query($server, "UPDATE pasien SET nm_pasien='$nama', j_kel='$jk', agama='$agama', alamat='$alamat', tgl_lhr='$tgl', usia='$usia', no_tlp='$nomor', nm_kk='$kk', hub_kel='$hub_kel' WHERE no_pasien='" . $_GET["nmr"] . "'");
        echo "<meta http-equiv='refresh' content='0; url=?menu=pasien'>";
        echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Berhasil mengedit data!!</b>
            </div><center>";
    }
}
?>

<div class="span9">
    <div class="well" style="fixed:center;">
        <b>SIRS - Guthul Developer</b>
        <p style="margin-top:10px;">
            <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-4">Nama Pasien</label>
                    <div class="col-lg-4">
                        <input type="text" name="nama" value="<?php echo $editDb["nm_pasien"];?>" required class="form-control" />
                    </div>
                </div>
                <!-- ... (other form fields) ... -->
                <div class="form-actions no-margin-bottom" style="text-align:center;">
                    <input type="submit" name="pasien" value="Simpan" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
