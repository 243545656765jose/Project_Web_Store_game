<?php include '../shared/header.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
session_start();
if (!isset($_SESSION['id'])) {
    echo "Error: Usuario no autenticado.";
    exit;
}
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$products = load_products($user_id);
?>

<link rel="stylesheet" href="../public/css/userPerfil.css">

<div class="container mt-5">
    <div class="flex justify-content-between align-items-center mb-3">
        <a href="menu.php" class="btn btn-primary">Atrás</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="container-custom">
                <h4>Datos Personales</h4>
                <form action="/app/actions/users/edit.php" method="POST">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="container-custom">
                <h4>Historial de Pedidos</h4>
                <table class="table table_dark">
                    <thead>
                        <tr>
                            <th>ID de Pedido</th>
                            <th>Producto</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <?php if ($products): ?>
                            <?php foreach ($products as $product): ?>
                                <tr data-product-id="<?php echo $product['id']; ?>">
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo $product['title']; ?></td>
                                    <td class="item-total">$<?php echo $product['price']; ?></td>
                                    <td class="item-date"><?php echo $product['created_at']; ?></td>
                                    <td>
                                        <form action="" method="POST" style="display:inline;">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">PDF</button>
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
            </div>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>
