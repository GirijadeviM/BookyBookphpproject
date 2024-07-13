
<?php
include("database.php");
?>
<?php
if(isset($_GET['category'])){
    $cat=urldecode($_GET['category']);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
               <a href="category.php?category=<?php echo $category['category'] ?>"><?php echo ucfirst($category['category']) ?></a>
            <?php
         }
      ?>
   </div>
   <div class="right"> <!-- Displaying the products -->
   <div class="section-title">Books in <?php echo ucfirst($cat)?></div>
   <?php $products = getProductsByCategory($cat) ?>
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
                  <p class="description"><?php echo $product['description'] ?></p>
                  <p class="price"><?php echo "RS.".$product['price'] ; ?></p><br>
                  
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
