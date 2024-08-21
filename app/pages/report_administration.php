<?php include "../shared/header_admin.php"; 
include '../utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php'; ?>

<div class="container mt-5">
<div class="mb-4">
        <a href="../pages/administration.php" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>
    </div>
    <h2 class="text-center mb-4"><i class="fas fa-clipboard-list"></i> Reporte de Órdenes</h2>

    <div class="mb-4">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Buscar por número de orden, fecha o usuario">
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped" id="reportTable">
            <thead class="thead-dark">
                <tr>
                    <th><i class="fas fa-user"></i> Nombre de Usuario</th>
                    <th><i class="fas fa-hashtag"></i> Número de Orden</th>
                    <th><i class="fas fa-calendar-alt"></i> Fecha de Orden</th>
                    <th><i class="fas fa-dollar-sign"></i> Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $orders = get_all_orders();
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        echo "<tr>";
                        echo "<td><i class='fas fa-user'></i> {$order['user_name']}</td>";
                        echo "<td><i class='fas fa-hashtag'></i> {$order['order_number']}</td>";
                        echo "<td><i class='fas fa-calendar-alt'></i> {$order['order_date']}</td>";
                        echo "<td><i class='fas fa-dollar-sign'></i> \${$order['total']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No se encontraron órdenes.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="text-center mt-5">
    <p>&copy; 2024 <i class="fas fa-store"></i> Web Store Game. Todos los derechos reservados.</p>
</footer>


<script src="../public/js/search_admin_order.js"></script>
<?php include '../shared/footer.php'; ?>
