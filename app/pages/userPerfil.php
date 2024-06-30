<?php include '../shared/header.php'; ?>
<link rel="stylesheet" href="../public/css/userPerfil.css">

<div class="container mt-5">
<div class="flex justify-content-between align-items-center mb-3">
        <a href="previous_page.php" class="btn btn-primary">Atrás</a>
        </div>
    <div class="row">
        <!-- Sección de datos personales -->
        <div class="col-md-6">
            <div class="container-custom">
                <h4>Datos Personales</h4>
                <form action="update_profile.php" method="POST">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" value="UsuarioActual" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="usuario@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                </form>
            </div>
        </div>

        <!-- Sección de historial de pedidos -->
        <div class="col-md-6">
            <div class="container-custom">
                <h4>Historial de Pedidos</h4>
                <table class="table table_dark">
                    <thead>
                        <tr>
                            <th>ID de Pedido</th>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ejemplo de pedido -->
                        <tr>
                            <td>12345</td>
                            <td>2023-06-25</td>
                            <td>Producto 1</td>
                            <td>2</td>
                            <td>$200</td>
                            <td>Enviado</td>
                        </tr>
                        <tr>
                            <td>12346</td>
                            <td>2023-06-26</td>
                            <td>Producto 2</td>
                            <td>1</td>
                            <td>$100</td>
                            <td>Procesando</td>
                        </tr>
                        <!-- Aquí se agregarán más pedidos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../shared/footer.php'; ?>
