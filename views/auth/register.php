<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Crear Cuenta</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg border-0 my-5" style="width: 100%; max-width: 650px;">
        <div class="card-body p-4 p-md-5">
            
            <div class="text-center mb-4">
                <i class="bi bi-person-circle text-success" style="font-size: 3.5rem;"></i>
                <h2 class="fw-bold mt-2">Crear Cuenta</h2>
                <p class="text-muted">Por favor, completa los datos de registro</p>
            </div>

            <?php if(isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php foreach($_SESSION['errors'] as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=registerUser" method="POST">
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tipo de Documento</label>
                        <select name="document_type_id" class="form-select">
                            <option value="" selected disabled>Seleccione...</option>
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                            <option value="PP">Pasaporte</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Número de Documento</label>
                        <input type="text" name="document_number" class="form-control" placeholder="Ej: 12345678">
                      
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Tu nombre">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Apellido</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Tu apellido">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Teléfono</label>
                        <input type="tel" name="phone" class="form-control" placeholder="300 000 0000">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="********">
                        <small id="error_password" class="text-danger"></small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Confirmar Contraseña</label>
                        <input type="password" name="confirmar_password" id="confirmar_password" class="form-control" placeholder="********">
                        <small id="error_confirm_password" class="text-danger"></small>
                    </div>

                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-muted">¿Ya tienes una cuenta?</span>
                    <a href="../views/index.php?action=getFormLoginUser" class="text-decoration-none fw-bold ms-1">
                        Iniciar Sesión
                    </a>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(e){

            let valid = true;

            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirmar_password").value;

            // LIMPIAR ERRORES
            document.getElementById("error_password").innerText = "";
            document.getElementById("error_confirm_password").innerText = "";

            // REGEX CONTRASEÑA
            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{6,}$/;

            // VALIDAR PASSWORD
            if(password === ""){
                document.getElementById("error_password").innerText = "La contraseña es obligatoria";
                valid = false;
            } else if(!regex.test(password)){
                document.getElementById("error_password").innerText =
                "Debe tener mayúscula, minúscula, número, símbolo y mínimo 6 caracteres";
                valid = false;
            }

            // VALIDAR CONFIRMAR PASSWORD
            if(confirmPassword === ""){
                document.getElementById("error_confirm_password").innerText = "Debes confirmar la contraseña";
                valid = false;
            } else if(password !== confirmPassword){
                document.getElementById("error_confirm_password").innerText = "Las contraseñas no coinciden";
                valid = false;
            }

            if(!valid){
                e.preventDefault();
            }

        });
</script>

</body>
</html>