<?php
function generateProduct($productID)
{
    include 'C:\Users\mahna\Desktop\ir project\admin\connect.php';
    $show_product = $conn->prepare("SELECT * FROM `products` WHERE `id` = :product_id");
    $show_product->bindParam(':product_id', $productID, PDO::PARAM_INT);
    $show_product->execute();

    if ($show_product->rowCount() > 0) {
        echo '<div class="section" style="margin-top: 25px">
    <div class="container product">';
        while ($fetch_product = $show_product->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row product-container">
            <div class="col-md-6">
                <div class="product-image">
                    <img src="../admin/images/' . $fetch_product['image'] . '" alt="Product image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 details-container">
                <div class="details">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="product-title">' . $fetch_product['name'] . '</h2>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-10">
                            <div class="price"><span>Rs.</span>' . $fetch_product['price'] . '<span>.00</span></div>
                        </div>
                        <div class="col-2 text-end">
                            <span class="heart-icon"> <i class="fa-regular fa-heart fa-xl" style="color: #919191;"></i> <span/>
                        </div>
                    </div>
                    <div class="row add-cart">
                        <div class="col-12">
                            <form method="POST" action="cart.php"> <!-- Added action attribute -->
                                <button class="btn btn-dark add-btn btn-block" name="add-cart" type="submit">
                                    <i class="fa-solid fa-bag-shopping" style="color: #fff;"></i> Add
                                </button>
                                <input type="hidden" name="product_id" value="' . $productID . '">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo '</div>
</div>';
    } else {
        echo '<div class="section" style="margin-top: 25px">
    <div class="container show-products">
        <h2 class="products-title">Product Not Found</h2>
        <p>The requested product does not exist.</p>
    </div>
</div>';
    }
}

?>




<?php include 'C:\Users\mahna\Desktop\ir project\admin\connect.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['add-cart'])) {
    if ($user_id == '') {
        header('location: ../login/login.php');
        exit();
    } else {
        $productId = $_POST['product_id']; // Use POST instead of GET to avoid potential security issues

        $insert_cart_item = $conn->prepare("INSERT INTO cart (user_id, pid) VALUES (?, ?)");
        $insert_cart_item->execute([$user_id, $productId]);

        if ($insert_cart_item) {
            header('location: ../pages/cart.php');
            exit();
        } else {
            echo "Error adding item to the cart.";
        }
    }
}

?>