<?php
session_start();

if (isset($_POST["kjg"])) {
    include_once("../library/koneksi.php");
    $no_pasien = mysqli_real_escape_string($server, $_POST["nama"]);
    $kd_poli = mysqli_real_escape_string($server, $_POST["pol"]);
    $tgl_kunjungan = date("Y-m-d");
    $jam_kunjungan = date("g:i a");

    $query = "INSERT INTO kunjungan (no_pasien, kd_poli, tgl_kunjungan, jam_kunjungan) VALUES ('$no_pasien', '$kd_poli', '$tgl_kunjungan', '$jam_kunjungan')";
    $result = mysqli_query($server, $query);

    if ($result) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=kunjungan'>";
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
        <h5>Tambah Kunjungan</h5>
    </header>
    <div class="body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-lg-5">Nama Pasien</label>
                <?php
                include_once("../library/koneksi.php");
                $pas = "SELECT * FROM pasien";
                $pasDb = mysqli_query($server, $pas);
                ?>
                <div class="col-lg-4">
                    <select name="nama" class="form-control">
                        <?php
                        while ($pasR = mysqli_fetch_assoc($pasDb)) {
                        ?>
                        <option value="<?php echo $pasR['no_pasien']; ?>"><?php echo $pasR['nm_pasien']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-5">Kode Poliklinik</label>
                <?php
                include_once("../library/koneksi.php");
                $pol = "SELECT * FROM poliklinik";
                $polDb = mysqli_query($server, $pol);
                ?>
                <div class="col-lg-4">
                    <select name="pol" class="form-control">
                        <?php
                        while ($polR = mysqli_fetch_assoc($polDb)) {
                        ?>
                        <option value="<?php echo $polR['kd_poli']; ?>"><?php echo $polR['nm_poli']; ?></option>
                        <?php
                        }
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
