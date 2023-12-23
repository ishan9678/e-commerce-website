<script>
    function navigateToProduct(productID) {
        window.location.href = "/pages/product.php?id=" + productID;
    }
</script>

<?php
include 'C:\Users\mahna\Desktop\ir project\admin\connect.php';

function generateCategoryPage($category)
{
    include 'C:\Users\mahna\Desktop\ir project\admin\connect.php';
    $show_products = $conn->prepare("SELECT * FROM `products` WHERE `category` = :category");
    $show_products->bindParam(':category', $category, PDO::PARAM_STR);
    $show_products->execute();

    if ($show_products->rowCount() > 0) {
        echo '<div class="section" style="margin-top: 25px">
                <div class="container show-products">
                    <h2 class="products-title">' . $category . '</h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">';
        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            $productID = $fetch_products['id']; // Get the product ID from the database
            echo '<div class="col d-flex justify-content-center">
                    <div class="card" onClick="navigateToProduct(' . $productID . ')" style="width: 18rem;">
                        <div class="image-container">
                            <img class="img card-img-top" src="../admin/images/' . $fetch_products['image'] . '" alt="Product image" style="height: 350px;">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="name">' . $fetch_products['name'] . '</div>
                                </div>
                            </div>
                            <div class="price"><span>Rs.</span>' . $fetch_products['price'] . '<span>.00</span></div>
                        </div>
                    </div>
                </div>';
        }
        echo '</div>
            </div>
        </div>';
    } else {
        echo '<div class="section" style="margin-top: 25px">
                <div class="container show-products">
                    <h2 class="products-title">' . $category . '</h2>
                    <p>No products available in this category.</p>
                </div>
            </div>';
    }
}
?>