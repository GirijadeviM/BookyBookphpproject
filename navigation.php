
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="style.css">
    <title>Document</title>
    <style>
      nav{
    display: grid;
    grid-template-columns: auto 1fr;
    align-items: center;
    grid-column-gap: 30px;
    grid-template-rows: 70px;
    box-shadow: 0 5px 5px rgba(0,0,0,0.15);
    position: sticky;
    top: 0;
    background-color: white;
    padding-left: 20px;
    padding-right: 20px;
 }
  
 nav .brand{
    font-size: 28px;
    font-weight: 900;
    color: #245990;
 }
  
 nav a{
    text-decoration: none;
    display: inline-block;
    padding: 10px 35px;
    transition: background-color 0.3s, color 0.3s;
    color: #245990;
    font-size: 18px;
 }
  
 nav a:hover,
 nav a.active{
    background: #4d9176;
    color: #fff;
    border-radius: 3px;
 }
 nav a:active{
    background-color: red;
 }
  
 input{
   border :0px;
   background-color:white;
   color: #245990;
font-size: 18px;
padding: 10px 35px;
transition: background-color 0.3s, color 0.3s;
}
.sub:hover{
   background: #4d9176;
color: #fff;
border-radius: 3px;

}
      </style>
</head>
<body>
<nav>
   <div class="brand">Booky Books</div>
   <div class="links">
      
   
      <a  href="index.php">Home</a>
      <a href="cart.php">Cart</a>

   

</div>
</nav>
</body>
</html>
<?php 
if(isset($_POST["logout"]))
{
    SESSION_destroy();
    header("location:login.php");
}

?>