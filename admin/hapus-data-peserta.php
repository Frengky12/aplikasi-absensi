<?php
    include '../config/koneksi.php';
    include '../config/control.php';

    $id = (int)$_GET['id'];

    if (hapusDataPeserta($id) > 0) {
        echo "<script>
                alert('Data Peserta Berhasil Dihapus');
                document.location.href = 'data-peserta.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Peserta Gagal Dihapus');
                document.location.href = 'data-peserta.php';
            </script>";
    }
