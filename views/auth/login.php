<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Mi App</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg border-0" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4 p-md-5">
            
            <div class="text-center mb-4">
                <i class="bi bi-person-circle text-success" style="font-size: 3.5rem;"></i>
                <h2 class="fw-bold mt-2">Iniciar Sesión</h2>
                <p class="text-muted">Ingresa tus credenciales para acceder</p>
            </div>

            <?php if(isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <?php foreach($_SESSION['errors'] as $error){ echo $error . "<br>"; } ?>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success d-flex align-items-center small" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="index.php?action=loginUser" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="nombre@ejemplo.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-muted">¿No tienes cuenta?</span>
                    <a href="../views/index.php?action=getFormRegisterUser" class="text-decoration-none fw-bold ms-1">
                        Regístrate
                    </a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>