<?php
include_once("../library/koneksi.php");

if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    $kd_obat = $_GET["nmr"];
    $editDb = [];

    // Retrieve the obat data for editing
    $edit_query = "SELECT * FROM obat WHERE kd_obat = ?";
    $stmt = mysqli_prepare($server, $edit_query);
    mysqli_stmt_bind_param($stmt, "s", $kd_obat);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $editDb = mysqli_fetch_assoc($result);
    }

    if (isset($_POST["obt"])) {
        $nama = $_POST["nama"];
        $jml = $_POST["jml"];
        $ukr = $_POST["ukr"];
        $hrg = $_POST["hrg"];

        // Update the obat data
        $update_query = "UPDATE obat SET nm_obat=?, jml_obat=?, ukuran=?, harga=? WHERE kd_obat = ?";
        $stmt = mysqli_prepare($server, $update_query);
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $jml, $ukr, $hrg, $kd_obat);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ?menu=obat");
            exit();
        } else {
            echo "<meta http-equiv='refresh' content='0; url=?menu=obat'>";
            echo "<center><div class='alert alert-danger alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <b>Gagal mengedit data: " . mysqli_error($server) . "</b>
            </div></center>";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<div class="box">
    <header>
        <h5>Edit Obat</h5>
    </header>
    <div class="body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-lg-4">Nama Obat</label>
                <div class="col-lg-4">
                    <input type="text" value="<?php echo $editDb["nm_obat"]; ?>" required name="nama" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Jumlah Obat</label>
                <div class="col-lg-4">
                    <input type="text" value="<?php echo $editDb["jml_obat"]; ?>" required name="jml" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Ukuran</label>
                <div class="col-lg-4">
                    <input type="text" value="<?php echo $editDb["ukuran"]; ?>" required name="ukr" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Harga (Rp.)</label>
                <div class="col-lg-4">
                    <input type="text" value="<?php echo $editDb["harga"]; ?>" required name="hrg" class="form-control" />
                </div>
            </div>
            <div class="form-actions no-margin-bottom" style="text-align:center;">
                <input type="submit" name="obt" value="Simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>
