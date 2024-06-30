<?php 
include '../shared/header.php'; 
$json_data = file_get_contents('../utils/product.json');
$productos = json_decode($json_data, true);
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'computadoras';
$productos_categoria = isset($productos[$categoria]) ? $productos[$categoria] : [];
?>
<link rel="stylesheet" href="../public/css/menu.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light mt-4">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#filterNav"
        aria-controls="filterNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="filterNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link filter-link" href="?categoria=computadoras">Computadoras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-link" href="?categoria=accesorios">Accesorios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-link" href="?categoria=sillas">Sillas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-link" href="?categoria=mesas">Mesas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-link" href="?categoria=teclados">Teclados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-link" href="?categoria=combos">Combos</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <div class="row" id="product-container">
        <?php
        foreach ($productos_categoria as $producto) {
            echo '
            <div class="col-md-3 card-custom">
                <div class="card h-100">
                    <img src="' . $producto['img'] . '" class="card-img-top" alt="' . $producto['title'] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $producto['title'] . '</h5>
                        <p class="card-text">' . $producto['description'] . '</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>';
        }
        ?>
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
                <table class="table">
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
                            <td>
                                <input type="number" class="form-control form-control-sm text-center"
                                    style="width: 60px; display: inline;" value="1" min="1">
                            </td>
                            <td>$100</td>
                            <td>$100</td>
                        </tr>
                        <tr>
                            <td>Producto 2</td>
                            <td>
                                <input type="number" class="form-control form-control-sm text-center"
                                    style="width: 60px; display: inline;" value="2" min="1">
                            </td>
                            <td>$50</td>
                            <td>$100</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <h5>Total: $200</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Pagar</button>
            </div>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>