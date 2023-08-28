<?php
    include '../config/koneksi.php';
    include '../config/control.php';

    $id = (int)$_GET['id'];

    if (hapusLokasi($id) > 0) {
        echo "<script>
                alert('Lokasi Berhasil Dihapus');
                document.location.href = 'master-lokasi.php';
            </script>";
    } else {
        echo "<script>
                alert('Lokasi Gagal Dihapus');
                document.location.href = 'master-lokasi.php';
            </script>";
    }
