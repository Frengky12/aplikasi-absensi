<?php
    $title = 'data-absensi';
    include '../template/header.php';
    $id_users = $akun['id'];

    $status = query("SELECT * FROM master_status WHERE deleted_at IS NULL");

    $cek_absensi = query("SELECT * FROM data_absensi WHERE 1=1 AND id_users = $id_users ORDER BY tgl_absen DESC")[0];


    $last_absen = date('Y-m-d', strtotime($cek_absensi['tgl_absen']));
    $current_absen = date('Y-m-d');


    if ($akun['level'] == 1) {
        $datas = query("SELECT da.*,u.nama, ms.nama AS status FROM data_absensi da LEFT JOIN users u ON u.id = da.id_users LEFT JOIN master_status ms ON ms.id = da.keterangan WHERE 1=1 ORDER BY tgl_absen DESC");
    }elseif ($akun['level'] == 0) {
        $datas = query("SELECT da.*,u.nama, ms.nama AS status FROM data_absensi da LEFT JOIN users u ON u.id = da.id_users LEFT JOIN master_status ms ON ms.id = da.keterangan WHERE da.id_users = $id_users ORDER BY tgl_absen DESC");
    }

    $peserta = query("SELECT * FROM data_peserta WHERE is_active = 0 AND deleted_at IS NULL");

    if (isset($_POST['submit'])) {
     if (absen($_POST,'dashboard') > 0) {
           echo "<script>
                       alert('Absen Berhasil !');
                        document.location.href = 'data-absensi.php';

               </script>";
       } else {
           echo "<script>
                       alert('Absen Gagal');
                        document.location.href = 'data-absensi.php';

               </script>";
       }
    }

    if (isset($_POST['edit'])) {
     if (update_absen($_POST,'dashboard') > 0) {
           echo "<script>
                       alert('Absen Berhasil diupdate !');
                        document.location.href = 'data-absensi.php';

               </script>";
       } else {
           echo "<script>
                       alert('Absen Gagal diupdate');
                        document.location.href = 'data-absensi.php';

               </script>";
       }
    }
?>       

<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-2">
                <div class="card-title">
                <h4>
                    <i class="fas fa-fw fa-calendar-check"></i>    
                    Data Absensi
                </h4>
            </div>

        </div>
        <div class="card-body text-center">
                <?php  if ($akun['level'] == 1) { ?>
                    <div class="btn-group float-left mb-2">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-print"> Print Data Absensi</i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../export/export-data-absensi.php">All Data</a>
                        <?php foreach ($peserta as $value) { ?>
                            <a class="dropdown-item" href="../export/export-data-absensi-spesific.php?id_users=<?= $value['users_id'] ?>"><?= $value['nama'] ?></a>
                            
                        <?php } ?>
                        
                    </div>
                    </div>

                <?php  }elseif ($akun['level'] == 0) {  ?>
                    <a href="../export/export-data-absensi-spesific.php?id_users=<?= $id_users; ?>" class="btn btn-sm btn-success float-left mb-2"><i class="fas fa-print"> Print Data Absensi</i></a>
                <?php  }  ?>


            <?php if ($akun['level'] == 0) { ?>
                <a href="" data-toggle="modal" data-target="#modalAbsen" class="btn btn-sm btn-primary float-right mb-2">Go Absen <i class="fas fa-info"></i></a>
                
            <?php } ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Absen</th>
                            <th>Keterangan</th>
                            <th>Kegiatan</th>
                            <th width="20%">Attachment</th>
                            <th>Alasan</th>
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
                            <td><?= date ('l, d F Y', strtotime($data['tgl_absen']));; ?></td>
                            <td>
                                <?php if ($data['keterangan'] == 1) { ?> 
                                    <span class="btn btn-sm btn-outline-success"><?= $data['status']; ?></span>
                                <?php }elseif ($data['keterangan'] == 2) { ?>
                                    <span class="btn btn-sm btn-outline-secondary"><?= $data['status']; ?></span>
                                <?php }elseif ($data['keterangan'] == 3) { ?>
                                    <span class="btn btn-sm btn-outline-warning"><?= $data['status']; ?></span>
                                    
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($data['kegiatan'] == '') { ?>
                                Kegiatan Belum Di isi
                            <?php }else{ ?>
                                <?= $data['kegiatan'] ?>
                            <?php } ?>
                            </td>
                            <td>
                                <img src="../assets/img/attachment/file-absensi/<?= $data['attachment'] ?>" alt="" width="20%" height="auto">
                            </td>
                            <td><?php if ($data['alasan'] == '') { ?>
                                -
                            <?php }else{ ?></td>
                                <?= $data['alasan'] ?>
                            <?php } ?>
                            <td>
                                <a href="" data-toggle="modal" data-target="#modalAbsen<?= $data['id']; ?>" class="btn btn-success btn-sm text-white" title="edit"><i class="fas fa-edit"></i> Edit</a>
                            <?php if ($akun['level'] == 1) { ?>
                                <button class="btn btn-sm btn-danger" name="hapus" onclick="onHapus(<?= $data['id'] ?>)">
                                    <i class="fas fa-fw fa-trash-alt"></i>
                                    Hapus
                                </button>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAbsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Absen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="user row">
                    <?php if ($last_absen == $current_absen) { ?>
                        <div class="text-center h4">
                            Anda Telah Absen Hari Ini,
                            Silahkan Absen Kembali Besok !
                            <br>
                            <img src="../assets/img/sudah-absen.gif" alt="" srcset="" width="200px" height="auto">
                        </div>
                    <?php }else{ ?>
                        <div class="form-group col-12">
                                            <label for="username" class="form-col-label">Username</label>
                                            <input name="username" id="username" type="text" class="form-control" 
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username..." required>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="password" class="form-col-label">Password</label>
                                            <input name="password" id="password" type="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password..." required>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="kegiatan" class="form-col-label">Kegiatan</label>
                                            <input name="kegiatan" id="kegiatan" type="text" class="form-control"
                                                id="exampleInputPassword" placeholder="Kegiatan...">
                                            <small class="text-info">
                                                <i class="fas fa-fw fa-info-circle"></i> 
                                                Kegiatan dapat juga diupdate pada halaman data-absensi
                                            </small>

                                        </div>

                                        <div class="form-group col-12">
                                            <label for="keterangan" class="form-col-label">Keterangan</label>

                                            <select name="keterangan" id="keterangan" class="form-control">
                                                <option>-- Pilih Keterangan --</option>
                                                <?php foreach ($status as $key) { ?>
                                                    <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="alasan" class="form-col-label">Alasan</label>

                                            <input name="alasan" id="alasan" type="text" class="form-control"
                                                id="exampleInputPassword" placeholder="Alasan...">
                                            <small class="text-danger">*Alasan diisi hanya ketika keterangan Izin atau Sakit </small>
                                        </div>

                                        <div class="form-group col-12">
                                            <input type="file" name="file" id="file" class="form-control" accept="image/*" onchange="previewImg()">
                                            <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px">
                                            
                                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                <?php if ($last_absen != $current_absen) { ?>
                    <button class="btn btn-sm btn-primary text-white" type="submit" name="submit">Absen</button>

                <?php }else ?>
                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($datas as $x) { ?>
            <div class="modal fade" id="modalAbsen<?= $x['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Update Absen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="user row">
                        <input type="hidden" name="id" value="<?= $x['id'] ?>">
                        <input type="hidden" name="attachment_lama" value="<?= $x['attachment'] ?>">
                        <input type="hidden" name="temp_keterangan" value="<?= $x['keterangan'] ?>">

                        <div class="form-group col-12">
                                            <label for="username" class="form-col-label">Username</label>
                                            <input name="username" id="username" type="text" class="form-control" value="<?=$akun['username']?>"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username..." required>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="password" class="form-col-label">Password</label>
                                            <input name="password" id="password" type="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password..." required>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="kegiatan" class="form-col-label">Kegiatan</label>
                                            <input name="kegiatan" id="kegiatan" type="text" class="form-control"
                                                id="exampleInputPassword" placeholder="Kegiatan..." value="<?= $x['kegiatan'] ?>">
                                            <small class="text-info">
                                                <i class="fas fa-fw fa-info-circle"></i> 
                                                Kegiatan dapat juga diupdate pada halaman data-absensi
                                            </small>

                                        </div>

                                    <?php if ($akun['level'] == 1) { ?>
                                        <div class="form-group col-12">
                                            <label for="keterangan" class="form-col-label">Keterangan</label>

                                            <select name="keterangan" id="keterangan" class="form-control">
                                                <option>-- Pilih Keterangan --</option>
                                                <?php foreach ($status as $key) { ?>
                                                    <option value="<?= $key['id']; ?>" <?php if ($x['keterangan'] == $key['id'])  echo 'selected';  ?>><?= $key['nama']; ?></option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                            
                                    <?php } ?>
                                        

                                        <div class="form-group col-12">
                                            <label for="alasan" class="form-col-label">Alasan</label>

                                            <input name="alasan" id="alasan" type="text" class="form-control"
                                                id="exampleInputPassword" placeholder="Alasan..." value="<?= $x['alasan'] ?>">
                                            <small class="text-danger">*Alasan diisi hanya ketika keterangan Izin atau Sakit </small>
                                        </div>

                                        <div class="form-group col-12">
                                            <input type="file" name="file" id="file" class="form-control" accept="image/*" value="<?= $x['attachment'] ?>" onchange="previewImg()">

                                            <img src="../assets/img/attachment/file-absensi/<?=$x['attachment'] ?>" alt="" class="img-thumbnail img-preview mt-2" width="100px">

                                        </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-sm btn-primary text-white" type="submit" name="edit">Update</button>

                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>  
    
<script>
    function previewImg() {
        const foto = document.querySelector('#file');
        const preview = document.querySelector('.img-preview');
        
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e){
            preview.src = e.target.result;
        }
        
    }
</script>



<?php
    include '../template/footer.php';
?>      