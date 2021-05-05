<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <script src="js/sweetalert2@10.js"></script>
</head>
<body>
<?php 
session_start();
require "koneksi.php";
$email = "";
// $profile = $_SESSION['username'];
$errors = array();

//if user signup button
if(isset($_POST['register'])){
    $username = strtolower(stripslashes($_POST["username"])); 
    $password = mysqli_real_escape_string($kon, $_POST["password"]);
    $password2 = mysqli_real_escape_string($kon, $_POST["password2"]);
    $namaDepan = mysqli_real_escape_string($kon, $_POST["namaDepan"]);
    $namaBelakang = mysqli_real_escape_string($kon, $_POST["namaBelakang"]);
    $email = mysqli_real_escape_string($kon, $_POST["email"]);
    if($password !== $password2){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM akun WHERE email = '$email'";
    $res = mysqli_query($kon, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    $username_check = "SELECT * FROM akun WHERE username = '$username'";
    $res2 = mysqli_query($kon, $username_check);
    if(mysqli_num_rows($res2) > 0){
        $errors['username'] = "Username that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO akun VALUES('', '$namaDepan', '$namaBelakang', '$email', '$username', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($kon, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Hello $namaDepan, your verification code is $code , Thanks ~ admin@tokozi.cianjur";
            $sender = "From: tokoz1.cianjur@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($kon, $_POST['otp']);
        $check_code = "SELECT * FROM akun WHERE code = $otp_code";
        $code_res = mysqli_query($kon, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            //test
                $fetch_namaDepan = $fetch_data['namaDepan'];
                $fetch_namaBelakang = $fetch_data['namaBelakang'];
                $fetch_email = $fetch_data['email'];
            //test
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE akun SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($kon, $update_otp);
            if($update_res){
                $insert_pegawai = "INSERT INTO daftarpegawai VALUES('', '$fetch_namaDepan', '$fetch_namaBelakang', '$fetch_email')";
                $data_check = mysqli_query($kon, $insert_pegawai);
                if($data_check){
                    $_SESSION['email'] = $email;
                    sleep(5);
                    header('location: index.php');
                    exit();
                }else{
                    $errors['db-error'] = "Failed while inserting data into database!";
                }
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($kon, $_POST['username']);
        $password = mysqli_real_escape_string($kon, $_POST['password']);
        $check_username = "SELECT * FROM akun WHERE username = '$username'";
        $res = mysqli_query($kon, $check_username);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email ";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['username'] = "Incorrect username or password!";
            }
        }else{
            $errors['username'] = "Incorrect username or password";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($kon, $_POST['email']);
        $check_email = "SELECT * FROM akun WHERE email='$email'";
        $run_sql = mysqli_query($kon, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE akun SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($kon, $insert_code);
            if($run_query){
                $subject = "Reset Password Verification Code";
                $message = "Hello $nama, your verification code for Reset Password is $code , Thanks ~ admin@tokozi.cianjur";
                $sender = "From: tokoz1.cianjur@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($kon, $_POST['otp']);
        $check_code = "SELECT * FROM akun WHERE code = $otp_code";
        $code_res = mysqli_query($kon, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($kon, $_POST['password']);
        $cpassword = mysqli_real_escape_string($kon, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE akun SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($kon, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

        //if user click change password button on home page
        if(isset($_POST['change-password2'])){
            $user = mysqli_real_escape_string($kon, $_POST['username']);
            // $password = mysqli_real_escape_string($kon, $_POST['currentPassword']);
            $nPassword = mysqli_real_escape_string($kon, $_POST['password']);
            $cPassword = mysqli_real_escape_string($kon, $_POST['cpassword']);

        if($nPassword !== $cPassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($nPassword, PASSWORD_BCRYPT);
            $update_pass = "UPDATE akun SET password = '$encpass' WHERE username = '$user'";
            $run_query = mysqli_query($kon, $update_pass);
            if($run_query){
                ?>
                <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '<p style="color : white; font-size:20px; text-shadow: 2px 2px #000000;">Your password changed. Now you can login with your new password.</p>',
                    showConfirmButton: true,
                    confirmButtonText : '<a href="index.php" style="text-decoration:none; color:white; font-size:20px;"><div style="width:100%; height:100%;">CONTINUE</div></a>',
                    background : "linear-gradient(to right, #192888, #4151c0)",   
                });
                // window.location.href = "password-changed.php";
                </script>
          <?php
                // $info = "Your password changed. Now you can login with your new password.";
                // $_SESSION['info'] = $info;
                // header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: index.php');
    }
?>

</body>
</html>