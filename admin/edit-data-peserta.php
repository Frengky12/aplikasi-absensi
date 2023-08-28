<?php
    $title = 'data-peserta';

    include '../template/header.php';

    $id = (int)$_GET['id'];

    $datas = query("SELECT * FROM data_peserta WHERE deleted_at IS NULL AND id = $id")[0];
    $users = query("SELECT * FROM users WHERE deleted_at IS NULL");
    $lokasi = query("SELECT * FROM master_lokasi WHERE deleted_at IS NULL");


    if (isset($_POST['submit'])) {
  
        // cek data berhasil ditambahkan atau tidak
       if (editDataPeserta($_POST) > 0) {
           echo "<script>
                       alert('Data Peserta Berhasil Ditambahkan');
                       document.location.href = 'data-peserta.php';
               </script>";
       } else {
           echo "<script>
                       alert('Data Peserta Gagal Ditambahkan');
                       document.location.href = 'edit-data-peserta.php?id=$id';
               </script>";
       }
   }


?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data Peserta</h1>
                    </div>

    <div class="card shadow">
        <div class="card-header py-2">
            <h4 class="card-title">   
            Form Tambah Data Peserta</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $datas['id']; ?>">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Nama..." class="form-control" value="<?= $datas['nama'] ?>" required>
                    </div>   
                    <div class="form-group col-lg-6">
                        <label for="tgl_masuk">Awal PKL</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" placeholder="Nama..." class="form-control" value="<?= $datas['tgl_masuk'] ?>" required>
                    </div>   
                    <div class="form-group col-lg-6">
                        <label for="tgl_keluar">Akhir PKL</label>
                        <input type="date" name="tgl_keluar" id="tgl_keluar" placeholder="Nama..." class="form-control" value="<?= $datas['tgl_keluar'] ?>" required>
                    </div>   

                    <div class="form-group col-lg-6">
                        <label for="asal">Asal</label>
                        <input type="text" name="asal" id="asal" placeholder="Asal..." class="form-control" value="<?= $datas['asal'] ?>" required>
                    </div>   
                    <div class="form-group col-lg-6">
                        <label for="users_id">Akun</label>
                        <select name="users_id" id="users_id" class="form-control">
                            <option selected>-- Pilih Akun --</option>
                            <?php foreach($users as $data){ ?>
                            <option value="<?= $data['id'] ?>" <?php if ($datas['users_id'] == $data['id']){echo 'selected';} ?>><?= $data['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>   

                    <div class="form-group col-lg-12">
                        <label for="id_lokasi">Lokasi PKL</label>
                        <select name="id_lokasi" id="id_lokasi" class="form-control">
                            <option selected>-- Pilih Lokasi --</option>
                            <?php foreach($lokasi as $lokasi){ ?>
                            <option value="<?= $lokasi['id'] ?>" <?php if ($datas['id_lokasi'] == $lokasi['id']){echo 'selected';} ?>><?= $lokasi['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label>Status</label>
                        <div class="form-check col-lg-6">
                        <input class="form-check-input" type="radio" name="is_active" id="flexRadioDefault1" value="0" <?php if($datas['is_active'] == 0){echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Aktif
                        </label>
                        </div>
                        <div class="form-check col-lg-6">
                        <input class="form-check-input" type="radio" name="is_active" id="flexRadioDefault2" value="1" <?php if($datas['is_active'] == 1){echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Tidak Aktif
                        </label>
                        </div>
                    </div>
                </div>



                <div class="float-right">
                    <a href="data-peserta" class="btn btn-sm btn-secondary">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>



<?php
    include '../template/footer.php';
?>      