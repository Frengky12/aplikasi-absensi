<?php
    include '../config/koneksi.php';
    include '../config/control.php';

    $id = (int)$_GET['id'];

    if (hapusAdministrator($id) > 0) {
        echo "<script>
                alert('Data Administrator Berhasil Dihapus');
                document.location.href = 'administrator.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Administrator Gagal Dihapus');
                document.location.href = 'administrator.php';
            </script>";
    }
