<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/d7cff5fbbc.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="admin_styles.css" />
</head>

<body>

    <div class="heading">
        <h1 text-center mt-4>Admin Dashboard</h1>
    </div>

    <div class="row cards">
        <div class="col-sm-6 mb-3 mb-sm-0 card1">
            <div class="card" style="width: 22rem;">
                <img src="/admin/images/undraw_online_shopping_re_k1sv.svg" class="card-img-top card-img" alt="...">
                <div class="card-body">
                    <a href="add_products.php" class="btn btn-dark" style="margin-left: 80px;padding-top: 12px;margin-top: 40px;">Add products</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6  mb-3 mb-sm-0 card2">
            <div class="card" style="width: 22rem;">
                <img src="/admin/images/undraw_confirmation_re_b6q5.svg" class="card-img-top card-img" style="margin-top: 55px;" alt="...">
                <div class="card-body">
                    <a href="approve_users.php" class="btn  btn-dark" style="margin-left: 80px;padding-top: 12px;margin-top: 40px;">Approve
                        Users</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>