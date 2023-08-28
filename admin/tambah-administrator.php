<?php
    $title = 'administrator';
    include '../template/header.php';

    if (isset($_POST['submit'])) {
  
        // cek data berhasil ditambahkan atau tidak
       if (tambahAdministrator($_POST) > 0) {
           echo "<script>
                       alert('Data Administrator Berhasil Ditambahkan');
                       document.location.href = 'administrator.php';
               </script>";
       } else {
           echo "<script>
                       alert('Data Administrator Gagal Ditambahkan');
                       document.location.href = 'tambah-administrator.php';
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
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama..." required>
                    </div>

                    <div class="col-lg-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username..." required>
                    </div>
                </div>


                <div class="form-group row">
                <div class="col-lg-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="pasword" class="form-control" placeholder="Password..." required>
                    </div>

                    <div class="col-lg-6">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option selected>-- Pilih Level --</option>
                            <option value="0">Peserta PKL</option>
                            <option value="1">Superuser</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                <div class="col-lg-12">
                        <label for="file">Foto</label>
                        <input type="file" name="file" id="file" class="form-control" accept="image/*" onchange="previewImg()" required>

                        <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px">
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