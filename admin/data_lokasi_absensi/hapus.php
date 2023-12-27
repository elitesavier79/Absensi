<?php 

session_start();
require_once('../../config.php');

$id = $_GET['id'];

$result = mysqli_query($connection, "DELETE FROM lokasi_absensi WHERE id=$id");

$_SESSION['berhasil'] = 'data berhasil di hapus';
header("location: lokasi_absensi.php");
exit;

include('../layout/footer.php');

?>