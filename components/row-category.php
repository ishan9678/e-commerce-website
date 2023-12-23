<script>
function navigateToProduct(productID) {
    window.location.href = "pages/product.php?id=" + productID;
}
</script>


<?php
function generateProductCarousel($category, $carouselId)
{
    include 'C:\Users\mahna\Desktop\ir project\admin\connect.php';
    $show_products = $conn->prepare("SELECT * FROM `products` WHERE category = '$category' ");
    $show_products->execute();
    $totalProducts = $show_products->rowCount();

    // Determine the number of cards per slide based on the device
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $isMobile = (strpos($userAgent, 'mobile') !== false || strpos($userAgent, 'android') !== false);

    // Set different cards per slide for desktop and mobile
    $cardsPerSlide = $isMobile ? 1 : 3;

    ob_start();

    if ($totalProducts > 0) {
        echo '<div class="section">
                <div class="container show-products">
                    <h2 class="products-title">' . $category . '</h2>
                    <div id="productCarousel' . $carouselId . '" class="carousel slide">
                        <div class="carousel-inner">';

        $slideCount = 0;
        $cardCount = 0;

        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            if ($cardCount % $cardsPerSlide === 0) {
                // Start a new slide
                if ($slideCount === 0) {
                    echo '<div class="carousel-item active">';
                } else {
                    echo '<div class="carousel-item">';
                }
                echo '<div class="row">';
            }

            $productID = $fetch_products['id'];

            echo '<div class="col d-flex justify-content-center">
                    <div class="card" onClick="navigateToProduct(' . $productID . ')" style="width: 18rem;">
                        <div class="image-container">
                            <img class="img card-img-top" src="admin/images/' . $fetch_products['image'] . '" alt="Product image" style="height: 350px;">
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

            $cardCount++;

            if ($cardCount % $cardsPerSlide === 0 || $cardCount === $totalProducts) {
                // Close the row and slide
                echo '</div></div>';
                $slideCount++;
            }
        }

        echo '</div>
              <button class="carousel-control-prev carousel-dark" type="button" data-bs-target="#productCarousel' . $carouselId . '" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next carousel-dark" type="button" data-bs-target="#productCarousel' . $carouselId . '" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>';
    }

    return ob_get_clean();
}

?>