<?php 
    $title = 'master-lokasi';

    include '../template/header.php';

?>

<?php
    $datas = query("SELECT * FROM master_lokasi WHERE 1=1 AND deleted_at IS NULL");


    if (isset($_POST['tambah'])) {
        // cek data berhasil ditambahkan atau tidak
        if (tambahLokasi($_POST) > 0) {
            echo "<script type='text/javascript'>
                        alert('Data Berhasil Disimpan');
                        document.location.href = 'master-lokasi.php';
                </script>";
        }else{
            echo "<script>
                        alert('Data Gagal Disimpan');
                        document.location.href = 'master-lokasi.php';
                </script>";
        }
   }

   if (isset($_POST['edit'])) {

    // cek data berhasil ditambahkan atau tidak
    if (editLokasi($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Data Berhasil Disimpan');
                    document.location.href = 'master-lokasi.php';
            </script>";
    }else{
        echo "<script>
                    alert('Data Gagal Disimpan');
                    document.location.href = 'master-lokasi.php';
            </script>";
    }
}

?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Master Lokasi PKL</h1>
                    </div>

    <div class="card shadow">
        <div class="card-header py-2">
            <h4 class="card-title"><i class="fas fa-fw fa-map-marker mr-2"></i> Master Lokasi</h4>
        </div>
        <div class="card-body">

            <a href="" class="btn btn-sm btn-primary float-right mb-2" data-toggle="modal" data-target="#modalTambahLokasi"><i class="fas fa-plus"></i> Tambah Lokasi</a>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Fungsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1; 
                            foreach($datas as $data){
                        ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td>
                                <a data-toggle="modal" data-target="#modalEditLokasi<?= $data['id'] ?>" class="btn btn-sm btn-success text-white">
                                    <i class="fas fa-fw fa-edit"></i>
                                    Edit
                                </a>
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

    <!-- Tambah Modal-->
    <div class="modal fade" id="modalTambahLokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Lokasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="" method="post">
                        <div class="from-group">
                            <label for="name">Nama Lokasi</label>
                            <input type="text" name="name" id="name" placeholder="Nama Lokasi" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary text-white" type="submit" name="tambah">Tambah</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach($datas as $value) {?>
    <!-- modal Edit-->
    <div class="modal fade" id="modalEditLokasi<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Lokasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $value['id']; ?>">
                        <div class="from-group">
                            <label for="name">Nama Lokasi</label>
                            <input type="text" name="name" id="name" placeholder="Nama Lokasi" class="form-control" value="<?= $value['nama']; ?>" required>
                        </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary text-white" type="submit" name="edit">Submit</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

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
                    document.location.href = 'hapus-lokasi.php?id='+ id
                }
            })
        }
</script>

<?php
    include '../template/footer.php';
?>      