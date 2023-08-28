<?php 
include 'koneksi.php';

//fungsi memanggil data
function query($query)
{
    global $db;

    $result = mysqli_query( $db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function tambahAdministrator($post)
{
    global $db;

    $name = $post['name'];
    $username = $post['username'];
    $password = $post['password'];
    $level = $post['level'];


    $file = upload_foto();
    if(!$file){
        return false ;
    }


    $query = "INSERT INTO users VALUES(null,'$name', '$username', '$password', '$level', '$file', CURRENT_TIMESTAMP, null)";

    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function editAdministrator($post)
{
    global $db;

    $id = $post['id'];
    $name = $post['name'];
    $username = $post['username'];
    $password = $post['password'];
    $level = $post['level'];


    if ($_FILES['file']['error'] == 4) {
        $file = $post['fotoLama'];
    } else {
        $file = upload_foto();
        if(!$file){
            return false ;
        }
    }



    $query = "UPDATE users SET nama = '$name', username = '$username', password = '$password', level = '$level',foto = '$file' WHERE id = $id";


    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function hapusAdministrator($id)
{
    global $db;

    $foto = query("SELECT * FROM users WHERE id = $id")[0] ;
    unlink("../assets/img/attachment/". $foto['foto']);

    $query = "UPDATE users SET deleted_at = CURRENT_TIMESTAMP WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function upload_foto()
{
    $namaFile = $_FILES['file']['name'];
    $ukuranFile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpName = $_FILES['file']['tmp_name'];


    // cek format file yang di upload
    $ekstensiFileValid = ['pdf','jpg', 'png', 'jpeg'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if(!in_array($ekstensiFile, $ekstensiFileValid)){
        echo "<script> 
                alert('File Yang Anda Upload Salah !'); 
                document.location.href = 'tambah-administrator.php' ;
            </script>";
        die();
    }

    // jika ukuran melampaui batas maksimal
    if ($ukuranFile > 2048000) { // batas 2 MB
        echo "<script>
                alert('Ukuran File Terlalu Besar');
                document.location.href = 'tambah-administrator.php';
            </script>";
        die();
    }

    // ubah nama file yang di upload
    $namaFilebaru = uniqid();
    $namaFilebaru .= '.';
    $namaFilebaru .= $ekstensiFile;

    // memindahkan data yg di upload ke folder file
    move_uploaded_file($tmpName, '../assets/img/attachment/' . $namaFilebaru);
    return $namaFilebaru;
}

function tambahDataPeserta($post)
{
    global $db;

    $nama = $post['name'];
    $users_id = $post['users_id'];
    $tgl_masuk = $post['tgl_masuk'];
    $tgl_keluar = $post['tgl_keluar'];
    $asal = $post['asal'];
    $is_active = 0;
    $id_lokasi = $post['id_lokasi'];

    $query = "INSERT INTO data_peserta VALUES(null,'$users_id','$nama', '$tgl_masuk', '$tgl_keluar', '$asal', $is_active, $id_lokasi, CURRENT_TIMESTAMP, null)";

    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function editDataPeserta($post)
{
    global $db;

    $id = $post['id'];
    $name = $post['name'];
    $users_id = $post['users_id'];
    $tgl_masuk = $post['tgl_masuk'];
    $tgl_keluar = $post['tgl_keluar'];
    $asal = $post['asal'];
    $is_active = $post['is_active'];
    $id_lokasi = $post['id_lokasi'];

    $query = "UPDATE data_peserta SET nama = '$name', users_id = '$users_id', tgl_masuk = '$tgl_masuk',tgl_keluar = '$tgl_keluar', asal = '$asal', is_active = '$is_active', id_lokasi = '$id_lokasi' WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function hapusDataPeserta($id)
{
    global $db;

    $query = "UPDATE data_peserta SET deleted_at = CURRENT_TIMESTAMP WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function tambahLokasi($post)
{
    global $db;

    $nama = $post['name'];

    $query = "INSERT INTO master_lokasi VALUES(null,'$nama', CURRENT_TIMESTAMP,null)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function editLokasi($post)
{
    global $db;

    $nama = $post['name'];
    $id = $post['id'];

    $query = "UPDATE master_lokasi set nama = '$nama' WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function hapusLokasi($id)
{
    global $db;

    $query = "UPDATE master_lokasi SET deleted_at = CURRENT_TIMESTAMP WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function absen($post,$from)
{
    global $db;
    
    date_default_timezone_set("Asia/Jakarta");
    
    $username = $post['username'];
    $password = $post['password'];
    $kegiatan = $post['kegiatan'];
    $keterangan = $post['keterangan'];
    $alasan = $post['alasan'];

    $min_time = date('07:30:00');
    $max_time = date('16:00:00');
    $current_time = date('H:i:s');



    $cek_users = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'" );
    $row = mysqli_fetch_assoc($cek_users);

    $id_users = $row['id'];

    $cek_absensi = query("SELECT * FROM data_absensi WHERE 1=1 AND id_users = $id_users ORDER BY tgl_absen DESC")[0];
    

    $last_absen = date('Y-m-d', strtotime($cek_absensi['tgl_absen']));
    $current_absen = date('Y-m-d');



    if ($last_absen == $current_absen) {
        echo "<script> 
                alert('Anda telah Absen Hari ini, silahkan Absen Kembali Besok! Terimakasih');
                document.location.href = 'index.php';
                
            </script>";

        return false ;
    }

    if(mysqli_num_rows($cek_users) === 1){
        if ($current_time >= $min_time && $current_time < $max_time) {
            $attachment = upload_foto_absensi($from);
                if(!$attachment){
                    return false ;
                }

                $query = "INSERT INTO data_absensi VALUES(null,'$id_users', CURRENT_TIMESTAMP,'$keterangan','$kegiatan','$attachment','$alasan',CURRENT_TIMESTAMP)";

                mysqli_query($db, $query);

                return mysqli_affected_rows($db);

        }else{
            echo "<script> 
                alert('Waktu Absen hari ini telah habis, silahkan Absen Kembali Besok! Terimakasih');
                document.location.href = 'index.php';
                
            </script>";
            return false;
        }
    }else{
        echo "<script> 
                alert('Username atau Password Tidak Ditemukan !'); 
            </script>";
            die();
        return false;
    }

}

function update_absen($post,$from)
{
    global $db;
    
    date_default_timezone_set("Asia/Jakarta");
    
    $id = $post['id'];
    $username = $post['username'];
    $password = $post['password'];
    $kegiatan = $post['kegiatan'];
    $keterangan = $post['keterangan'] ? $post['keterangan'] : $post['temp_keterangan'];
    $alasan = $post['alasan'];

    // var_dump($keterangan);
    // die();


    $cek_users = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'" );
    $row = mysqli_fetch_assoc($cek_users);

    $id_users = $row['id'];


    if(mysqli_num_rows($cek_users) === 1){
        if ($_FILES['file']['error'] == 4) {
            $attachment = $post['attachment_lama'];
        } else {
            $attachment = upload_foto_absensi($from);
        if(!$attachment){
            return false ;
        }
        }

        $query = "UPDATE data_absensi SET keterangan = '$keterangan', kegiatan = '$kegiatan', alasan = '$alasan', attachment = '$attachment' WHERE id = $id";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);

    }else{
        echo "<script> 
                alert('Username atau Password Tidak Ditemukan !'); 
            </script>";
            die();
        return false;
    }

}

function upload_foto_absensi($from)
{
    // var_dump($from);
    // die();
    $namaFile = $_FILES['file']['name'];
    $ukuranFile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpName = $_FILES['file']['tmp_name'];


    // cek format file yang di upload
    $ekstensiFileValid = ['pdf','jpg', 'png', 'jpeg'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if(!in_array($ekstensiFile, $ekstensiFileValid)){
        echo "<script> 
                alert('File Yang Anda Upload Salah !'); 
                document.location.href = 'index.php' ;
            </script>";
        die();
    }

    // jika ukuran melampaui batas maksimal
    if ($ukuranFile > 2048000) { // batas 2 MB
        echo "<script>
                alert('Ukuran File Terlalu Besar');
                document.location.href = 'index.php';
            </script>";
        die();
    }

    // ubah nama file yang di upload
    $namaFilebaru = uniqid();
    $namaFilebaru .= '.';
    $namaFilebaru .= $ekstensiFile;

    // memindahkan data yg di upload ke folder file
    if ($from == 'dashboard') {
        move_uploaded_file($tmpName, '../assets/img/attachment/file-absensi/' . $namaFilebaru);
        
    }elseif ($from = 'nodashboard') {
        move_uploaded_file($tmpName, 'assets/img/attachment/file-absensi/' . $namaFilebaru);
        
    }
    return $namaFilebaru;
}