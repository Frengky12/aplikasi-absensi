<?php

include 'config/koneksi.php';
include 'config/control.php';

$status = query("SELECT * FROM master_status WHERE deleted_at IS NULL");

if (isset($_POST['submit'])) {
     if (absen($_POST,'nodashboard') > 0) {
           echo "<script>
                       alert('Absen Berhasil !');
                        document.location.href = 'index.php';

               </script>";
       } else {
           echo "<script>
                       alert('Absen Gagal');
                        document.location.href = 'index.php';

               </script>";
       }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi</title>
    <link rel="stylesheet" href="./assets/css/custom-css-view.css">
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/kominfo.png">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="index.php">Aplikasi Absensi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#absen">Absen</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
            </li>

        </ul>
        </div>
    </div>
    </nav>

    <header class="jumbotron bg-primary bg-gradient text-white">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Wellcome to Attendence Application</h1>
            <p class="lead">Hello, Have a nice Day and start your activity with a smile</p>
            <a class="btn btn-lg btn-light" href="#absen">Ayo Absen!</a>
         </div>
        
    </header>

        <!-- About section-->
        <section id="absen">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                                    <div class="text-center">
                                        <img src="./assets/img/gif-2.gif" alt="Gif Attendence" srcset="" width="15%">
                                        <h1 class="h4 text-gray-900 mb-4">Form Absen</h1>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data" class="user row">
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

                                        <!-- <div class="form-group col-12">
                                            <label for="kegiatan" class="form-col-label">Kegiatan</label>
                                            <input name="kegiatan" id="kegiatan" type="text" class="form-control"
                                                id="exampleInputPassword" placeholder="Kegiatan...">
                                            <small class="text-info"><i class="fas fa-fw fa-info-circle"></i> Kegiatan dapat juga diupdate pada halaman data-absensi</small>

                                        </div> -->

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

                                        <button type="submit" name="submit" class="btn btn-sm btn-primary btn-user btn-block">
                                            Absen
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Aplikasi Absensi Peserta PKL <?= date('Y'); ?></p></div>
        </footer>


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
    
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->
<script src="./assets/js/custom-js-view.js"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>