<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
ob_start();
if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='pegawai'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
include('../layout/header.php'); 
include_once("../../config.php");

if(isset($_POST['tombol_masuk'])) {
    $latitude_pegawai = $_POST['latitude_pegawai'];
    $longitude_pegawai = $_POST['longitude_pegawai'];
    $latitude_kantor = $_POST['latitude_kantor'];
    $longitude_kantor = $_POST['longitude_kantor'];
    $radius = $_POST['radius'];
    $zona_waktu = $_POST['zona_waktu'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $jam_masuk = $_POST['jam_masuk'];

}

$perbedaan_koordinat = $longitude_pegawai - $longitude_kantor;
$jarak = sin(deg2rad($latitude_pegawai)) * sin(deg2rad($latitude_kantor)) + cos(deg2rad($latitude_pegawai)) * cos(deg2rad($latitude_kantor)) * cos(deg2rad($perbedaan_koordinat));
$jarak = acos($jarak);
$jarak = rad2deg($jarak);

$mil = $jarak * 60 * 1.1515;
$km = $mil * 1.609344;
$m = $km * 1000;
 

?>
<?php if($m > $radius) { ?>
    <?php echo
    $_SESSION['gagal'] = "Anda berada di luar area kantor";
    header("location: ../home/home.php");
    exit;
    ?>
<?php }else { ?>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                        <div id="map"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body" style="margin: auto;">
                        <input type="hidden" id="id" value="<?php echo $_SESSION['id']?>">
                        <input type="hidden" id="tanggal_masuk" value="<?php echo $tanggal_masuk?>">
                        <input type="hidden" id="jam_masuk" value="<?php echo $jam_masuk?>">
                        <div id="my_camera"></div>
                        <div id="my_result"></div>
                        <div><?php echo date('d F Y', strtotime($tanggal_masuk)). ' - ' . $jam_masuk ?></div>
                        <button class="btn btn-primary mt-2" id="take-foto">Masuk</button>

                        </div>
                    </div>
                </div>           
             

            </div>
        </div>
    </div>
    <script language="JavaScript">
    Webcam.set({
    width: 320,
    height: 240,
    dest_width: 320,
    dest_height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90,
    force_flash: false
});

    Webcam.attach( '#my_camera' );
        document.getElementById('take-foto').addEventListener('click', function() {

            let id = document.getElementById('id').value;
            let tanggal_masuk = document.getElementById('tanggal_masuk').value;
            let jam_masuk = document.getElementById('jam_masuk').value;

            Webcam.snap( function(data_uri) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    window.location.href = '../home/home.php';
                    }
                };
                xhttp.open("POST", "absensi_masuk_aksi.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(
                    'photo=' + encodeURIComponent(data_uri) + 
                    '&id=' + id +
                    '&tanggal_masuk=' + tanggal_masuk +
                    '&jam_masuk=' + jam_masuk
                );   
            
        } );
    
    });

    //map leaft js
    let latitude_ktr = <?php echo $latitude_kantor ?>;
    let longitude_ktr = <?php echo $longitude_kantor ?>;

    let latitude_peg = <?php echo $latitude_pegawai ?>;
    let longitude_peg = <?php echo $longitude_pegawai ?>;

    let map = L.map('map').setView([latitude_ktr, longitude_ktr], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([latitude_ktr, longitude_ktr]).addTo(map);

    var circle = L.circle([latitude_peg, longitude_peg], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 200
}).addTo(map).bindPopup("Lokasi Anda Saat ini").openPopup();;

</script>

<script src="webcam.js"></script>

<?php }?>

<?php include('../layout/footer.php') ?>

