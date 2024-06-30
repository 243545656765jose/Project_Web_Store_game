<?php 
include '../shared/header.php'; 
$json_data = file_get_contents('../utils/product.json');
$productos = json_decode($json_data, true);
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'computadoras';
$productos_categoria = isset($productos[$categoria]) ? $productos[$categoria] : [];
?>
<link rel="stylesheet" href="../public/css/menu.css">
<nav class="navbar navbar-expand-lg navbar-custom mt-5 mx-auto" style="max-width: 1140px;">
    <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#filterNav" aria-controls="filterNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="filterNav">
        <form class="form-inline my-2 my-lg-0 mx-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search" id="search-input">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" id="search-button">Buscar</button>
        </form>
        <ul class="navbar-nav ml-auto">
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

<div class="container mt-4" style="max-width: 1140px;">
    <div class="row" id="product-container">
        <?php
        foreach ($productos_categoria as $producto) {
            echo '
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm card-custom">
                    <img src="' . $producto['img'] . '" class="card-img-top" alt="' . $producto['title'] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $producto['title'] . '</h5>
                        <p class="card-text">' . $producto['description'] . '</p>
                        <p class="card-text font-weight-bold text-primary">$' . $producto['precio'] . '</p>
                        <a href="#" class="btn btn-success btn-block">Añadir</a>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <tr data-product-id="1">
                            <td>Producto 1</td>
                            <td>
                                <input type="number" class="form-control form-control-sm text-center quantity" value="1" min="1">
                            </td>
                            <td>$100</td>
                            <td class="item-total">$100</td>
                            <td>
                                <button class="btn btn-danger btn-sm remove-item">Eliminar</button>
                            </td>
                        </tr>
                        <tr data-product-id="2">
                            <td>Producto 2</td>
                            <td>
                                <input type="number" class="form-control form-control-sm text-center quantity" value="2" min="1">
                            </td>
                            <td>$50</td>
                            <td class="item-total">$100</td>
                            <td>
                                <button class="btn btn-danger btn-sm remove-item">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <h5>Total: $<span id="cart-total">200</span></h5>
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