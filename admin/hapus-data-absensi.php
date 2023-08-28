<?php
    include '../config/koneksi.php';
    include '../config/control.php';

    $id = (int)$_GET['id'];

    if (hapusAbsen($id) > 0) {
        echo "<script>
                alert('Data Absen Berhasil Dihapus');
                document.location.href = 'data-absensi.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Absen Gagal Dihapus');
                document.location.href = 'data-absensi.php';
            </script>";
    }
