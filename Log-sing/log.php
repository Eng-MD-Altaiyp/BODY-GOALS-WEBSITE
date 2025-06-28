<?php

include '../connaction.php';

$unameer=$passworder="";
if(isset($_POST['submit']))
{
    $uname=$_POST['uname'];
    $password=$_POST['password'];



    if(
     empty($uname) || 
       empty($password)
       )
    {
        if(empty($uname))
        $unameer="* User Name is Required"; 
        if(empty($password))
        $passworder="* Password  is Required";
    }
    else{
        $check=0;
         if($uname && !preg_match("/^[a-zA-Z]/",$uname))
         {
            $unameerer="* Make sure not to enter numbers";
         }
         $search="SELECT uname,password FROM users WHERE uname='{$uname}' and password='{$password}'";
         $res=$connect->query($search);
         if($res->num_rows>0){
          
            echo header("location: ../index.php");
         }

    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
</head>
<body>
    



    <div class="circle"></div>
    <div class="card">
    <div class="logo">
            <img src="../assets/logo.jpeg" alt="">
        </div>
        <h2>LOG IN</h2>
        <form class="form" method="POST">
            <input type="text" placeholder="User Name" name="uname">
            <span id="req"><?php echo $unameer; ?></span>
            <input type="password" placeholder="Password" name="password">
            <span id="req"><?php echo $passworder; ?></span>
            <input type="submit" name="submit">LOG IN</input>
        </form>
        <footer>
            Existing users, sign in
            <a href="sing.php">Here</a>
        </footer>
    </div>
   
</body>
</html>