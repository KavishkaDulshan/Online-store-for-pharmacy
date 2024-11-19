let cart = [];

function addToCart(productId, productName, productPrice) {
    $.ajax({
        url: 'add_to_cart.php',
        type: 'POST',
        data: { product_id: productId, quantity: 1 },
        success: function(response) {
            let result = JSON.parse(response);
            if (result.status === 'success') {
                updateCart();
            } else {
                alert('Error adding product to cart: ' + result.message);
            }
        },
        error: function() {
            alert('Error adding product to cart.');
        }
    });
}

function removeFromCart(productId) {
    $.ajax({
        url: 'remove_from_cart.php',
        type: 'POST',
        data: { product_id: productId },
        success: function(response) {
            let result = JSON.parse(response);
            if (result.status === 'success') {
                updateCart();
            } else {
                alert('Error removing product from cart: ' + result.message);
            }
        },
        error: function() {
            alert('Error removing product from cart.');
        }
    });
}

function updateCart() {
    $.ajax({
        url: 'get_cart.php',
        type: 'GET',
        success: function(response) {
            let cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;
            let cart = JSON.parse(response);
            cart.forEach(item => {
                total += item.price * item.quantity;
                let li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `${item.name} - $${item.price} x ${item.quantity} <button class="btn btn-danger btn-sm" onclick="removeFromCart(${item.id})">Remove</button>`;
                cartItems.appendChild(li);
            });
            document.getElementById('cart-total').innerText = `Total: $${total.toFixed(2)}`;
        }
    });
}