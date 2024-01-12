<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<style>
    #map{
        height: 300px;
    }
</style>

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
                        <div id="map"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endwhile; ?>

<script>

   

     let map = L.map('map').setView([ -2.129281618991526, 106.11606181165806], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([-2.129281618991526, 106.11606181165806]).addTo(map);
</script>

<?php include('../layout/footer.php') ?>

