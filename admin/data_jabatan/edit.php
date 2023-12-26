
<?php 

session_start();
ob_start();
if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Form Edit Data Jabatan";
include('../layout/header.php');
require_once('../../config.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $jabatan = htmlspecialchars($_POST['jabatan']);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($jabatan)){
            $pesan_kesalahan = "Kolom Jabatan Wajib di isi";
        }
        if(!empty($pesan_kesalahan)) {
            $_SESSION['validasi'] = $pesan_kesalahan;
        }else{
            
            $result = mysqli_query($connection, "UPDATE jabatan SET jabatan='$jabatan' WHERE id=$id");
            $_SESSION['berhasil'] = "Data Jabatan berhasil diupdate";
            header("location: jabatan.php");
            exit();
        }
    }

    
}
//$id = $_GET['id'];
$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
$result = mysqli_query($connection, "SELECT * FROM jabatan WHERE id=$id");
While($jabatan = mysqli_fetch_array($result)) {
    $nama_jabatan = $jabatan['jabatan'];
}
?>
        <div class="page-body">
          <div class="container-xl">
              
            <div class="card col-md-5">
                <div class="card-body">
                    <form action="<?php echo base_url('admin/data_jabatan/edit.php')?>" method="POST">
                        <div class="mb-3">
                            <label for="">Nama Jabatan</label>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $id ?> ">
                            <input type="text" class="form-control" name="jabatan" value="<?php echo $nama_jabatan ?> ">
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
          </div>
        </div>

<?php include('../layout/footer.php') ?>