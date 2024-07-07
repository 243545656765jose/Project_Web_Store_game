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
            var row = this.closest('tr');
            row.remove();
            updateCartTotal();
        });
    });
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
