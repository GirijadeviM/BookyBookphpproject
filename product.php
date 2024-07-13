
<?php
include("database.php");
?>
<?php
if(isset($_GET['title'])){
    $cat=urldecode($_GET['title']);
    $product=getProductByTitle($cat);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $product[0]['meta_description']?>">
    <meta name="keywords" content="<?php echo $product[0]['meta_keywords']?>">
    
    <link rel="Stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    include('navigation.php');
    INCLUDE('head.php');
    ?>
    <main>
    <div class="left"> <!-- Displaying the categories -->
      <div class="section-title">Book Categories</div>
      <?php $categories = getCategories() ?>
      <?php
         foreach ($categories as $category) {
            ?>
               <a href="category.php?category=<?php echo $category['category'] ?>">
                  <?php echo ucfirst($category['category']) ?></a>
            <?php
         }
      ?>
   </div>
   <div class="right"> <!-- Displaying the products -->
   <div class="section-title">Book details</div>
 
   <div class="product">
     
               <div class="product-left">
                  <img src="<?php echo "products/{$product[0]['image']}" ?>" alt="">
               </div>
               <div class="product-right">
                  <p class="title">
                       <?php echo $product[0]['title'] ?>
                    
                  </p>
                  <p class="description"><?php echo $product[0]['description'] ?></p>
                  <p class="price"><?php echo "RS.".$product[0]['price'] ; ?></p><br><br>
                  <form action="" method="post">
                  <input type="submit" class="btnadd" value="Add to Cart" name="add_to_cart"><br><br>
         </form>
               </div>
          
   </div>
</div>
</main>
<?php
include("fotter.php");
?>
</body>
</html>
<?php

if(isset($_POST['add_to_cart'])){
   ob_start(); 
   $product_name = $product[0]['title'];
   $product_price =$product[0]['price'];
   $product_image = $product[0]['image'];
   $product_id = $product[0]['id'];
   $product_quantity = 1;
   $mysqli = dbConnect(); 
   $select_cart = $mysqli->query( "SELECT * FROM `cart` WHERE title = '$product_name' ");

   if($select_cart->num_rows > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = $mysqli->query( "INSERT INTO `cart`(title, price, image, quantity,id) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$product_id')");
   
     header("Location:cart.php");
   }
   $mysqli->close();
     ob_end_flush();
   

}
?>