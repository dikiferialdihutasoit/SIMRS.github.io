<?php
if(isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    include_once("../library/koneksi.php");
    $nmr = mysqli_real_escape_string($server, $_GET["nmr"]);
    $edit = mysqli_query($server, "SELECT * FROM laboratorium WHERE kd_lab='$nmr'");
    $editDb = mysqli_fetch_assoc($edit);
    
    if(isset($_POST["lab"])) {
        include_once("../library/koneksi.php");
        $tgl = mysqli_real_escape_string($server, $_POST["tgl"]);
        $hasil = mysqli_real_escape_string($server, $_POST["hasil"]);
        $ket = mysqli_real_escape_string($server, $_POST["ket"]);
        
        $updateQuery = "UPDATE laboratorium SET no_rm='$tgl', hasil_lab='$hasil', ket='$ket' WHERE kd_lab='$nmr'";
        if (mysqli_query($server, $updateQuery)) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=laborat'>";
            echo "<center><div class='alert alert-success alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <b>Berhasil mengedit data!!</b>
                </div></center>";
        } else {
            echo "Error: " . mysqli_error($server);
        }
    }
}
?>

<div class="span9">
    <div class="well" style="fixed:center;">
        <b>SIRS - Guthul Developer</b>
        <p style="margin-top:10px;">
            <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-4">Tanggal Rekam Medis</label>
                    <?php
                        include_once("../library/koneksi.php");
                        $rm = "SELECT * FROM rekam_medis";
                        $rmDb = mysqli_query($server, $rm) or die(mysqli_error($server));
                        $rmR = mysqli_fetch_assoc($rmDb);
                    ?>
                    <div class="col-lg-2">
                        <select name="tgl" class="form-control">
                            <?php
                            do {
                            ?>
                                <option value="<?php echo $rmR['no_rm'];?>"><?php echo $rmR['tgl_pemeriksaan'];?></option>
                            <?php
                            } while($rmR=mysqli_fetch_assoc($rmDb));
                            ?>	
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Hasil Laborat</label>
                    <div class="col-lg-4">
                        <input type="text" value="<?php echo $editDb["hasil_lab"];?>" required name="hasil" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Keterangan</label>
                    <div class="col-lg-4">
                        <textarea type="text" required name="ket" class="form-control"><?php echo $editDb["ket"];?></textarea>
                    </div>
                </div>
                <div class="form-actions no-margin-bottom" style="text-align:center;">
                    <input type="submit" name="lab" value="Simpan" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
