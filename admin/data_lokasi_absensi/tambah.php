<?php 
session_start();
ob_start();
if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Form Tambah Data Lokasi Absensi";
include('../layout/header.php');
require_once('../../config.php');

if(isset($_POST['submit'])){
    $nama_lokasi = htmlspecialchars($_POST['nama_lokasi']);
    $alamat_lokasi = htmlspecialchars($_POST['alamat_lokasi']);
    $tipe_lokasi = htmlspecialchars($_POST['tipe_lokasi']);
    $latitude = htmlspecialchars($_POST['latitude']);
    $longitude = htmlspecialchars($_POST['longitude']);
    $radius = htmlspecialchars($_POST['radius']);
    $zona_waktu = htmlspecialchars($_POST['zona_waktu']);
    $jam_masuk = htmlspecialchars($_POST['jam_masuk']);
    $jam_pulang = htmlspecialchars($_POST['jam_pulang']);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($nama_lokasi)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Nama lokasi Wajib diisi";
        }
        if(empty($alamat_lokasi)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Alamat lokasi Wajib diisi";
        }
        if(empty($tipe_lokasi)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Tipe lokasi Wajib dipilih";
        }
        if(empty($latitude)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Latitude Wajib diisi";
        }
        if(empty($longitude)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Longitute Wajib diisi";
        }
        if(empty($radius)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Radius Wajib diisi";
        }
        if(empty($zona_waktu)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Zona Waktu Wajib dipilih";
        }
        if(empty($jam_masuk)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Jam masuk Wajib diisi";
        }
        if(empty($jam_pulang)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Jam Pulang Wajib diisi";
        }

        if(!empty($pesan_kesalahan)) {
            $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
        }else{
            
            $result = mysqli_query($connection, "INSERT INTO lokasi_absensi(nama_lokasi, alamat_lokasi, tipe_lokasi, latitude, longitude, radius, zona_waktu, jam_masuk, jam_pulang)
                                         VALUES('$nama_lokasi', ' $alamat_lokasi', '$tipe_lokasi', '$latitude', '$longitude', '$radius', '$zona_waktu', '$jam_masuk','$jam_pulang')");

            $_SESSION['berhasil'] = "Data lokasi absensi berhasil dibuat";
            header("location: lokasi_absensi.php");
            exit();
        }
    } 

}

?>
<div class="page-body">
          <div class="container-xl">
              
            <div class="card col-md-5">
                <div class="card-body">
                    <form action="<?php echo base_url('admin/data_lokasi_absensi/tambah.php')?>" method="POST">
                        <div class="mb-3">
                            <label for="">Nama Lokasi</label>
                            <input type="text" class="form-control" name="nama_lokasi" Value="<?php if(isset($_POST['nama_lokasi'])) echo $_POST['nama_lokasi'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" >Alamat Lokasi</label>
                            <input type="text" class="form-control" name="alamat_lokasi" Value="<?php if(isset($_POST['alamat_lokasi'])) echo $_POST['alamat_lokasi'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tipe Lokasi</label>
                            <select name="tipe_lokasi" class="form-control">
                                <option value="">--Pilih Lokasi--</option>
                                <option <?php if(isset($_POST['tipe_lokasi']) && $_POST['tipe_lokasi']== 'Pusat') {echo 'selected';}?> value="Pusat">Kantor Pusat</option>
                                <option <?php if(isset($_POST['tipe_lokasi']) && $_POST['tipe_lokasi']== 'Cabang') {echo 'selected';}?> value="Cabang">Kantor Cabang</option>
                                <option <?php if(isset($_POST['tipe_lokasi']) && $_POST['tipe_lokasi']== 'Gudang') {echo 'selected';}?> value="Gudang">Kantor Gudang</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" name="latitude" Value="<?php if(isset($_POST['latitude'])) echo $_POST['latitude'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="longitude" Value="<?php if(isset($_POST['longitude'])) echo $_POST['longitude'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Radius</label>
                            <input type="number" class="form-control" name="radius" Value="<?php if(isset($_POST['radius'])) echo $_POST['radius'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Zona Waktu</label>
                            <select name="zona_waktu" class="form-control">
                                <option value="">--Pilih Zona Waktu--</option>
                                <option <?php if(isset($_POST['zona_waktu']) && $_POST['zona_waktu']== 'WIB') {echo 'selected';}?> value="WIB">WIB</option>
                                <option <?php if(isset($_POST['zona_waktu']) && $_POST['zona_waktu']== 'WITA') {echo 'selected';}?> value="WITA">WITA</option>
                                <option <?php if(isset($_POST['zona_waktu']) && $_POST['zona_waktu']== 'WIT') {echo 'selected';}?> value="WIT">WIT</option>
                            </select>                   
                        </div>
                        <div class="mb-3">
                            <label for="">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" Value="<?php if(isset($_POST['jam_masuk'])) echo $_POST['jam_masuk'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam Pulang</label>
                            <input type="time" class="form-control" name="jam_pulang" Value="<?php if(isset($_POST['jam_pulang'])) echo $_POST['jam_pulang'] ?>"> 
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
          </div>
        </div>




<?php include('../layout/footer.php') ?>