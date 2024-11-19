$(document).ready(function() {
    updateCartCount();

    function updateCartCount() {
        $.ajax({
            url: 'get_cart_count.php',
            type: 'GET',
            success: function(response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#cart-count').text(result.count);
                } else {
                    alert('Error fetching cart count: ' + result.message);
                }
            },
            error: function() {
                alert('Error fetching cart count.');
            }
        });
    }

    window.addToCart = function(productId, productName, productPrice) {
        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: { product_id: productId, quantity: 1 },
            success: function(response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    updateCartCount();
                } else {
                    alert('Error adding product to cart: ' + result.message);
                }
            },
            error: function() {
                alert('Error adding product to cart.');
            }
        });
    }
});