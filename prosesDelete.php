<?php
    require_once('koneksi.php');


    if(isset($_GET['Del'])){
        $id = $_GET['Del'];
        $query = "DELETE FROM barang WHERE id = '".$id."'";
        $result = mysqli_query($kon, $query);

        if($result){
            header("location:home.php");
        }
        else{
            echo 'Please Check your query';
        }
    }
    else{
        header("location:home.php");
    }
?>