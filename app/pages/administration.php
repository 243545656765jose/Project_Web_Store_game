<?php include "../shared/header_admin.php"; ?>

<div class="container mt-5">
    <div class="row">
        <!-- Cuadro para Reportes -->
        <div class="col-md-6">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x mb-3"></i>
                    <h3 class="card-title">Reportes</h3>
                    <p class="card-text">Accede a los reportes de pedidos.</p>
                    <a href="../pages/report_administration.php" class="btn btn-primary">Ver Reportes</a>
                </div>
            </div>
        </div>
        <!-- Cuadro para Agregar Producto -->
        <div class="col-md-6">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-plus-circle fa-3x mb-3"></i>
                    <h3 class="card-title">Agregar Producto</h3>
                    <p class="card-text">Añade nuevos productos al inventario.</p>
                    <a href="../pages/add_product.php" class="btn btn-success">Agregar Producto</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>
