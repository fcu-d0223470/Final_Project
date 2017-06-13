<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
    $id = $_POST["id"];
    
	//更換手機
    $change_phone="UPDATE user SET user_phone_number='' WHERE user_id='$id'";
    $connect_change_phone=mysqli_query($link,$change_phone);
    
    if ($connect_change_phone) {
        echo "Change Sucessfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    mysqli_close($link);
?>