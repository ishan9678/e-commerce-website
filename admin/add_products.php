<?php
include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/' . $image; // Store images in the "images" folder

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'Product name already exists!';
   } else {
      if ($image_size > 2000000) {
         $message[] = 'Image size is too large';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'New product added!';
      }
   }
}

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('' . $fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_cart = $conn->prepare(" SET  @num := 0;UPDATE products SET id = @num := (@num+1);ALTER TABLE `products` AUTO_INCREMENT = 1");

   header('location:products.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Card Component</title>
   <!-- bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
   <!-- css -->
   <!-- Link to the separate CSS file -->
   <link rel="stylesheet" href="/admin/admin_styles.css">
</head>

<body>
   <div class="add-products">
      <form action="" method="POST" enctype="multipart/form-data">
         <div class="title">
            <h3><strong>Add Product</strong></h3>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <input type="text" class="form-control" required placeholder="Enter product name" name="name" maxlength="100" class="box">
               </div>
               <div class="col-lg-6">
                  <input type="number" class="form-control" required placeholder="Enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">

               </div>
            </div>
         </div>

         <select name="category" class="box" required>
            <option value="" class="form-control" disabled selected>Select category --</option>
            <option value="Ladies">Ladies</option>
            <option value="Men">Men</option>
            <option value="Kids">Kids</option>
            <option value="Baby">Baby</option>
            <option value="Sports">Sports</option>
            <option value="Sale">Sale</option>
         </select>
         <input type="file" name="image" class="box box-img" required>
         <div class="add-btn">
            <button type="submit" value="Add Product" name="add_product" class="btn btn-dark">Add</button>
         </div>
      </form>
   </div>

   <div class="container show-products">
      <h2 class="products-title">Products Added</h2>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
         <?php
         $show_products = $conn->prepare("SELECT * FROM `products`");
         $show_products->execute();
         if ($show_products->rowCount() > 0) {
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="col d-flex justify-content-center">
                  <div class="card" style="width: 18rem;">
                     <div class="image-container">
                        <img class="img card-img-top" src="images/<?= $fetch_products['image']; ?>" alt="Product image" style="height: 350px;">
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-8">
                              <div class="name"><?= $fetch_products['name']; ?></div>
                           </div>
                           <div class="col-lg-4 text-end">
                              <div class="category"><?= $fetch_products['category']; ?></div>
                           </div>
                        </div>
                        <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?><span>.00</span></div>
                        <a href="products.php?delete=<?= $fetch_products['id']; ?>" id="delete-btn" class="btn btn-danger">Delete</a>
                     </div>
                  </div>
               </div>
         <?php
            }
         }
         ?>
      </div>
   </div>




   <?php

   ?>
   </div>
   </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

<script src="script.js"></script>

</html>