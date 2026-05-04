<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Mi App</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/proyecto_hotel/CSS/style.css"> 
</head>

<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    
    <a href="/proyecto_hotel/index.php?action=home" class="btn btn-outline-secondary btn-sm" style="position: fixed; top: 20px; left: 20px; z-index: 1000;">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </a>

    <div class="card shadow-lg border-0" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4 p-md-5">
            
            <div class="text-center mb-4">
                <i class="bi bi-person-circle text-success" style="font-size: 3.5rem;"></i>
                <h2 class="fw-bold mt-2">Iniciar Sesión</h2>
                <p class="text-muted">Ingresa tus credenciales</p>
            </div>

            <?php if(isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <?php foreach($_SESSION['errors'] as $error){ echo $error . "<br>"; } ?>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            <form action="/proyecto_hotel/index.php?action=loginUser" method="POST">

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

                <div class="text-center mt-3">
                    <span>¿No tienes cuenta?</span>
                    <a href="/proyecto_hotel/index.php?action=getFormRegisterUser">
                        Regístrate
                    </a>
                </div>

            </form>

        </div>
    </div>

</body>
</html>