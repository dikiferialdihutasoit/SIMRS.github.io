<?php
include_once("../library/koneksi.php");

# Untuk paging (pembagian halamanan)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rekam_medis";
$pageResult = mysqli_query($server, $pageSql);

if (!$pageResult) {
    die("Error paging: " . mysqli_error($server));
}

$jml = mysqli_num_rows($pageResult);
$max = ceil($jml / $row);
?>

<a href="?menu=rekam_add" class="btn btn-primary btn-rect"><i class='icon icon-white icon-plus'></i> Tambah Rekam Medis</a><p>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Pasien
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="150">No Rekam Medis</th>
                        <th>No Pasien</th>
                        <th>Diagnosa</th>
                        <th>Resep</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <?php
                $rmSql = "SELECT * FROM rekam_medis ORDER BY no_rm DESC LIMIT $hal, $row";
                $rmResult = mysqli_query($server, $rmSql);

                if (!$rmResult) {
                    die("Query Rekam Medis salah: " . mysqli_error($server));
                }

                $nomor = 0;
                while ($rm = mysqli_fetch_array($rmResult)) {
                    $nomor++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rm['no_rm']; ?></td>
                            <td><?php echo $rm['no_pasien']; ?></td>
                            <td><?php echo ucwords($rm['diagnosa']); ?></td>
                            <td><?php echo $rm['resep']; ?></td>
                            <td><?php echo tanggal($rm['tgl_pemeriksaan']); ?></td>
                            <td>
                                <div class='btn-group'>
                                    <a href="?menu=rekam_del&aksi=hapus&nmr=<?php echo $rm['no_rm']; ?>" class="btn btn-xs btn-danger tipsy-kiri-atas" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><i class="icon-remove icon-white"></i></a>
                                    <a href="?menu=rekam_edit&aksi=edit&nmr=<?php echo $rm['no_rm']; ?>" class="btn btn-xs btn-info tipsy-kiri-atas" title='Edit Data ini'> <i class="icon-edit icon-white"></i> </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>

                <tr>
                    <td colspan="6" align="right">
                        <?php
                        for ($h = 1; $h <= $max; $h++) {
                            $list[$h] = $row * $h - $row;
                            echo "<ul class='pagination pagination-sm'><li><a href='?menu=rekam&hal=$list[$h]'>$h</a></li></ul>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
