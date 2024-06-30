<?php include '../shared/header.php'; ?>

<div class="container mt-5">
    <div class="container-custom">
        <div class="flex justify-content-between align-items-center mb-3">
        <a href="previous_page.php" class="btn btn-primary">Atrás</a>
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
                        <tbody>
                            <tr>
                                <td>Producto 1</td>
                                <td>1</td>
                                <td>$100</td>
                                <td>$100</td>
                            </tr>
                            <tr>
                                <td>Producto 2</td>
                                <td>2</td>
                                <td>$50</td>
                                <td>$100</td>
                            </tr>
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
