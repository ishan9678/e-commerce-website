<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Page Title</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/d7cff5fbbc.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../styles.css" />
    <style>
    /* Add your custom styles here */

    /* Adjust styles for mobile */
    @media (max-width: 767px) {
        .cart-item {
            margin-bottom: 20px;
        }

        .checkout {
            margin-top: 20px;
        }

        .cart-summary {
            text-align: center;
        }
    }
    </style>
</head>

<body>

    <?php include '../components/navbar.php';

    include '../admin/connect.php';

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    if ($user_id === '') {
        header('location: ../login/login.php');
    }

    $cartItems = [];
    $totalPrice = 0;

    if ($user_id) {
        $query = "SELECT c.id, c.pid, p.name, p.price, p.image 
                              FROM cart c
                              INNER JOIN products p ON c.pid = p.id
                              WHERE c.user_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->execute([$user_id]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'];
        }
    }
    ?>

    <div class="container">
        <div class="cart-container">
            <div class="cart">
                <div class="cart-items">
                    <?php foreach ($cartItems as $item) : ?>
                    <div class="cart-item">
                        <img src="../admin/images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"
                            class="img-fluid">
                        <div class="cart-item-info">
                            <p class="cart-item-name"><?php echo $item['name']; ?></p>
                            <p class="cart-item-price">Rs.<?php echo $item['price']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="checkout">
                <div class="cart-summary">
                    <p>Total:</p>
                    <p class="cart-total-price">Rs. <?php echo number_format($totalPrice, 2); ?></p>
                    <!-- Display total price -->
                </div>
                <button class="checkout-button btn btn-primary btn-block">Checkout</button>
            </div>
        </div>
    </div>

</body>

</html>