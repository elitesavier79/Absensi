<?php 
session_start();
ob_start();
if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Form Edit Data Pegawai";
include('../layout/header.php');
require_once('../../config.php');

if(isset($_POST['update'])){ 
    $id = $_POST['id'];
    $nama = htmlspecialchars($_POST['nama']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);
    $status = htmlspecialchars($_POST['status']);
    $lokasi_absensi = htmlspecialchars($_POST['lokasi_absensi']);

    if(empty($_POST['password'])) {
        $password = $_POST['old_password'];
    }else{
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    if($_FILES['foto']['error'] === 4) {
        $nama_file = $_POST['old_foto'];
    }else {

        if(isset($_FILES['foto'])){
            $file =$_FILES['foto'];
            $nama_file = $file['name'];
            $file_tmp = $file['tmp_name'];
            $ukuran_file = $file['size'];
            $file_direktori = "../../assets/img/foto_pegawai/".$nama_file;
            $extension = pathinfo($nama_file, PATHINFO_EXTENSION);
            $extension_allow = ["jpg", "png", "jpeg"];
            $max_file = 10*1024*1024;
    
            move_uploaded_file($file_tmp, $file_direktori);
        }

    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($nama)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Nama Pegawai Wajib diisi";
        }
        if(empty($jenis_kelamin)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Jenis Kelamin  Wajib dipilih";
        }
        if(empty($alamat)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Alamat Wajib dipilih";
        }
        if(empty($no_hp)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> No Handphone Wajib diisi";
        }
        if(empty($jabatan)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Jabatan Wajib dipilih";
        }
        if(empty($lokasi_absensi)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> lokasi Absensi Wajib dipilih";
        }
        if(empty($username)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Username Wajib diisi";
        }
        if(empty($password)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Password wajib diisi";
        }
        if(empty($role)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> role Wajib dipilih";
        }
        if(empty($status)){
            $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> status Wajib dipilih";
        }
        
        if($_FILES['foto']['error'] != 4) {

            if(!in_array(strtolower($extension), $extension_allow)){
                $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> Harus file berupa JPG, JPEG dan PNG";
            }
            if($ukuran_file > $max_file){
                $pesan_kesalahan[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l5 5l10 -10' /></svg> ukuran file melebihi 10 MB";
            }
        }

        if(!empty($pesan_kesalahan)) {
            $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
        }else{
            
            $pegawai = mysqli_query($connection, "UPDATE pegawai SET
                    nama = '$nama',
                    jenis_kelamin = '$jenis_kelamin',
                    alamat = '$alamat',
                    no_hp = '$no_hp',
                    jabatan = '$jabatan',
                    lokasi_absensi = '$lokasi_absensi',
                    foto = '$nama_file'
            WHERE id = '$id'");                       
           
            $user = mysqli_query($connection, "UPDATE users SET
                    username = '$username',
                    password = '$password',
                    status = '$status',
                    role = '$role'
            WHERE id = '$id'");
            
            $_SESSION['berhasil'] = "Data Pegawai berhasil diupdate";
            header("location: pegawai.php");
            exit();
        }
    } 

}

$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
$result = mysqli_query($connection, "SELECT * FROM users JOIN pegawai ON users.id_pegawai = pegawai.id WHERE pegawai.id=$id");

while($pegawai = mysqli_fetch_array($result)) {
    $nama = $pegawai['nama'];
    $jenis_kelamin = $pegawai['jenis_kelamin'];
    $alamat = $pegawai['alamat'];
    $no_hp = $pegawai['no_hp'];
    $jabatan = $pegawai['jabatan'];
    $username = $pegawai['username'];
    $password = $pegawai['password'];
    $status = $pegawai['status'];
    $role = $pegawai['role'];
    $lokasi_absensi = $pegawai['lokasi_absensi'];
    $foto = $pegawai['foto'];
}

?>
<div class="page-body">
    <div class="container-xl">
    <form action="<?php echo base_url('admin/data_pegawai/edit.php')?>" method="POST" enctype="multipart/form-data">
    <div class="row">
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">                                
                                    <div class="mb-3">
                                        <label for="" >Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nama" Value="<?php echo $nama ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="">--Pilih Jenis Kelamin--</option>
                                            <option <?php if($jenis_kelamin == 'Laki-Laki') {echo 'selected';}?> value="Laki-Laki">Laki-Laki</option>
                                            <option <?php if($jenis_kelamin == 'perempuan') {echo 'selected';}?> value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" Value="<?php echo $alamat ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">No Handphone</label>
                                        <input type="text" class="form-control" name="no_hp" Value="<?php echo $no_hp ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Jabatan</label>
                                        <select name="jabatan" class="form-control">
                                            <option value="">--Pilih Jabatan--</option>
                                            <?php 
                                                $result = mysqli_query($connection, "SELECT * FROM jabatan ORDER BY jabatan ASC");
                                                While($row = mysqli_fetch_assoc($result)){
                                                    $nama_jabatan = $row['jabatan'];
                                                    if($jabatan == $nama_jabatan) {
                                                      echo '<option value="' .$nama_jabatan. '" selected="selected">' .$nama_jabatan .'</option>';
                                                    }else{
                                                      echo '<option value="'.$nama_jabatan.'">'.$nama_jabatan.'</option>';
                                                    }
                                                }
                                            ?>
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
                                                    if($lokasi_absensi == $nama_lokasi) {
                                                      echo '<option value="' .$nama_lokasi. '" selected="selected">' .$nama_lokasi .'</option>';
                                                    }else{
                                                      echo '<option value="'.$nama_lokasi.'">'.$nama_lokasi.'</option>';
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
                                <input type="text" class="form-control" name="username" Value="<?php echo $username ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" >Password</label>
                                <input type="hidden" value="<?php echo $password ?>" name="old_password">
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            <option <?php if($status == 'aktif') {echo 'selected';}?> value="aktif">Aktif</option>
                                            <option <?php if($status == 'tidak aktif') {echo 'selected';}?> value="tidak aktif">Tidak Aktif</option>                                           
                                        </select>
                                    </div>
                            <div class="mb-3">
                                <label for="">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">--Pilih Role--</option>
                                        <option <?php if($role == 'admin') {echo 'selected';}?> value="admin">Admin</option>
                                        <option <?php if($role == 'pegawai') {echo 'selected';}?> value="pegawai">Pegawai</option>    
                                    </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="">Foto</label>
                                <input type="hidden" class="form-control" value="<?php echo $foto?>" name="old_foto">
                                <input type="file" class="form-control" name="foto">
                            </div>

                            <input type="hidden" value="<?php echo $id ?>" name="id">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                        
                    </div>
                    
            </div>          
        </div>
    </div>
    </form>
    </div>
</div>




<?php include('../layout/footer.php') ?>