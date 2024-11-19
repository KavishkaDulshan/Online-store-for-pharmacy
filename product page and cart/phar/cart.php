<?php
session_start();
include 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

// Get user ID (assuming user is logged in and user ID is stored in session)
$user_id = $_SESSION['user_id'];

// Fetch cart items
$sql = "SELECT cart.*, products.name, products.price, products.image FROM cart 
        JOIN products ON cart.item_id = products.id 
        WHERE cart.user_id = '$user_id'";
$result = $conn->query($sql);

$total_amount = 0;
$cart_items = [];
while($row = $result->fetch_assoc()) {
    $total_amount += $row['price'] * $row['quantity'];
    $cart_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Health-Bridge</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ionicons CDN for icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="style.css"> <!-- Link to the new CSS file -->
    <style>

        .nunito {
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
        }

        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            background-color: #121212;
            color: #ffffff;
        }

        /* Navbar Styling */
        .navbar {
            padding: 15px 20px;
        }
        
        .navbar .nav-link {
            color: #ffffff;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        
        .navbar .nav-link:hover {
            color: #0dcaf0; /* Bootstrap's primary color */
            transform: scale(1.1);
        }
        
        /* Ionicon Styling */
        ion-icon {
            font-size: 28px;
            color: #ffffff;
            transition: transform 0.3s ease, color 0.3s ease;
        }
        
        ion-icon:hover {
            color: #0dcaf0;
            transform: rotate(10deg);
        }
        /* Search Bar */
        .search .form-control {
            background-color: #222;
            color: #ffffff;
            border: 1px solid #444;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        
        .search .form-control:hover,
        .search .form-control:focus {
            background-color: #333;
            transform: scale(1.02);
        }

        .search .btn-outline-light {
            color: #ffffff;
            border-color: #0dcaf0;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .search .btn-outline-light:hover {
            background-color: #0dcaf0;
            color: #000000;
            transform: scale(1.05);
        }

        /* Content Section */
        .content h1 {
            font-size: 50px;
            text-align: center;
            margin-top: 15%;
            letter-spacing: 2px;
            color: #ffffff;
        }

        .content h1 span {
            color: #0dcaf0;
            font-size: 60px;
        }

        .content .form {
            width: 300px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 50%, rgba(0, 0, 0, 0.8) 50%);
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);
        }



        .navbar .nav-link {
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .navbar .nav-link.active {
            color: #ffcc00; /* Active link color */
        }

        .navbar .nav-link:hover {
            color: #0dcaf0;
        }

        .btn:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .form-control {
            background-color: #222;
            color: #fff;
            border: 1px solid #444;
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .btn-primary {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }

        .btn-primary:hover {
            background-color: #0bbbe3;
            border-color: #0bbbe3;
        }

        .content-section {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .welcome-banner {
            max-width: 45%;
            text-align: left;
            margin: auto;
            animation: fadeIn 1.5s ease-in-out;
        }

        .login-form {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            max-width: 350px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .login-form:hover {
            transform: translateY(-5px);
        }

        .login-form h2 {
            color: #0dcaf0;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .icons a {
            color: #0dcaf0;
            margin: 0 10px;
            font-size: 1.5em;
            transition: color 0.3s ease;
        }

        .icons a:hover {
            color: #0bbbe3;
        }

        @media (max-width: 768px) {
            .content-section {
                flex-direction: column;
                text-align: center;
            }

            .welcome-banner, .login-form {
                max-width: 100%;
            }

            .welcome-banner h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body class="nunito">
    <!-- Main Container -->
    <div class="main"  style="background-image: url('bg.jpg');">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand logo" href="home.html">Health-Bridge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="/navi/home2.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/navi/About/AboutN.html">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="/navi/branch/branch.html">Branches</a></li>
                        <li class="nav-item"><a class="nav-link" href="/navi/Blog/Blog.html">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="/navi/FAQ/FAQ.html">FAQ</a></li>
                        <li class="nav-item"><a class="nav-link cart-icon" href="/navi/phar/cart.php"><ion-icon name="cart"></ion-icon></a></li>
                    </ul>
                    <form class="d-flex ms-3">
                        <input class="form-control me-2" type="search" placeholder="Type to search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div>
        <div class="container mt-5 ">
            <h1 class="my-4 text-center">Shopping Cart</h1>
            
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered tb">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price per Item</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart_items as $row): ?>
                                <tr id="cart-item-<?php echo htmlspecialchars($row['item_id']); ?>">
                                    <td><img src="<?php echo htmlspecialchars('/navi/admin/' . $row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-thumbnail" style="width: 120px; height: 80px;"></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                    <td>$<?php echo htmlspecialchars($row['price']); ?></td>
                                    <td>$<?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                                    <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(<?php echo htmlspecialchars($row['item_id']); ?>)">Remove</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total Amount</th>
                                <th colspan="2">$<?php echo number_format($total_amount, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="checkout.php" class="btn btn-primary">Checkout</a>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            function removeFromCart(productId) {
                $.ajax({
                    url: 'remove_from_cart.php',
                    type: 'POST',
                    data: { product_id: productId },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            $('#cart-item-' + productId).remove();
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function() {
                        alert('Failed to remove item from cart.');
                    }
                });
            }
        </script>
    </div>
</body>
</html>

<?php
$conn->close();
?>