<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RunwayReverie</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/d7cff5fbbc.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>

    <?php include 'components/navbar.php' ?>
    <?php include 'components/header.php' ?>
    <?php include 'components/row-category.php' ?>



    <?php $category = 'Ladies';
  echo generateProductCarousel($category, 1);
  ?>
    <?php $category = 'Men';
  echo generateProductCarousel($category, 2);
  ?>
    <?php $category = 'Teens';
  echo generateProductCarousel($category, 3);
  ?>
    <?php $category = 'Kids';
  echo generateProductCarousel($category, 4);
  ?>
    <?php $category = 'Baby';
  echo generateProductCarousel($category, 5);
  ?>
    <?php $category = 'Sport';
  echo generateProductCarousel($category, 6);
  ?>
    <?php $category = 'Sale';
  echo generateProductCarousel($category, 7);
  ?>


    <!-- routing -->

    <?php
  $uri = $_SERVER['REQUEST_URI'];

  if ($uri === 'pages/product') {
    $productId = $_GET['id'];
  } else {
    // Handle 404 Not Found
    http_response_code(404);
  }
  ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>