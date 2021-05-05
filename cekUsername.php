<?php
    require("koneksi.php");

    if(isset($_POST) & !empty($_POST)){
        $username = mysqli_real_escape_string($kon, $_POST['username']);
        $sql="SELECT * FROM akun WHERE username='$username'";
        $result=mysqli_query($kon, $sql);
        $count = mysqli_num_rows($result);
        if($username != ''){
        if($count > 0){
            echo '<div style="color:red; text-transform: lowercase;"><b>'.$username.'</b> is not available</div>';
        }
        else{
            echo '<div style="color:green; text-transform: lowercase;"><b>'.$username.'</b> is available</div>';
        }
        }
    }
?>