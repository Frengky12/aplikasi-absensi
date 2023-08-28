<?php
    $title = 'administrator';

    include '../template/header.php';

    $id = (int)$_GET['id'];

    $datas = query("SELECT * FROM users WHERE id = $id")[0];

    if (isset($_POST['submit'])) {
  
        // cek data berhasil ditambahkan atau tidak
       if (editAdministrator($_POST) > 0) {
           echo "<script>
                       alert('Data Administrator Berhasil Ditambahkan');
                       document.location.href = 'administrator.php';
               </script>";
       } else {
           echo "<script>
                       alert('Data Administrator Gagal Ditambahkan');
                       document.location.href = 'tambah-administrator.php?id=$id';
               </script>";
       }
   }
?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Administrator</h1>
                    </div>

    <div class="card shadow">
    <div class="card-header py-2">
            <h4 class="card-title"> Form Tambah Administrator</h4>
        </div>  
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $datas['id']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $datas['foto']; ?>">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama..." value="<?= $datas['nama'] ?>">
                    </div>

                    <div class="col-lg-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username..." value="<?= $datas['username'] ?>">
                    </div>
                </div>


                <div class="form-group row">
                <div class="col-lg-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="pasword" class="form-control" placeholder="Password..." value="<?= $datas['password'] ?>">
                    </div>

                    <div class="col-lg-6">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="0" <?php if ($datas['level'] == 0) echo 'selected'?>>Peserta PKL</option>
                            <option value="1" <?php if ($datas['level'] == 1) echo 'selected'?>>Superuser</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                <div class="col-lg-12">
                        <label for="file">Foto</label>
                        <input type="file" name="file" id="file" class="form-control" accept="image/*" value="<?= $datas['foto'] ?>" onchange="previewImg()">

                        <img src="../assets/img/attachment/<?=$datas['foto'] ?>" alt="" class="img-thumbnail img-preview mt-2" width="100px">

                    </div>

                </div>

                <div class="float-right">
                    <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
                    <a href="administrator.php" class="btn btn-sm btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

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