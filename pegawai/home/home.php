<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='pegawai'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
include('../layout/header.php') 
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
                      <form action="">
                           <button type="submit" class="btn btn-success mt-2">Masuk</button>
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
                      <form action="">
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
</script>

<?php include('../layout/footer.php') ?>


