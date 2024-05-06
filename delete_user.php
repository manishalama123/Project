<?php
include 'connection.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    
    $sql="delete from `userinfo` where id=$id";
    $result= mysqli_query($con,$sql);
    if($result){
      header("location: admin.php");

    }else{
        die(mysqli_error($con));
    }
}
?>