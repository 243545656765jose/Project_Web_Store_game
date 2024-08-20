<?php include "../shared/header_admin.php"; ?>


<div class="container mt-5">
    <div class="mb-4">
        <a href="../pages/administration.php" class="btn btn-danger">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>
    </div>
    <h2 class="text-center mb-4">Agregar Producto</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle"></i> Producto agregado con éxito
        </div>
    <?php endif; ?>

    <form method="POST" action="../actions/product/add.php" enctype="multipart/form-data" class="p-4 bg-light shadow-sm rounded">
        <div class="form-group mb-3">
            <label for="categoria" class="form-label"><i class="fas fa-list-alt"></i> Categoría:</label>
            <select class="form-control" id="categoria" name="categoria" required>
                <option value="computadoras">Computadoras</option>
                <option value="accesorios">Accesorios</option>
                <option value="sillas">Sillas</option>
                <option value="mesas">Mesas</option>
                <option value="teclados">Teclados</option>
                <option value="combos">Combos</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="title" class="form-label"><i class="fas fa-heading"></i> Título del Producto:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Escribe el título del producto" required>
        </div>
        <div class="form-group mb-3">
            <label for="description" class="form-label"><i class="fas fa-align-left"></i> Descripción:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Describe el producto brevemente" required>
        </div>
        <div class="form-group mb-3">
            <label for="precio" class="form-label"><i class="fas fa-dollar-sign"></i> Precio:</label>
            <input type="number" class="form-control" id="precio" name="precio" placeholder="Indica el precio del producto" required>
        </div>
        <div class="form-group mb-4">
            <label for="img" class="form-label"><i class="fas fa-image"></i> Imagen del Producto:</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-plus-circle"></i> Agregar Producto
        </button>
    </form>
</div>

<?php include '../shared/footer.php'; ?>