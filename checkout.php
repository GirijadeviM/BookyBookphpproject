<?php
require "config.php";

function dbConnect(){
   $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
   if($mysqli->connect_errno != 0){
      return FALSE;
   }else{
      return $mysqli;
   }
}


if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $district = $_POST['district'];
  
   $pin_code = $_POST['pin_code'];
   $mysqli = dbConnect();
   $cart_query = $mysqli->query("SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['title'] .' ('. $product_item['quantity'] .') ';
         $product_price = (int)($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   
   $detail_query = $mysqli->query("INSERT INTO `order`(name, number, email, method, flat, street, city,district,pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city', '$district','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query ){
      echo "
      <div class='order-message-container'>
      <div class='message-container'><br>
         <h3 >Thank you for Shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> Total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> Name : <span>".$name."</span> </p>
            <p> Phone Number : <span>".$number."</span> </p>
            <p> Email : <span>".$email."</span> </p>
            <p> Address : <span>".$flat.", ".$street.", ".$city.", ".$district.", - ".$pin_code."</span> </p>
            <p> Payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='index.php' class='btn'>Continue Shopping</a><br><br>
            <br>
         </div>
      </div>
      ";
      $mysqli = dbConnect(); 
      $result= $mysqli->query( "DELETE FROM `cart`");
      $mysqli->close();
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="Stylesheet" href="checkout.css">
</head>
<body>
<div class="logn">
    <div class="log">

    <div class="welcome">Complete your Order</div>

   <form action="" method="post">
   <?php
      $mysqli = dbConnect(); 
         $select_cart = $mysqli->query("SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = (int)($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
         
      ?>
     
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";?><br>
         <a href='index.php' class="shop">Click here to shop</a><br><br>
      <?php
      }
      ?>
      
         <div class="inputBox">
            <span>your name</span><br>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span><br>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span><br>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span><br>
            <select name="method">
            <option value="credit cart">Credit Card</option>
               <option value="cash on delivery" selected>cash on delivery</option>
               
            </select>
            <br>
         </div>
         <div class="inputBox">
            <span>address line 1</span><br>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span><br>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span><br>
            <input type="text" placeholder="e.g. velacheri" name="city" required>
         </div>
         <div class="inputBox">
            <span>District</span><br>
            <input type="text" placeholder="e.g. chennai" name="district" required>
         </div>
        
         <div class="inputBox">
            <span>pin code</span><br>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      
      <input type="submit" value="order now" name="order_btn" id="btn">
   </form>
   </div>
   </div>


</body>
</html>