<?php
include_once("../library/koneksi.php");

if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    $kd_kunjungan = mysqli_real_escape_string($server, $_GET["nmr"]);
    $edit = mysqli_query($server, "SELECT * FROM kunjungan WHERE kd_kunjungan='$kd_kunjungan'");
    $editDb = mysqli_fetch_assoc($edit);
    if (isset($_POST["kjg"])) {
        include_once("../library/koneksi.php");
        $no_pasien = mysqli_real_escape_string($server, $_POST["nama"]);
        $kd_poli = mysqli_real_escape_string($server, $_POST["pol"]);
        $tgl_kunjungan = mysqli_real_escape_string($server, $_POST["tgl"]);
        $jam_kunjungan = mysqli_real_escape_string($server, $_POST["jam"]);
        
        mysqli_query($server, "UPDATE kunjungan SET no_pasien='$no_pasien', kd_poli='$kd_poli', tgl_kunjungan='$tgl_kunjungan', jam_kunjungan='$jam_kunjungan' WHERE kd_kunjungan='$kd_kunjungan'");
        echo "<meta http-equiv='refresh' content='0; url=?menu=kunjungan'>";
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
                    <label class="control-label col-lg-5">Nama Pasien</label>
                    <?php
                        $pas = "SELECT * FROM pasien";
                        $pasDb = mysqli_query($server, $pas) or die(mysqli_error($server));
                        $pasR = mysqli_fetch_assoc($pasDb);
                    ?>
                    <div class="col-lg-4">
                        <select name="nama" class="form-control">
                            <?php
                            do {
                            ?>
                            <option value="<?php echo $pasR['no_pasien'];?>"><?php echo $pasR['nm_pasien'];?></option>
                            <?php
                            } while($pasR = mysqli_fetch_assoc($pasDb));
                            ?>	
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-5">Kode Poliklinik</label>
                    <?php
                        $pol = "SELECT * FROM poliklinik";
                        $polDb = mysqli_query($server, $pol) or die(mysqli_error($server));
                        $polR = mysqli_fetch_assoc($polDb);
                    ?>
                    <div class="col-lg-4">
                        <select name="pol" class="form-control">
                            <?php
                            do {
                            ?>
                            <option value="<?php echo $polR['kd_poli'];?>"><?php echo $polR['nm_poli'];?></option>
                            <?php
                            } while($polR = mysqli_fetch_assoc($polDb));
                            ?>	
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">&nbsp;</label>
                    <div class="col-lg-4">
                        <input type="text" style="display:none" value="<?php echo date("Y-m-d") ?>" name="tgl" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">&nbsp;</label>
                    <div class="col-lg-4">
                        <input type="text" value="<?php echo date("g:i a")?>" style="display:none" name="jam" class="form-control"/>
                    </div>
                </div>
                <div class="form-actions no-margin-bottom" style="text-align:center;">
                    <input type="submit" name="kjg" value="Simpan" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
