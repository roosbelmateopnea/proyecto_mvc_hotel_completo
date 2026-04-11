<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Hotel Luxury</a>

        <div class="d-flex gap-2 align-items-center">
            <?php if(isset($_SESSION['data'])): ?>
                <h5>Hola, Bienvenido <?php echo $_SESSION['data']['name']; ?></h5>
            <?php else: ?>
                <h5>Hola, Bienvenido a Hotel Luxury</h5>
            <?php endif; ?>
            <a href="#servicios" class="btn btn-outline-light">Servicios</a>
            <a href="#habitaciones" class="btn btn-outline-light">Habitaciones</a>
            <a href="#contacto" class="btn btn-outline-light">Contacto</a>

            <?php if(isset($_SESSION['data'])): ?>
                <a href="index.php?action=closeSession" class="btn btn-danger">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<section class="hero d-flex align-items-center text-center text-white">
    <div id="carouselHero" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active"><img src="imagenes/imagen8.png" class="d-block w-100"></div>
            <div class="carousel-item"><img src="imagenes/imagen9.png" class="d-block w-100"></div>
            <div class="carousel-item"><img src="imagenes/imagen10.png" class="d-block w-100"></div>
            <div class="carousel-item"><img src="imagenes/imagen11.png" class="d-block w-100"></div>
            <div class="carousel-item"><img src="imagenes/imagen12.png" class="d-block w-100"></div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container hero-content">
        <h1 class="display-4 fw-bold">Bienvenido a Hotel Luxury</h1>
        <p class="lead">Vive una experiencia única de confort y elegancia</p>
        <?php if(!isset($_SESSION['data'])): ?>
        <a href="index.php?action=getFormLoginUser" class="btn btn-primary btn-lg mt-3">Ingresar</a>
        <a href="index.php?action=getFormRegisterUser" class="btn btn-outline-light btn-lg mt-3">Registrarse</a>
        <?php endif; ?>
    </div>
</section>


<section id="servicios" class="container py-5 text-center">
    <h2 class="mb-5 text-white fw-bold">Nuestros Servicios</h2>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <div class="mb-3">
                    <i class="bi bi-gem" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="fw-bold">Habitaciones Premium</h4>
                <p class="opacity-75">Habitaciones de lujo con vista panorámica y confort total.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <div class="mb-3">
                    <i class="bi bi-water" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="fw-bold">Spa & Relax</h4>
                <p class="opacity-75">Servicios de bienestar para tu descanso.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <div class="mb-3">
                    <i class="bi bi-cup-hot" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="fw-bold">Restaurante Gourmet</h4>
                <p class="opacity-75">Lo mejor de la cocina internacional con chefs de alto nivel.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <div class="mb-3">
                    <i class="bi bi-wifi" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="fw-bold">Wi-Fi Gratuito</h4>
                <p class="opacity-75">Conexión de alta velocidad en todas las áreas.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <div class="mb-3">
                    <i class="bi bi-stars" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="fw-bold">Experiencia Única</h4>
                <p class="opacity-75">Atención personalizada y detalles de lujo.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <div class="mb-3">
                    <i class="bi bi-p-circle" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="fw-bold">Parqueadero Privado</h4>
                <p class="opacity-75">Estacionamiento seguro y vigilado las 24 horas.</p>
            </div>
        </div>
    </div>
</section>

<section id="habitaciones" class="container py-5 text-center">
    <h2 class="mb-5">Nuestras Habitaciones</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="imagenes/imagen5.png" class="img-fluid rounded mb-3">
                <h4>Suite Deluxe</h4>
                <p>$300.000 / noche</p>
                <a href="#" class="btn btn-primary">Reservar</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="imagenes/imagen6.png" class="img-fluid rounded mb-3">
                <h4>Habitación Doble</h4>
                <p>$200.000 / noche</p>
                <a href="#" class="btn btn-primary">Reservar</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 h-100">
                <img src="imagenes/imagen7.png" class="img-fluid rounded mb-3">
                <h4>Habitación Individual</h4>
                <p>$120.000 / noche</p>
                <a href="#" class="btn btn-primary">Reservar</a>
            </div>
        </div>
    </div>
</section>

<section class="gallery text-center py-5">
    <h2 class="mb-5">Galería</h2>
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4"><img src="imagenes/imagen2.png" class="img-fluid rounded"></div>
            <div class="col-md-4"><img src="imagenes/imagen3.png" class="img-fluid rounded"></div>
            <div class="col-md-4"><img src="imagenes/imagen4.png" class="img-fluid rounded"></div>
        </div>
    </div>
</section>


<section class="container py-5 text-center">
    <h2 class="mb-5">Opiniones de Clientes</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <p>"Increíble servicio, todo muy elegante."</p>
                <h6>- Juan Pérez</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <p>"Las habitaciones son espectaculares."</p>
                <h6>- María López</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <p>"Volvería sin dudarlo."</p>
                <h6>- Carlos Gómez</h6>
            </div>
        </div>
    </div>
</section>


<section id="contacto" class="container py-5 text-center">
    <h2 class="mb-5 text-white fw-bold">¿Necesitas Ayuda?</h2>
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <i class="bi bi-geo-alt mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Ubicación</h5>
                <p>Ibagué, Tolima - Colombia</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <i class="bi bi-telephone mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Teléfono</h5>
                <p>+57 317 374 9727</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 h-100 border text-white" 
                 style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                <i class="bi bi-envelope mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Correo</h5>
                <p>hotel@luxury.com</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3">
        <a href="#" class="btn btn-primary btn-lg px-4">
            <i class="bi bi-headset me-2"></i>Contactar Soporte
        </a>
        <a href="#" class="btn btn-outline-light btn-lg px-4">
            <i class="bi bi-file-earmark-bar-graph me-2"></i>Generar Reporte
        </a>
    </div>
</section>


<footer class="bg-dark text-white text-center p-3">
    <p>© 2026 Hotel Luxury - Todos los derechos reservados</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>