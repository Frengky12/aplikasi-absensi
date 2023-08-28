<?php
    $title = 'administrator';
    include '../template/header.php';

    $datas = query("SELECT * FROM `users` WHERE 1=1 AND deleted_at IS NULL");

?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Administrator</h1>
                    </div>

    <div class="card shadow">
        <div class="card-header py-2">
            <h4 class="card-title"><i class="fas fa-fw fa-user-cog mr-2"></i> Data Administrator</h4>
        </div>
        <div class="card-body">

            <a href="tambah-administrator.php" class="btn btn-sm btn-primary float-right mb-2"><i class="fas fa-plus"></i> Tambah Administrator</a>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1; 
                            foreach($datas as $data){
                        ?>
                        <tr class="text-center">
                            <td><?= $no++ ; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td>********</td>
                            <td>
                                <?php if ($data['level'] == 0) { ?>
                                    Peserta PKL
                               <?php  }else{ ?>
                                    Superuser
                                <?php } ?>
                            </td>
                            <td>
                                <img src="../assets/img/attachment/<?= $data['foto'] ?>" alt="" width="50px">
                            </td>
                            <td>
                                <a href="edit-administrator.php?id=<?= $data['id']; ?>" class="btn btn-success btn-sm text-white" title="edit"><i class="fas fa-edit"></i> Edit</a>
                                <button class="btn btn-sm btn-danger" name="hapus" onclick="onHapus(<?= $data['id'] ?>)">
                                    <i class="fas fa-fw fa-trash-alt"></i>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        function onHapus(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "Yakin Data Akan Dihapus ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'hapus-administrator.php?id='+ id
                }
            })
        }
</script>

<?php
    include '../template/footer.php';
?>      