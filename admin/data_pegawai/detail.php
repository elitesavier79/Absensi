<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Detail data Pegawai";
include('../layout/header.php');
require_once('../../config.php');

$id = $_GET['id'];
$result = mysqli_query($connection, "SELECT * FROM users JOIN pegawai ON users.id_pegawai = pegawai.id WHERE pegawai.id =$id");

?>
<?php 
 While($pegawai = mysqli_fetch_array($result)) : 
?>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:<?php echo $pegawai['nama'] ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:<?php echo $pegawai['jenis_kelamin'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:<?php echo $pegawai['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>No Handphone</td>
                                <td>:<?php echo $pegawai['no_hp'] ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:<?php echo $pegawai['jabatan'] ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:<?php echo $pegawai['username'] ?></td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>:<?php echo $pegawai['role'] ?></td>
                            </tr>
                            <tr>
                                <td>Lokasi Absensi</td>
                                <td>:<?php echo $pegawai['lokasi_absensi'] ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:<?php echo $pegawai['status'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <img style="width:350px; border-radius: 15px;"src="<?php echo base_url('assets/img/foto_pegawai/'. $pegawai['foto'])?>" alt="foto pegawai">
            </div>
            
        </div>
        
            
    </div>
</div>

<?php endwhile; ?>


<?php include('../layout/footer.php') ?>