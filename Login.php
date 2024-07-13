<?php
include("database.php");
$session_start;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <!-- <link rel="Stylesheet" href="reg.css"> -->
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
    margin:0%;
    padding:0%;
}
.main{
    background:linear-gradient(to top,rgb(0, 0, 0,0.5)50%,rgb(0, 0, 0,0.5)50%),url(https://images.pexels.com/photos/3476312/pexels-photo-3476312.jpeg?cs=srgb&dl=pexels-venelin-dimitrov-3476312.jpg&fm=jpg);
   width:100%;
   height:100%;
   background-position: center;
background-size: cover;
position: fixed;
}
#login{
    margin-top:2.5vw;
    padding-left:7vw;
    padding-right: 7vw;
    padding-top: 1vw;
    padding-bottom: 10px;
    border:1px solid rgb(72, 69, 69);
    border-radius:20px;
    background-color:rgb(72, 69, 69);
    color:white;
}
.log input{
        border:none ;
        outline:none;
        background-color: white;
        border-bottom:1px solid black;
        border-left:0px;
        border-right:0px;
        background-color: white;
    }
    .head{
       text-align: center;
       padding-bottom:5px;
       font-size:35px;
       font-family:'Serif';
     }
     .welcome{
        font-size:1.5vw;
        font-family:garamond;
        padding: 1vw;
       text-align:center;
    }
    .logn{
    display:flex;
    align-items: center;
    justify-content: center;
    padding:20px;
    height:100%;
    width:100%;
    
     }
     .log{
    

padding:50px 50px 50px 60px;
background-color:white;
line-height: 2vw;

font-size:1vw;

     
     }
     .logn{
        background:linear-gradient(to top,rgb(0, 0, 0,0.5)50%,rgb(0, 0, 0,0.5)50%),url(https://images.pexels.com/photos/3476312/pexels-photo-3476312.jpeg?cs=srgb&dl=pexels-venelin-dimitrov-3476312.jpg&fm=jpg);
   width:100%;
   height:100%;
background-size: cover;
position: fixed;
     }
     .forgot{
        margin-left:140px;

     }
     .new{
        margin-top:6px;
     }
     a{
        text-decoration:none;
        color:blue;
        font-size:17px;
     }
     .new a{
        color:orange;
     }
        </style>
</head>
<body>
<?php

$nameErr =  $passworderr  = "";
$username= $password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
 
    $password = $_POST["password"];

  
    $mysqli = dbConnect();
    $result = $mysqli->query("select Password from user where user_name='$username'");
   
if( mysqli_num_rows($result) >0){
   while($row=mysqli_fetch_assoc($result)){
    $pass=$row["Password"];
    if($password==$pass){
    $_SESSION["username"]=$username;
    $_SESSION["password"]=$password;
    header("location: index.php");
    }
   else{
  $passworderr ="Enter the password correctly";
  
   }
      }
    }
else
$nameErr = "Enter the username Correctly!!!";
}

?>
<div class="logn">
    <div class="log">
            <div class="head">
            Booky Books
            </div>
            <div class="welcome">
                Welcome Back 
            </div>
            
                
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
 Username:<br> <input type="text" name="name" size="30" value="<?php echo $username;?>">
  <br>
  <span class="error"> <?php echo $nameErr;?></span>
  <br>
<label>Passsword</label><br>
<input type="password" name="password" size="30" value="<?php echo $password;?>"> <br>
<span class="error"><?php echo $passworderr;?></span><br>
<a href="" class="forgot">forgot password?</a><br>
    <input type="submit" value="login" id="login" ><br>
</form>
<div class="new"> New Booky Books? <a href="register.php">Create Account</a>
</div>
</div>
</body>
</html>
