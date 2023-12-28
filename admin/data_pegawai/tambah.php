<?php 
session_start();
ob_start();
if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Form Tambah Data Pegawai";
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
    <form action="<?php echo base_url('admin/data_pegawai/tambah.php')?>" method="POST">
        <div class="row">
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                               
                                    <?php 
                                        $result = mysqli_query($connection, "SELECT nip FROM pegawai ORDER BY nip DESC LIMIT 1");
                                        if(mysqli_num_rows($result) > 0){
                                            $row = mysqli_fetch_assoc($result);
                                            $nip_db = $row['nip'];
                                            $nip_db = explode("-", $nip_db);
                                            $no_baru = (int)$nip_db[1] + 1;
                                            $nip_baru = "PEG-" . str_pad($no_baru, 4, 0, STR_PAD_LEFT);
            
                                        }else{
                                            $nip_baru = "PEG-001";
                                        }
                                    ?>
                                    <div class="mb-3">
                                        <label for="">NIP</label>
                                        <input type="text" class="form-control" name="NIP" Value="<?php echo $nip_baru ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" >Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nama" Value="<?php if(isset($_POST['nama'])) echo $_POST['nama'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="">--Pilih Jenis Kelamin--</option>
                                            <option <?php if(isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin']== 'Laki-Laki') {echo 'selected';}?> value="Laki-Laki">Laki-Laki</option>
                                            <option <?php if(isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin']== 'Perempuan') {echo 'selected';}?> value="Perempuan">Perempuan</option>
                                            
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" Value="<?php if(isset($_POST['alamat'])) echo $_POST['alamat'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">No Handphone</label>
                                        <input type="text" class="form-control" name="no_hp" Value="<?php if(isset($_POST['no_hp'])) echo $_POST['no_hp'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Jabatan</label>
                                        <select name="jabatan" class="form-control">
                                            <option value="">--Pilih Jabatan--</option>
                                            <?php 
                                                $result = mysqli_query($connection, "SELECT * FROM jabatan ORDER BY jabatan ASC");
                                                While($jabatan = mysqli_fetch_assoc($result)){
                                                    $nama_jabatan = $jabatan['jabatan'];
                                                    if(isset($_POST['jabatan']) && $_POST['jabatan']== $nama_jabatan) {
                                                      echo '<option value="' .$nama_jabatan. '" selected="selected">' .$nama_jabatan .'</option>';
                                                    }else{
                                                      echo '<option value="'.$nama_jabatan.'">'.$nama_jabatan.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>                   
                                    </div>
                                    
                                    
                                    
                                
                        </div>
                    </div>
            </div>

            <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" >Username</label>
                                <input type="text" class="form-control" name="username" Value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" >Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            <option <?php if(isset($_POST['status']) && $_POST['status']== 'aktif') {echo 'selected';}?> value="aktif">Aktif</option>
                                            <option <?php if(isset($_POST['status']) && $_POST['status']== 'tidak aktif') {echo 'selected';}?> value="tidak aktif">Tidak Aktif</option>
                                            
                                        </select>
                                    </div>
                            <div class="mb-3">
                                <label for="">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">--Pilih Role--</option>
                                        <option <?php if(isset($_POST['role']) && $_POST['role']== 'admin') {echo 'selected';}?> value="admin">Admin</option>
                                        <option <?php if(isset($_POST['role']) && $_POST['role']== 'pegawai') {echo 'selected';}?> value="pegawai">Pegawai</option>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Lokasi Absensi</label>
                                    <select name="lokasi_absensi" class="form-control">
                                        <option value="">--Pilih Lokasi Absensi--</option>
                                            <?php 
                                                $result = mysqli_query($connection, "SELECT * FROM lokasi_absensi ORDER BY nama_lokasi ASC");
                                                While($lokasi = mysqli_fetch_assoc($result)){
                                                    $nama_lokasi = $lokasi['nama_lokasi'];
                                                    if(isset($_POST['lokasi_absensi']) && $_POST['lokasi_absensi']== $nama_lokasi) {
                                                      echo '<option value="' .$nama_lokasi. '" selected="selected">' .$nama_lokasi .'</option>';
                                                    }else{
                                                      echo '<option value="'.$nama_lokasi.'">'.$nama_lokasi.'</option>';
                                                    }
                                                }
                                            ?>
                                    </select>                   
                            </div>
                            <div class="mb-3">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        
                    </div>
                    
            </div>

            

        </div>
        
    </form>
    </div>
</div>




<?php include('../layout/footer.php') ?>