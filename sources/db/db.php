<?php
    $host = 'localhost';
    $db='coach_pro';
    $username='root';
    $password='';
    $conn=new mysqli($host,$username,$password,$db);
    if($conn->connect_error){
        die('conection not succesefull' . $conn->connect_error);
    }
?>