<?php
    include 'dbUpdate.php';

    if(isset($_POST['id'])){
        $value = $_POST['value'];
        $column = $_POST['column'];
        $id = $_POST['id']; //md5

        $sql = "UPDATE barang SET $column= :value WHERE md5(id) = :id LIMIT 1";
        $query = $db->prepare($sql);
        $query->bindParam('value',$value);
        $query->bindParam('id',$id);
        
        if($query->execute()){
            echo "Update Successfull";
        }else{
            echo "Failure"; 
        }
    }
?>