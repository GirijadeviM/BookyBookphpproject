
<?php
include("database.php");
$session_start;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="style.css">
    <title>Document</title>
    <style>
      .btnadd{
   color:white;
    background-color:rgb(6, 6, 245);
    font-size:15px;
    border:1px solid rgb(13, 12, 15);
    border-radius:20px;
   padding:10px 17px 10px 17px;
 }
      </style>
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
               <a href="category.php?category=<?php echo $category['category'] ?>"><?php echo ucfirst($category['category']) ?></a>
            <?php
         }
      ?>
   </div>
   <div class="right"> <!-- Displaying the products -->
   <div class="section-title">Home page</div>
   <?php $products = getHomePageProducts(8) ?>
   <div class="product">
      <?php
         foreach ($products as $product) {
            ?>
               <div class="product-left">
                  <img src="<?php echo "products/{$product['image']}" ?>" alt="">
               </div>
               <div class="product-right">
                  <p class="title">
                     <a href="product.php?title=<?php echo urlencode($product['title']) ?>">
                        <?php echo $product['title'] ?>
                     </a>
                  </p>
                  <p class="description"><?php echo $product['description'];?></p><br>
                  <p class="price"><?php echo "RS.".$product['price'];?><br><br></p>

               </div>
            <?php
         }
      ?>
   </div>
</div>
</main>
<?php
include("fotter.php");
?>
</body>
</html>
