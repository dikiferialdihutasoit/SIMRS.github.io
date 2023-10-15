<?php
session_start();

if (isset($_POST["rm"])) {
    include_once("../library/koneksi.php");
    $kd_tindakan = $_POST["tdk"];
    $kd_obat = $_POST["obt"];
    $kd_user = $_POST["pn"];
    $no_pasien = $_POST["pas"];
    $diagnosa = $_POST["diag"];
    $resep = $_POST["res"];
    $keluhan = $_POST["kel"];
    $ket = $_POST["ket"];
    $tgl_pemeriksaan = time();

    $insertQuery = "INSERT INTO rekam_medis (kd_tindakan, kd_obat, kd_user, no_pasien, diagnosa, resep, keluhan, ket, tgl_pemeriksaan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($server, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "sssssssss", $kd_tindakan, $kd_obat, $kd_user, $no_pasien, $diagnosa, $resep, $keluhan, $ket, $tgl_pemeriksaan);

    if (mysqli_stmt_execute($insertStmt)) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=rekam'>";
        echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Berhasil menambah ke database!!</b>
            </div></center>";
    } else {
        echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Gagal menambah ke database!!</b>
            </div></center>";
    }
}
?>

<div class="box">
    <header>
        <h5>Tambah Rekam Medis</h5>
    </header>
    <div class="body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-lg-4">Tindakan</label>
                <div class="col-lg-4">
                    <select name="tdk" class="form-control">
                        <?php
                        include_once("../library/koneksi.php");
                        $tdk = "SELECT * FROM tindakan";
                        $tdkDb = mysqli_query($server, $tdk) or die(mysqli_error($server));
                        while ($tdkR = mysqli_fetch_assoc($tdkDb)) {
                            echo "<option value='" . $tdkR['kd_tindakan'] . "'>" . $tdkR['nm_tindakan'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Obat</label>
                <div class="col-lg-4">
                    <select name="obt" class="form-control">
                        <?php
                        $obt = "SELECT * FROM obat";
                        $obtDb = mysqli_query($server, $obt) or die(mysqli_error($server));
                        while ($obtR = mysqli_fetch_assoc($obtDb)) {
                            echo "<option value='" . $obtR['kd_obat'] . "'>" . $obtR['nm_obat'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Pengentri</label>
                <div class="col-lg-4">
                    <select name="pn" class="form-control">
                        <?php
                        $pn = "SELECT * FROM login";
                        $pnDb = mysqli_query($server, $pn) or die(mysqli_error($server));
                        while ($pnR = mysqli_fetch_assoc($pnDb)) {
                            echo "<option value='" . $pnR['kd_user'] . "'>" . $pnR['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Pasien</label>
                <div class="col-lg-4">
                    <select name="pas" class="form-control">
                        <?php
                        $pas = "SELECT * FROM pasien ORDER BY nm_pasien ASC";
                        $pasDb = mysqli_query($server, $pas) or die(mysqli_error($server));
                        while ($pasR = mysqli_fetch_assoc($pasDb)) {
                            echo "<option value='" . $pasR['no_pasien'] . "'>" . $pasR['nm_pasien'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Diagnosa</label>
                <div class="col-lg-4">
                    <select name="diag" class="form-control">
                        <option value="gejala">Gejala</option>
                        <option value="terjangkit">Terjangkit</option>
                        <option value="stadium">Stadium</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Resep</label>
                <div class="col-lg-4">
                    <input type="text" required name="res" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Keluhan</label>
                <div class="col-lg-4">
                    <textarea required name="kel" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Keterangan</label>
                <div class="col-lg-4">
                    <textarea required name="ket" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-actions no-margin-bottom" style="text-align:center;">
                <input type="submit" name="rm" value="Simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
