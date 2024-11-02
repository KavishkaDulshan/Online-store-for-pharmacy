<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add, edit, delete logic (same as before)
}

$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Panel</h2>

        <!-- Add Product Form -->
        <div class="card mb-4 p-4 shadow">
            <h4 class="card-title">Add New Product</h4>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Price:</label>
                        <input type="text" class="form-control" name="price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Quantity:</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image:</label>
                        <input type="file" class="form-control-file" name="image" required>
                    </div>
                </div>
                <button type="submit" name="add_product" class="btn btn-success btn-block">Add Product</button>
            </form>
        </div>

        <!-- Product List Table -->
        <h4 class="text-center mb-3">Product List</h4>
        <table class="table table-bordered shadow">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = $products->fetch_assoc()) { ?>
                <tr>
                    <form method="post" enctype="multipart/form-data">
                        <td><input type="text" class="form-control" name="name" value="<?= $product['name'] ?>"></td>
                        <td><input type="text" class="form-control" name="price" value="<?= $product['price'] ?>"></td>
                        <td><textarea class="form-control" name="description"><?= $product['description'] ?></textarea></td>
                        <td><input type="number" class="form-control" name="quantity" value="<?= $product['quantity'] ?>"></td>
                        <td>
                            <img src="<?= $product['image'] ?>" width="50" class="img-thumbnail">
                            <input type="file" class="form-control-file" name="image">
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit" name="edit_product" class="btn btn-warning btn-sm">Edit</button>
                            <button type="submit" name="delete_product" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
