<?php
include_once("../library/koneksi.php");

if (isset($_GET["aksi"]) && isset($_GET["nmr"])) {
    // Sanitize input
    $kd_dokter = $_GET["nmr"];
    
    // Create a prepared statement
    $stmt = mysqli_prepare($server, "DELETE FROM dokter WHERE kd_dokter = ?");
    
    if ($stmt) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "s", $kd_dokter);
        
        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "<meta http-equiv='refresh' content='0; url=?menu=dokter'>";
        } else {
            echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b>Error deleting data.</b>
            </div><center>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement could not be prepared
        echo "Error preparing the statement.";
    }
} else {
    echo "<center><div class='alert alert-warning alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Data yang dihapus tidak ada!!</b>
			</div><center>";
}
?>
