<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("location: ../../auth/login.php?pesan=belum_login");
}else if($_SESSION["role"] !='admin'){
  header("location: ../../auth/login.php?pesan=tolak_akses");
}
$judul = "Data Pegawai";
include('../layout/header.php');
require_once('../../config.php');

$result = mysqli_query($connection, "SELECT * FROM users JOIN pegawai ON users.id_pegawai = pegawai.id ");

?>

<div class="page-body">
    <div class="container-xl">
    <a href="<?php echo base_url('admin/data_pegawai/tambah.php')?>" class="btn btn-primary ">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /></svg>
              Tambah Data
            </a>
            <div class="card mt-3">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
            
                        <?php if(mysqli_num_rows($result) === 0) { ?>
                            <tr>
                                <td colspan="7">Data Kosong, Silakan tambahkan data baru</td>
                            </tr>
                        <?php }else { ?>
                            <?php $no= 1;
                            while($pegawai = mysqli_fetch_array($result)): ?>  
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $pegawai['nip'] ?></td>
                                    <td class="text-center"><?php echo $pegawai['nama'] ?></td>
                                    <td class="text-center"><?php echo $pegawai['username'] ?></td>
                                    <td class="text-center"><?php echo $pegawai['jabatan'] ?></td>
                                    <td class="text-center"><?php echo $pegawai['role'] ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('admin/data_pegawai/detail.php?id='.$pegawai['id']) ?>" class="badge bg-primary badge-pill"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>DETAIL</a>
                                        <a href="<?php echo base_url('admin/data_pegawai/edit.php?id='. $pegawai['id'])?>" class="badge bg-warning badge-pill"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>EDIT</a>
                                        <a href="<?php echo base_url('admin/data_pegawai/hapus.php?id='. $pegawai['id'])?>" class="badge bg-danger badge-pill delete-data"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 12l4 4m0 -4l-4 4" /></svg>DELETE</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php } ?>
                    </table>
                </div>
            </div>
    </div>
</div>



<?php include('../layout/footer.php') ?>