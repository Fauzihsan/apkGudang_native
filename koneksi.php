<?php
    $kon = mysqli_connect('localhost', 'root', '', 'gudang');

    if(!$kon){
        echo "error".mysqli_error();
        // exit();
    }
    
function tampil($view){
    global $kon;
    $result = mysqli_query($kon, $view);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}   

function tampilUser($viewUser){
    global $kon;
    $result = mysqli_query($kon, $viewUser);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data){
    global $kon;

    $username = strtolower(stripslashes($data["username"])); 
    $password = mysqli_real_escape_string($kon, $data["password"]);
    $password2 = mysqli_real_escape_string($kon, $data["password2"]);
    $namaDepan = mysqli_real_escape_string($kon, $data["namaDepan"]);
    $namaBelakang = mysqli_real_escape_string($kon, $data["namaBelakang"]);
    $email = mysqli_real_escape_string($kon, $data["email"]);
    
    //cek username
    $validname = "SELECT * FROM akun WHERE username='$username'";
    $hasilvalid = mysqli_query($kon, $validname);
    if(mysqli_num_rows($hasilvalid) > 0){
        ?>
        <script type="text/javascript">
            <?php echo "alert('message');"; ?>
        </script>
        <?php
        return false;
    }

    //cek konfirmasi password
     if($password !== $password2){
         echo "
            <script>
                alert('Password tidak sesuai');
            </script>";
        return false;
     }

     //enkripsi password
     $password = password_hash($password, PASSWORD_DEFAULT);


     //tambah user ke db
     mysqli_query($kon, "INSERT INTO akun VALUES('', '$namaDepan', '$namaBelakang', '$email', '$username', '$password')");

    //  return mysqli_affected_rows($kon);

}

function inputBarang($barangBaru){
    global $kon;

    
    $mBarang = mysqli_real_escape_string($kon, $barangBaru["mBarang"]);
    $jBarang = mysqli_real_escape_string($kon, $barangBaru["jBarang"]);
    $stock = mysqli_real_escape_string($kon, $barangBaru["stock"]);
    $satuan = mysqli_real_escape_string($kon, $barangBaru["satuan"]);
    $qty = mysqli_real_escape_string($kon, $barangBaru["qty"]);
    $satuanQty = mysqli_real_escape_string($kon, $barangBaru["satuanQty"]);
    $user = mysqli_real_escape_string($kon, $barangBaru["user"]);

    $query= mysqli_query($kon, "INSERT INTO barang VALUES('', '$mBarang', '$jBarang', '$stock', '$satuan','$qty','$satuanQty','$user')");

    $query_run = mysqli_query($kon, $query);

    if($query_run){
        echo "<script> alert('Data Berhasil Dimasukan');</script>";
        header("location : home.php");
    }
    else{
        echo "<script> alert('Data Gagal Dimasukan');</script>";
    }

}

?>