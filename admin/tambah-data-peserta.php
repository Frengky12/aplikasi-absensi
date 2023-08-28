<?php
    $title = 'data-peserta';

    include '../template/header.php';

    $users = query("SELECT * FROM users WHERE deleted_at IS NULL");
    $lokasi = query("SELECT * FROM master_lokasi WHERE deleted_at IS NULL");

    if (isset($_POST['submit'])) {
  
        // cek data berhasil ditambahkan atau tidak
       if (tambahDataPeserta($_POST) > 0) {
           echo "<script>
                       alert('Data Peserta Berhasil Ditambahkan');
                       document.location.href = 'data-peserta.php';
               </script>";
       } else {
           echo "<script>
                       alert('Data Peserta Gagal Ditambahkan');
                       document.location.href = 'tambah-data-peserta.php';
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
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Nama..." class="form-control" required>
                    </div>   
                    <div class="form-group col-lg-6">
                        <label for="tgl_masuk">Awal PKL</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" placeholder="Nama..." class="form-control" required>
                    </div>   
                    <div class="form-group col-lg-6">
                        <label for="tgl_keluar">Akhir PKL</label>
                        <input type="date" name="tgl_keluar" id="tgl_keluar" placeholder="Nama..." class="form-control" required>
                    </div>   

                    <div class="form-group col-lg-6">
                        <label for="asal">Asal</label>
                        <input type="text" name="asal" id="asal" placeholder="Asal..." class="form-control" required>
                    </div>   
                    <div class="form-group col-lg-6">
                        <label for="users_id">Akun</label>
                        <select name="users_id" id="users_id" class="form-control">
                            <option selected>-- Pilih Akun --</option>
                            <?php foreach($users as $data){ ?>
                            <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label for="id_lokasi">Lokasi PKL</label>
                        <select name="id_lokasi" id="id_lokasi" class="form-control">
                            <option selected>-- Pilih Lokasi --</option>
                            <?php foreach($lokasi as $lokasi){ ?>
                            <option value="<?= $lokasi['id'] ?>"><?= $lokasi['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="float-right">
                    <a href="data-peserta.php" class="btn btn-sm btn-secondary">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>



<?php
    include '../template/footer.php';
?>      