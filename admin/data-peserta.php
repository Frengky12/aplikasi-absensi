<?php
    $title = 'data-peserta';

    include '../template/header.php';
?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Peserta</h1>
                    </div>

<?php if ($akun['level'] == 1) { ?>
    <?php 
        $datas = query("SELECT dp.*,ml.nama AS lokasi FROM data_peserta dp LEFT JOIN master_lokasi ml ON ml.id = dp.id_lokasi WHERE dp.deleted_at IS NULL AND ml.deleted_at IS NULL")
    ?>
    <div class="card shadow">
        <div class="card-header py-2">
                <div class="card-title">
                <h4>
                    <i class="fas fa-fw fa-users"></i>    
                    Data Peserta
                </h4>
            </div>

        </div>
        <div class="card-body text-center">
        <a href="../export/export-data-peserta.php" class="btn btn-sm btn-success float-left mb-2"><i class="fas fa-print"> Print Data Peserta</i></a>
        <a href="tambah-data-peserta.php" class="btn btn-sm btn-primary float-right mb-2"><i class="fas fa-plus"></i> Tambah Peserta</a>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Awal PKL</th>
                            <th>Akhir PKL</th>
                            <th>Asal</th>
                            <th>Status</th>
                            <th>Lokasi PKL</th>
                            <th>Tanggal Dibuat</th>
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
                            <td><?= $data['tgl_masuk']; ?></td>
                            <td><?= $data['tgl_keluar']; ?></td>
                            <td><?= $data['asal']; ?></td>

                            <td>
                                <?php if ($data['is_active'] == 0) { ?>
                                    <span class="badge badge-pill badge-success">Aktif</span>
                               <?php  }else{ ?>
                                    <span class="badge badge-pill badge-secondary">Tidak Aktif</span>
                                <?php } ?>
                            </td>
                            <td><?= $data['lokasi'] ?></td>
                            <td>
                                <?= date ('d F Y | H:s:i', strtotime($data['created_at'])); ?>
                            </td>
                            <td>
                                <a href="edit-data-peserta.php?id=<?= $data['id']; ?>" class="btn btn-success btn-sm text-white" title="edit"><i class="fas fa-edit"></i> Edit</a>
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
<?php } elseif ($akun['level'] == 0) { ?>
    <?php 
        $id = $akun['id'];
        $datas = query("SELECT dp.*, u.foto FROM data_peserta dp LEFT JOIN users u ON dp.users_id = u.id WHERE dp.deleted_at IS NULL AND u.deleted_at IS NULL AND dp.users_id = $id")[0];

    ?>

    <div class="card shadow">
        <div class="card-header py-2">
            <h4 class="card-title">
            <i class="fas fa-fw fa-users"></i>    
            Data Peserta</h4>
        </div>
        <div class="card-body ">
        <div class="border border-primary rounded p-4 row">
                <div class="col-lg-3 text-center">
                    <img src="../assets/img/attachment/<?= $datas['foto'] ?>" alt="" width="100%" height="auto">
                </div>

                <div class="col-lg-9 row">
                    <label class="text-bold h4 col-4">Nama</label>
                    <label class="text-bold h4 col-8">: <?= $datas['nama'] ?></label>

                    <label class="text-bold h4 col-4">Awal PKL</label>
                    <label class="text-bold h4 col-8">: <?= date ('d F Y', strtotime($datas['tgl_masuk'])); ?></label>

                    <label class="text-bold h4 col-4">Akhir PKL</label>
                    <label class="text-bold h4 col-8" id="password">: <?= date ('d F Y', strtotime($datas['tgl_keluar'])); ?></label>
                    
                    <label class="text-bold h4 col-4">Asal</label>
                    <label class="text-bold h4 col-8" id="password">: <?= $datas['asal'] ?></label>

                    <label class="text-bold h4 col-4">Status</label>
                    <label class="text-bold h4 col-8" id="password">: 
                        <?php if ($datas['is_active'] == 0) { ?>
                                <span class="badge badge-pill badge-success">Aktif</span>
                            <?php  }else{ ?>
                                <span class="badge badge-pill badge-secondary">Tidak Aktif</span>
                        <?php } ?>
                    </label>

                    <label class="text-bold h4 col-4">Tanggal Ditambahkan</label>
                    <label class="text-bold h4 col-8">: <?= date ('d F Y | H:s:i', strtotime($datas['created_at'])); ?></label>
                </div>
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
                    document.location.href = 'hapus-data-peserta.php?id='+ id
                }
            })
        }
</script>



<?php
    include '../template/footer.php';
?>      