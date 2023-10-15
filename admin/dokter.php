<?php
include_once("../library/koneksi.php");

# untuk paging (pembagian halamanan)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;

// Count the total number of records
$pageSql = "SELECT * FROM dokter";
$pageQry = mysqli_query($server, $pageSql);
$jml = mysqli_num_rows($pageQry);
$max = ceil($jml / $row);
?>

<a href="?menu=dokter_add" class="btn btn-primary btn-rect"><i class='icon icon-white icon-plus'></i> Tambah Dokter</a><p>
<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Dokter
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Kode Dokter</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Nama Dokter</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kjgSql = "SELECT * FROM dokter ORDER BY kd_dokter DESC LIMIT $hal, $row";
                    $kjgQry = mysqli_query($server, $kjgSql);
                    $nomor = 0;
                    while ($kjg = mysqli_fetch_array($kjgQry)) {
                        ?>
                        <tr>
                            <td><?php echo $kjg['kd_dokter']; ?></td>
                            <td><?php echo $kjg['tgl_kunjungan']; ?></td>
                            <td><?php echo $kjg['nm_dokter']; ?></td>
                            <td>
                                <div class='btn-group'>
                                    <a href="?menu=dokter_del&aksi=hapus&nmr=<?php echo $kjg['kd_dokter']; ?>" class="btn btn-xs btn-danger tipsy-kiri-atas" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><i class="icon-remove icon-white"></i></a>
                                    <a href="?menu=dokter_edit&aksi=edit&nmr=<?php echo $kjg['kd_dokter']; ?>" class="btn btn-xs btn-info tipsy-kiri-atas" title='Edit Data ini'> <i class="icon-edit icon-white"></i> </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <ul class="pagination">
                        <?php
                        for ($h = 1; $h <= $max; $h++) {
                            $list[$h] = $row * $h - $row;
                            echo "<li><a href='?menu=dokter&hal=$list[$h]'>$h</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
