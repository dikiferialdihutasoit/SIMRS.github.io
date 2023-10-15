<?php
session_start();

if (isset($_POST["dkt"])) {
    include_once("../library/koneksi.php");
    
    // Sanitize user inputs
    $pol = $_POST["pol"];
    $user = $_POST["user"];
    $nama = $_POST["nama"];
    $sip = $_POST["sip"];
    $no = $_POST["no"];
    $alt = $_POST["alt"];

    // Create a prepared statement
    $stmt = mysqli_prepare($server, "INSERT INTO dokter (kd_poli, tgl_kunjungan, kd_user, nm_dokter, sip, no_tlp, alamat) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt) {
        $tgl_kunjungan = time();
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $pol, $tgl_kunjungan, $user, $nama, $sip, $no, $alt);
        
        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=dokter'>";
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

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement could not be prepared
        echo "Error preparing the statement.";
    }
}
?>
