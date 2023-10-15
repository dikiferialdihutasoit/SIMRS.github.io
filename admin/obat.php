<?php
include_once("../library/koneksi.php");

# untuk paging (pembagian halamanan)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;

// Get the total number of rows in the obat table
$pageSql = "SELECT * FROM obat";
$pageQry = mysqli_query($server, $pageSql);

if (!$pageQry) {
    die("Error paging: " . mysqli_error($server));
}

$jml = mysqli_num_rows($pageQry);
$max = ceil($jml / $row);
?>
<a href="#myModal" class="btn btn-primary btn-rect" data-toggle="modal"><i class='icon icon-white icon-plus'></i> Tambah Obat</a>
<p>
<?php
if (isset($_POST["obt"])) {
    $nama = $_POST["nama"];
    $jml = $_POST["jml"];
    $ukr = $_POST["ukr"];
    $hrg = $_POST["hrg"];

    // Insert new obat data into the database
    $insert_query = "INSERT INTO obat (nm_obat, jml_obat, ukuran, harga) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($server, $insert_query);
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $jml, $ukr, $hrg);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ?menu=obat");
        exit();
    } else {
        echo "<meta http-equiv='refresh' content='0; url=?menu=obat'>";
        echo "<center><div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <b>Gagal menambah ke database: " . mysqli_error($server) . "</b>
        </div></center>";
    }

    mysqli_stmt_close($stmt);
}

// Function obat() is not defined in the provided code, so I omitted it.
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Obat
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="140">Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Obat</th>
                        <th>Ukuran</th>
                        <th>Harga (Rp.)</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>
                <?php
                $obtSql = "SELECT * FROM obat ORDER BY kd_obat DESC LIMIT $hal, $row";
                $obtQry = mysqli_query($server, $obtSql);

                if (!$obtQry) {
                    die("Query Obat salah: " . mysqli_error($server));
                }

                $nomor = 0;
                while ($obat = mysqli_fetch_array($obtQry)) {
                    $nomor++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $obat['kd_obat']; ?></td>
                            <td><?php echo $obat['nm_obat']; ?></td>
                            <td><?php echo $obat['jml_obat']; ?></td>
                            <td><?php echo $obat['ukuran']; ?></td>
                            <td align="right"><?php echo $obat['harga']; ?></td>
                            <td>
                                <div class='btn-group'>
                                    <a href="?menu=obat_del&aksi=hapus&nmr=<?php echo $obat['kd_obat']; ?>" class="btn btn-xs btn-danger tipsy-kiri-atas" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><i class="icon-remove icon-white"></i></a>
                                    <a href="?menu=obat_edit&aksi=edit&nmr=<?php echo $obat['kd_obat']; ?>" class="btn btn-xs btn-info tipsy-kiri-atas" title='Edit Data ini'> <i class="icon-edit icon-white"></i> </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
                <tr>
                    <td colspan="6" align="right">
                        <?php
                        for ($h = 1; $h <= $max; $h++) {
                            $list[$h] = $row * $h - $row;
                            echo "<ul class='pagination pagination-sm'><li><a href='?menu=obat&hal=$list[$h]'>$h</a></li></ul>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
