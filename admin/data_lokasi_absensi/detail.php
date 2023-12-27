<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Data Detail Lokasi Absensi";
include('../layout/header.php');
require_once('../../config.php');

$id = $_GET['id'];
$result = mysqli_query($connection, "SELECT * FROM lokasi_absensi WHERE id=$id");

?>

<?php while($lokasi= mysqli_fetch_array($result)) : ?>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>nama Lokasi</td>
                                    <td>: <?php echo $lokasi['nama_lokasi'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat Lokasi</td>
                                    <td>: <?php echo $lokasi['alamat_lokasi'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe Lokasi</td>
                                    <td>: <?php echo $lokasi['tipe_lokasi'] ?></td>
                                </tr>
                                <tr>
                                    <td>latitude Lokasi</td>
                                    <td>: <?php echo $lokasi['latitude'] ?></td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td>: <?php echo $lokasi['longitude'] ?></td>
                                </tr>
                                <tr>
                                    <td>Radius</td>
                                    <td>: <?php echo $lokasi['radius'] ?></td>
                                </tr>
                                <tr>
                                    <td>Zona Waktu</td>
                                    <td>: <?php echo $lokasi['zona_waktu'] ?></td>
                                </tr>
                                <tr>
                                    <td>Jam Masuk</td>
                                    <td>: <?php echo $lokasi['jam_masuk'] ?></td>
                                </tr>
                                <tr>
                                    <td>jam Pulang</td>
                                    <td>: <?php echo $lokasi['jam_pulang'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1813.7383580116127!2d<?php echo $lokasi['longitude'] ?>!3d<?php echo $lokasi['latitude'] ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c0daa94b5501%3A0x8238d730aaca9b7d!2sGedung%20Setia%20Bhakti%20Pasir%20Putih!5e0!3m2!1sen!2sid!4v1703689263066!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endwhile; ?>

<?php include('../layout/footer.php') ?>