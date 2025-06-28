
<?php


$fnameer=$unameer=$emailer=$phoneer=$passworder=$conpassworder="";
$all="";
include '../connaction.php';
mysqli_set_charset($connect,'utf8');

if(isset($_POST['submit']))
{
    // $Page = $_GET['page'];

   $uname=$_POST['uname'];
    $fname=$_POST['fname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $conpassword=$_POST['conpassword'];

    if(
        empty($fname) ||
     empty($uname) || 
     empty($phone) ||
      empty($email) ||
      empty($conpassword) ||
       empty($password)
       )
    {
        if(empty($fname))
        $fnameer="* يرجا ادخال الإسم";
        if(empty($uname))
        $unameer="* يرجا ادخال اسم المستخد"; 
        if(empty($phone))
        $phoneer="* يرجا ادخال رقم الهاتف ";
        if(empty($email))
        $emailer="* يرجا ادخال اللإميل";
        if(empty($password))
        $passworder="* يرجا ادخال كلمة المرو";
        if(empty($conpassword))
        $conpassworder="* يرجا ادخال  تأكيد كلمة المرور  ";
    }
    else{
        
        $check=0;
        
         if($email && !preg_match("/^[a-zA-Z0-9]*@+[a-z]+(\.com)+/",$email))
         {
            $check++;
            $emailer="a-z0-9@a-z.com";
         }
         
         if($phone && preg_match("/^[a-zA-Z]/",$phone))
         {
            $check++;
            $phoneer="* لا يسمح لرقام بحتواءة على حروف";
         }

         if($conpassword!=$password)
         {
            $check++;
            $conpassworder="* ليست متطابقة مع كلمة المرور";
         }
         if($check==0)
         {
            
            $search="SELECT uname,password FROM users WHERE uname='{$uname}' and password='{$password}'";
            $res=$connect->query($search);
            if($res->num_rows>0){
                $all="هذا الحساب موجود مسبقاً";
            }
            else
            {

               $insert="INSERT INTO users SET 
               fname='{$fname}',
               uname='{$uname}',
               email='{$email}',
               phone='{$phone}',
               password='{$password}'
               ";

                 $Sql=mysqli_query($connect,$insert);
                 if($Sql)
                 { 
                    echo header("location: ../index.php");
                }
                else
                {
                    $at=" <script> 
                    alert('Feiled');
                    </script>";
                    echo $at;
                }
              
            }

            // Navigetor for Home 

         }

    }

}

//$Gender=$_POST['gen'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>SignIn</title>
</head>
<body>
    
    <div class="circle"></div>
    <div class="card">
        <div class="logo">
            <img src="../assets/logo.jpeg" alt="">
        </div>
        <h2>Create Account</h2>
        <form class="form" method="POST">
            <input type="text" placeholder="User Name" name="uname">
            <span id="req"><?php echo $unameer; ?></span>
            <input type="text" placeholder="Full Name" name="fname">
            <span id="req"><?php echo $fnameer; ?></span>
            <input type="text" placeholder="Phone Namber" name="phone">
            <span id="req"><?php echo $phoneer; ?></span>
            <input type="email" placeholder="Email" name="email">
            <span id="req"><?php echo $emailer; ?></span>
            <input type="password" placeholder="Password" name="password">
            <span id="req"><?php echo $passworder; ?></span>
            <input type="password" placeholder="conpassword" name="conpassword">
            <span id="req"><?php echo $conpassworder; ?></span>
            <input type="submit" name="submit">SIGN UP</input>
            </form>
        <footer>
            Existing users, log in
            <a href="Log.php">Here</a>
        </footer>
    </div>
</body>
</html>