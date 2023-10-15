<?php
session_start();
if(isset($_POST["lab"])){
    include_once("../library/koneksi.php");
    
    $no_rm = mysqli_real_escape_string($server, $_POST["tgl"]);
    $hasil_lab = mysqli_real_escape_string($server, $_POST["hasil"]);
    $ket = mysqli_real_escape_string($server, $_POST["ket"]);

    $query = "INSERT INTO laboratorium (no_rm, hasil_lab, ket) VALUES ('$no_rm', '$hasil_lab', '$ket')";
    
    if (mysqli_query($server, $query)) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=laborat'>";
        echo "<center><div class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>Berhasil menambah ke database!!</b>
        </div><center>";
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>Gagal menambah ke database!!</b>
        </div><center>";
    }
}
?>

<div class="box">
    <header>
        <h5>Tambah Laboratorium</h5>
    </header>
    <div class="body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-lg-4">Tanggal Rekam Medis</label>
                <?php
                    include_once("../library/koneksi.php");
                    $rm = "SELECT * FROM rekam_medis";
                    $rmDb = mysqli_query($server, $rm) or die(mysqli_error($server));
                ?>
                <div class="col-lg-2">
                    <select name="tgl" class="form-control">
                        <?php
                        while ($rmR = mysqli_fetch_assoc($rmDb)) {
                            echo "<option value='{$rmR['no_rm']}'>{$rmR['tgl_pemeriksaan']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Hasil Laborat</label>
                <div class="col-lg-4">
                    <input type="text" required name="hasil" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Keterangan</label>
                <div class="col-lg-4">
                    <textarea type="text" required name="ket" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-actions no-margin-bottom" style="text-align:center;">
                <input type="submit" name="lab" value="Simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
