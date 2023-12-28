<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Data Jabatan";
include('../layout/header.php');
require_once('../../config.php');

$result = mysqli_query($connection, "SELECT * FROM jabatan ORDER BY id DESC");

?>
        <div class="page-body">
          <div class="container-xl">
              <a href="<?php echo base_url('admin/data_jabatan/tambah.php')?>" class="btn btn-primary ">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h.5" /><path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /></svg>
              Tambah Data
            </a>
            <div class="row row-deck row-cards mt-3">
              <table class="table table-bordered">
              <tr class="text-center">
                <th>No</th>
                <th>Nama Jabatan</th>
                <th>Aksi</th>
              </tr>

              <?php $no= 1;
              while($jabatan = mysqli_fetch_array($result)): ?>  
              <tr>
                <td class="text-center"><?php echo $no++ ?> </td>
                <td><?php echo $jabatan['jabatan'] ?> </td>
                <td class="text-center">
                    <a href="<?php echo base_url('admin/data_jabatan/edit.php?id='. $jabatan['id'])?>" class="badge bg-primary badge-pill"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>EDIT</a>
                    <a href="<?php echo base_url('admin/data_jabatan/hapus.php?id='. $jabatan['id'])?>" class="badge bg-danger badge-pill delete-data"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>DELETE</a>
                </td>
              </tr>             
              <?php endwhile ?>
              </table>

            </div>
          </div>
        </div>

<?php include('../layout/footer.php') ?>