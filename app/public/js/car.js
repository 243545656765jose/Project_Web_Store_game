document.addEventListener('DOMContentLoaded', function () {
    updateCartTotal();
    addRemoveItemListeners();
});

function updateCart(element) {
    var quantity = parseInt(element.value);
    var row = element.closest('tr');
    var price = parseFloat(row.querySelector('.item-total').dataset.price);
    var itemTotal = row.querySelector('.item-total');

    var newTotal = quantity * price;
    itemTotal.textContent = '$' + newTotal.toFixed(2);

    updateCartTotal();
}

function updateCartTotal() {
    var cartItems = document.querySelectorAll('#cart-items tr');
    var total = 0;

    cartItems.forEach(function (item) {
        var itemTotal = parseFloat(item.querySelector('.item-total').textContent.replace('$', ''));
        total += itemTotal;
    });

    document.getElementById('totalPrice').textContent = total.toFixed(2);
}

function addRemoveItemListeners() {
    document.querySelectorAll('.remove-item').forEach(function (button) {
        button.addEventListener('click', function () {
            var productId = this.getAttribute('data-product-id');
            removeItemFromCart(productId);
        });
    });
}

function removeItemFromCart(productId) {
    var row = document.querySelector('tr[data-product-id="' + productId + '"]');
    if (row) {
        row.remove();
        updateCartTotal();
        // EnviarAJAX 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/app/actions/buy/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log('Producto eliminado de la base de datos');
            }
        };
        xhr.send('product_id=' + productId);
    }
}

function prepareCartForm() {
    document.querySelectorAll('.quantity').forEach(function (input) {
        var row = input.closest('tr');
        row.querySelector('.hidden-quantity').value = input.value;
    });

    document.querySelectorAll('.item-total').forEach(function (total) {
        var row = total.closest('tr');
        row.querySelector('.hidden-total').value = parseFloat(total.textContent.replace('$', '')).toFixed(2);
    });
}
