<?php
$server = mysqli_connect("localhost", "root", "");

if (!$server) {
    die("Maaf, Gagal tersambung dengan server: " . mysqli_connect_error());
}

$db = mysqli_select_db($server, "gd_sirs");

if (!$db) {
    die("Maaf, Gagal tersambung dengan database: " . mysqli_error($server));
}
?>
