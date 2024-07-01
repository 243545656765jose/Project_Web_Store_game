<?php include '../shared/header.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
session_start();
$user_id = $_SESSION['id'];
$products = load_products($user_id);
?>

<div class="container mt-5">
    <div class="container-custom">
        <div class="flex justify-content-between align-items-center mb-3">
        <a href="menu.php" class="btn btn-primary">Atrás</a>
            <h2 class="text-center">Proceso de Compra</h2>
        </div>

        <form action="payment_gateway.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <h4>Detalles del Pedido</h4>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <?php if ($products): ?>
                                <?php foreach ($products as $product): ?>
                                    <tr data-product-id="<?php echo $product['id']; ?>">
                                        <td><?php echo $product['title']; ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-center quantity"
                                                value="1" min="1">
                                        </td>
                                        <td>$<?php echo $product['price']; ?></td>
                                        <td class="item-total">$<?php echo $product['price']; ?></td>
                                        <td>
                                            <form action="/app/actions/buy/delete.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">-----------No hay productos-----------</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <h5>Total: $200</h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Detalles de Pago</h4>
                    <div class="form-group">
                        <label for="user_id">Identificación de Usuario</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Método de Pago</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="credit_card">Tarjeta de Crédito</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Número de Tarjeta</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Fecha de Expiración</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/AA" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Pagar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include '../shared/footer.php'; ?>
