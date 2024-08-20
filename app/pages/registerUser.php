<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register at AcuRey Gaming</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../public/css/login.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="position-absolute" style="top: 10px; left: 10px;">
            <a href="../index.php" class="btn btn-primary">Atrás</a>
        </div>
        <div class="login-container">
            <div class="login-left">
                <div class="text-center mb-4">
                    <img src="../public/img/logoP.webp" alt="AcuRey Gaming Logo" class="img-fluid">
                </div>
            </div>
            <div class="login-right">
                <h4 class="text-center">Register to the site</h4>
                <?php if (isset($_GET['errors'])): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (json_decode($_GET['errors'], true) as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="/app/actions/users/add.php" method="POST">
                    <div class="form-group">
                        <label for="reg_username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
                </form>
            </div>
        </div>
    </div>
    <?php include '../shared/footer.php'; ?>
</body>
</html>
