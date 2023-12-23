<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/d7cff5fbbc.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../styles.css" />
</head>

<body>

    <?php include '../components/navbar.php';
    ?>

    <?php include '../components/product-details.php' ?>

    <?php
    $productId = $_GET['id'];
    generateProduct($productId);
    ?>




</body>

</html>