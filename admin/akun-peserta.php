<?php
    $title = 'akun-peserta';
    include '../template/header.php';

?>       
                   <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Akun Peserta PKL</h1>
                    </div>
<?php if ($akun['level'] == 1) { ?>
    <div class="card shadow">
        <div class="card-header py-2">
            <h4 class="card-title">
            <i class="fas fa-fw fa-address-card"></i>    
            Akun Peserta</h4>
        </div>
        <div class="card-body text-center">
            <h3>Kamu Tidak Memiliki Akun Peserta PKL</h3>
        </div>
    </div>
<?php } elseif ($akun['level'] == 0) { ?>
    <div class="card shadow">
        <div class="card-header py-2">
            <h4 class="card-title">
            <i class="fas fa-fw fa-address-card"></i>    
            Akun Peserta</h4>
        </div>
        <div class="card-body ">
            <div class="border border-primary rounded p-4 row">
                <div class="col-lg-3 text-center">
                    <img src="../assets/img/attachment/<?= $akun['foto'] ?>" alt="" width="80%" height="auto">
                </div>

                <div class="col-lg-9 row">
                    <label class="text-bold h4 col-4">Nama</label>
                    <label class="text-bold h4 col-8">: <?= $akun['nama'] ?></label>

                    <label class="text-bold h4 col-4">Username</label>
                    <label class="text-bold h4 col-8">: <?= $akun['username'] ?></label>

                    <label class="text-bold h4 col-4">Password</label>
                    <label class="text-bold h4 col-8" id="password">: <?= $akun['password'] ?></label>

                    <label class="text-bold h4 col-4">Tanggal Ditambahkan</label>
                    <label class="text-bold h4 col-8">: <?= date ('d F Y | H:s:i', strtotime($akun['created_at'])); ?></label>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<script>
    function showPassword(){
        var x = document.getElementById("password");
        if (x.type === "password"){
            x.type = "text";
        } else{
            x.type = "password";
        }
    }
    </script>



<?php
    include '../template/footer.php';
?>      