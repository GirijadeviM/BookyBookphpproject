<?php
include("database.php");
?>
<?php
if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $mysqli = dbConnect(); 
   $update_quantity_query = $mysqli->query( "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query==true){
      header("Location: cart.php");
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   $mysqli = dbConnect(); 
   $result=$mysqli->query( "DELETE FROM `cart` WHERE id = '$remove_id'");
   header("Location: cart.php");
};

if(isset($_GET['delete_all'])){
   $mysqli = dbConnect(); 
  $result= $mysqli->query( "DELETE FROM `cart`");
  $mysqli->close();
   header("Location: index.php");
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="cart.css">
</head>
<body>

<?php
    include('navigation.php');
    
    ?>

   <div class="section-title">Books in Cart</div>
   <?php $products = getHomecartProducts() ?>
   <div class="right">
   <div class="product">
    
   <table>
<?php
 $grand_total=(int)0;
?>
<thead>
   <th>image</th>
   <th>name</th>
   <th>price</th>
   <th>quantity</th>
   <th>total price</th>
   <th>action</th>
</thead>

<tbody>
    <?php
         foreach ($products as $product) {
            ?>
               <tr><td>
                <div class="img">
                  <img src="<?php echo "products/{$product['image']}" ?>" alt="" id="image">
         </div>
         </td>
              <td>
               <?php echo $product['title'] ?>
         </td>
         <td>
             <p class="price"><?php echo "RS.".$product['price'] ; ?></p>
         </td>
         <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $product['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $product['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>$<?php echo $sub_total = (int)($product['price'] * $product['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $product['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total = $grand_total+$sub_total;  
            };
         ?>
        
        <tr class="table-bottom">
            <td><a href="index.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">Grand Total</td>
            <td>Rs.<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <form method="php"
     <input type="submit" name="order_btn" value="procced to checkout">
     <a href="checkout.php?delete_all" class="order-btn" > Procced to Checkout </a><br>
     <br>
     <br>
         </form>
   </div>  

</div>
</div>
</div>


<?php
include("fotter.php");
?>
</body>
</html>
<?php
function getHomecartProducts(){
    $mysqli = dbConnect();
   
    $st = $mysqli->prepare("SELECT * FROM cart ");
    
    $st->execute();
    $result = $st->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $products=$data;
    return $data;
    print_r($data);
}
?>
