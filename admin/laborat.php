<?php
include_once("../library/koneksi.php");

# Untuk paging (pembagian halamanan)
$row = 20;
$hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 0;
$pageSql = "SELECT * FROM laboratorium";
$pageQry = mysqli_query($server, $pageSql) or die("Error paging: " . mysqli_error($server));
$jml = mysqli_num_rows($pageQry);
$max = ceil($jml / $row);
?>
<a href="?menu=laborat_add" class="btn btn-primary btn-rect"><i class='icon icon-white icon-plus'></i> Tambah Laboratorium</a><p>
<div class="panel panel-default">
    <div class="panel-heading">
        Laboratorium
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20">Nomor</th>
                        <th width="160">Kode Laboratorium</th>
                        <th width="150">No Rekam Medis</th>
                        <th>Hasil Lab</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php
                $labSql = "SELECT * FROM laboratorium ORDER BY kd_lab DESC LIMIT $hal, $row";
                $labQry = mysqli_query($server, $labSql) or die("Query laboratorium salah: " . mysqli_error($server));
                $nomor = $hal; // Start with the current page number
                while ($lab = mysqli_fetch_array($labQry)) {
                    $nomor++;
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $lab['kd_lab']; ?></td>
                            <td><?php echo $lab['no_rm']; ?></td>
                            <td><?php echo $lab['hasil_lab']; ?></td>
                            <td><?php echo $lab['ket']; ?></td>
                            <td>
                                <div class='btn-group'>
                                    <a href="?menu=laborat_del&aksi=hapus&nmr=<?php echo $lab['kd_lab']; ?>" class="btn btn-xs btn-danger tipsy-kiri-atas" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><i class="icon-remove icon-white"></i></a>
                                    <a href="?menu=laborat_edit&aksi=edit&nmr=<?php echo $lab['kd_lab']; ?>" class="btn btn-xs btn-info tipsy-kiri-atas" title='Edit Data ini'><i class="icon-edit icon-white"></i></a>
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
                                echo "<ul class='pagination pagination-sm'><li><a href='?menu=laborat&hal=$list[$h]'>$h</a></li></ul>";
                            }
                            ?></td>
                    </tr>
            </table>
        </div>
    </div>
</div>
