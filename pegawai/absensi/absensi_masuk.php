<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
 
echo $m;
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d996.770182433831!2d<?php echo $longitude_pegawai?>!3d<?php echo $latitude_pegawai?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c1415687cd0b%3A0x5756657a89d5103f!2shallo%20badut%20collection!5e0!3m2!1sen!2sid!4v1704720734831!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body" style="margin: auto;">
                            
                        <div id="my_camera" style="width:320px; height:240px;"></div>
                        <div id="my_result"></div>
                        <div><?php echo date('d F Y', strtotime($tanggal_masuk)). ' - ' . $jam_masuk ?></div>
                        <button class="btn btn-primary mt-2" id="take-foto">Masuk</button>

                        </div>
                    </div>
                </div>           
             

            </div>
        </div>
    </div>


<?php }?>
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
                    'photo=' + encodeURIComponent(data_uri)
                );   
            
        } );
    
    });
</script>

<script src="webcam.js"></script>
<?php include('../layout/footer.php') ?>