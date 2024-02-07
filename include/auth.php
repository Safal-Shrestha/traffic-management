<?php
    include("db.php");

    $username = $_POST["uname"];
    $password = $_POST["password"];

    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($conn, $username);  
    $password = mysqli_real_escape_string($conn, $password);  

    $sql = "SELECT *from users where uname = '$username' and password = '$password'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 
    $role = "$row[role]"; 

    if($count == 1){  
        if($role == 1){
            session_start();
            $_SESSION['username'] = $row['uname'];
            $_SESSION['id'] = session_create_id();
            header("location: ../admin.php");
        }
        else{
            session_start();
            $_SESSION["username"] = $row["username"];
            $_SESSION['id'] = session_create_id();
            $_SESSION['uid'] = $row['id'];
            header("location: ../client.php");
        }
    }  
    else{ 
        session_start(); 
        $_SESSION["errorMessage"] = "Invalid Credentials";
        header("Location: ../index.php");
    }