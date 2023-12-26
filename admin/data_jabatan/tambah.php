
<?php 

session_start();
ob_start();
if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Form tambah Data Jabatan";
include('../layout/header.php');
require_once('../../config.php');

if(isset($_POST['submit'])){
    $jabatan = htmlspecialchars($_POST['jabatan']);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($jabatan)){
            $pesan_kesalahan = "Kolom Jabatan Wajib di isi";
        }
        if(!empty($pesan_kesalahan)) {
            $_SESSION['validasi'] = $pesan_kesalahan;
        }else{
            
            $result = mysqli_query($connection, "INSERT INTO jabatan(jabatan) VALUES('$jabatan')");
            $_SESSION['berhasil'] = "Data Jabatan berhasil dibuat";
            header("location: jabatan.php");
            exit();
        }
    }

    
}
?>
        <div class="page-body">
          <div class="container-xl">
              
            <div class="card col-md-5">
                <div class="card-body">
                    <form action="<?php echo base_url('admin/data_jabatan/tambah.php')?>" method="POST">
                        <div class="mb-3">
                            <label for="">Nama Jabatan</label>
                            <input type="text" class="form-control" name="jabatan">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
          </div>
        </div>

<?php include('../layout/footer.php') ?>