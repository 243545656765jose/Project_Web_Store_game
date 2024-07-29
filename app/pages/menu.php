<?php
include '../shared/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
$user_id = $_SESSION['id'];
$products = load_products($user_id);

$json_data = file_get_contents('../utils/product.json');
$productos = json_decode($json_data, true);

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'computadoras';
$productos_categoria = isset($productos[$categoria]) ? $productos[$categoria] : [];
?>
<link rel="stylesheet" href="../public/css/menu.css">
<nav class="navbar navbar-expand-lg navbar-custom mt-5 mx-auto" style="max-width: 1140px;">
    <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#filterNav"
        aria-controls="filterNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="filterNav">
        <form class="form-inline my-2 my-lg-0 mx-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search" id="search-input">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" id="search-button">Buscar</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link filter-link" href="?categoria=computadoras">Computadoras</a></li>
            <li class="nav-item"><a class="nav-link filter-link" href="?categoria=accesorios">Accesorios</a></li>
            <li class="nav-item"><a class="nav-link filter-link" href="?categoria=sillas">Sillas</a></li>
            <li class="nav-item"><a class="nav-link filter-link" href="?categoria=mesas">Mesas</a></li>
            <li class="nav-item"><a class="nav-link filter-link" href="?categoria=teclados">Teclados</a></li>
            <li class="nav-item"><a class="nav-link filter-link" href="?categoria=combos">Combos</a></li>
        </ul>
    </div>
</nav>
<div class="container mt-4" style="max-width: 1140px;">
    <div class="row" id="product-container">
        <?php foreach ($productos_categoria as $producto): ?>
            <div class="col-md-3 mb-4 product-item">
                <div class="card h-100 shadow-sm card-custom">
                    <img src="<?= $producto['img'] ?>" class="card-img-top" alt="<?= $producto['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $producto['title'] ?></h5>
                        <p class="card-text"><?= $producto['description'] ?></p>
                        <p class="card-text font-weight-bold text-primary">$<?= $producto['precio'] ?></p>
                        <form action="/app/actions/buy/add.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="title" value="<?= $producto['title'] ?>">
                            <input type="hidden" name="description" value="<?= $producto['description'] ?>">
                            <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                            <input type="hidden" name="category" value="<?= $categoria ?>">
                            <button type="submit" class="btn btn-success btn-block">Añadir</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<button type="button" class="btn btn-warning btn-lg rounded-circle" id="cart-button" data-toggle="modal"
    data-target="#cartModal">
    <i class="fas fa-shopping-cart"></i>
</button>
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <form action="/app/pages/procesoCompras.php" method="POST" id="cart-form">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                                <?php if ($products): ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr data-product-id="<?= $product['id'] ?>">
                                            <td><?= $product['title'] ?></td>
                                            <td><input type="number" class="form-control form-control-sm text-center quantity"
                                                    value="1" min="1" onchange="updateCart(this)"></td>
                                            <td>$<?= $product['price'] ?></td>
                                            <td class="item-total" data-price="<?= $product['price'] ?>">
                                                $<?= $product['price'] ?></td>
                                            <td>
                                                <form action="/app/actions/buy/delete.php" method="POST">
                                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm remove-item">Eliminar</button>
                                                </form>
                                            </td>
                                            <input type="hidden" name="product_id[]" value="<?= $product['id'] ?>">
                                            <input type="hidden" name="title[]" value="<?= $product['title'] ?>">
                                            <input type="hidden" name="quantity[]" value="1" class="hidden-quantity">
                                            <input type="hidden" name="price[]" value="<?= $product['price'] ?>">
                                            <input type="hidden" name="total[]" value="<?= $product['price'] ?>"
                                                class="hidden-total">
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">-----------No hay productos-----------</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <h5>Total: $<span id="totalPrice">0.00</span></h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" onclick="prepareCartForm()">Proceder al Pago</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../shared/footer.php'; ?>
<script src="../public/js/car.js"></script>
<script src="../public/js/search.js"></script>