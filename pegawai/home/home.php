<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='pegawai'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
include('../layout/header.php'); 
include_once("../../config.php");

$lokasi_absensi = $_SESSION['lokasi_absensi'];
$result = mysqli_query($connection, "SELECT * FROM lokasi_absensi WHERE nama_lokasi = '$lokasi_absensi'");

while($lokasi = mysqli_fetch_array($result)) {
  $latitude_kantor = $lokasi['latitude'];
  $longitude_kantor = $lokasi['longitude'];
  $radius = $lokasi['radius'];
  $zona_waktu = $lokasi['zona_waktu'];
 
}



if($zona_waktu == 'WIB') {
  date_default_timezone_set('Asia/Jakarta');
}elseif($zona_waktu == 'WITA') {
  date_default_timezone_set('Asia/Makassar');
}elseif($zona_waktu == 'WIT'){
  date_default_timezone_set('Asia/Jayapura');
}

?>

<style>
  .waktu{
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    font-size: 20px;
    text-align:center;
    justify-content:center;

  }

  .jam{
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    font-size: 30px;
    text-align:center;
    font-weight:bold;
    justify-content:center;

  }

</style>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-4">
                <div class="card text-center">
                 <div class="card-header">Absensi Masuk</div>
                 <div class="card-body">
                      <div class="waktu">
                        <div id="tanggal_masuk"></div>
                        <div class="ms-2"></div>
                        <div id="bulan_masuk"></div>
                        <div class="ms-2"></div>
                        <div id="tahun_masuk"></div>
                      </div>
                      <div class="jam">
                        <div id="jam_masuk"></div>
                        <div>:</div>
                        <div id="menit_masuk"></div>
                        <div>:</div>
                        <div id="detik_masuk"></div>
                      </div>
                      <form action="<?php echo base_url('pegawai/absensi/absensi_masuk.php')?>" method="POST">
                      <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
                      <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">
                      <input type="hidden" name="latitude_kantor" value="<?php echo $latitude_kantor?>">
                      <input type="hidden" name="longitude_kantor" value="<?php echo $longitude_kantor?>">
                      <input type="hidden" name="radius" value="<?php echo $radius?>">
                      <input type="hidden" name="zona_waktu" value="<?php echo $zona_waktu ?>">
                      <input type="hidden" name="tanggal_masuk" value="<?php echo date('Y-m-d') ?>">
                      <input type="hidden" name="jam_masuk" value="<?php echo date('H:i:s') ?>">
                           <button type="submit" name="tombol_masuk" class="btn btn-success mt-2">Masuk</button>
                      </form>
                 </div>   
                 
                </div>
              </div>

              <div class="col-md-4">
                <div class="card text-center">
                 <div class="card-header">Absensi Keluar</div>
                 <div class="card-body">
                 <div class="waktu">
                        <div id="tanggal_keluar"></div>
                        <div class="ms-2"></div>
                        <div id="bulan_keluar"></div>
                        <div class="ms-2"></div>
                        <div id="tahun_keluar"></div>
                      </div>
                      <div class="jam">
                        <div id="jam_keluar"></div>
                        <div>:</div>
                        <div id="menit_keluar"></div>
                        <div>:</div>
                        <div id="detik_keluar"></div>
                      </div>
                      <form action="<?php echo base_url('pegawai/absensi/absensi_masuk.php')?>">
                           <button type="submit" class="btn btn-danger mt-2">Keluar</button>
                      </form>
                 </div>                   
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
        </div>
    
        
<script>
  // set waktu untuk waktu masu
  window.setTimeout("waktuMasuk()", 1000);
  namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
  function waktuMasuk() {
      const waktu = new Date();
      setTimeout("waktuMasuk()", 1000);
      document.getElementById("tanggal_masuk").innerHTML = waktu.getDate();
      document.getElementById("bulan_masuk").innerHTML = namaBulan[waktu.getMonth()];
      document.getElementById("tahun_masuk").innerHTML = waktu.getFullYear();
      document.getElementById("jam_masuk").innerHTML = waktu.getHours();
      document.getElementById("menit_masuk").innerHTML = waktu.getMinutes();
      document.getElementById("detik_masuk").innerHTML = waktu.getSeconds();
  }

  // set waktu untuk waktu keluar
  window.setTimeout("waktuKeluar()", 1000);
  namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
  function waktuKeluar() {
      const waktu = new Date();
      setTimeout("waktuKeluar()", 1000);
      document.getElementById("tanggal_keluar").innerHTML = waktu.getDate();
      document.getElementById("bulan_keluar").innerHTML = namaBulan[waktu.getMonth()];
      document.getElementById("tahun_keluar").innerHTML = waktu.getFullYear();
      document.getElementById("jam_keluar").innerHTML = waktu.getHours();
      document.getElementById("menit_keluar").innerHTML = waktu.getMinutes();
      document.getElementById("detik_keluar").innerHTML = waktu.getSeconds();
  }
  //mengambil posisi karyawan saat ini
  getlocation();

  function getlocation() {
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }else{
      alert("Browser Anda tidak memdukung")
    }
  }

  function showPosition(position) {
    $('#latitude_pegawai').val(position.coords.latitude);
    $('#longitude_pegawai').val(position.coords.longitude);
  }


</script>

<?php include('../layout/footer.php') ?>


