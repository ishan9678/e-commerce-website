<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Set the user's is_approved status to true
    $query = "UPDATE users SET is_approved = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$userId]);

    // Redirect back to the same page after approving the user
    header('location: approve_users.php');
    exit();
}

// Query the database to fetch unapproved users
$query = "SELECT id, fname, lname, email, number FROM users WHERE is_approved = 0";
$stmt = $conn->prepare($query);
$stmt->execute();
$unapprovedUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Approve</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/d7cff5fbbc.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="admin_styles.css" />
</head>

<body>

    <div class="heading">
        <h1 class="text-center mt-4">Approve Users</h1>

    </div>

    <div class="container mt-4 ">
        <table class="table  table-striped ">
            <caption>List of unapproved users</caption>
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unapprovedUsers as $user) : ?>
                    <tr>
                        <td><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['number']; ?></td>
                        <td>
                            <a href="approve_users.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success">Approve</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>