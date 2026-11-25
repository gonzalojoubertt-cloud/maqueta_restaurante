<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabores - Restaurante</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="vistas/css/style.css">
</head>

<body style="padding-top: 65px;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold" href="#">Sabores</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white active-pill px-3 py-1 rounded-pill" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white nav-hover-line px-3 py-1" href="index.php#menu">Menú</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white nav-hover-line px-3 py-1" href="#" onclick="abrirNosotros(event)">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white nav-hover-line px-3 py-1" href="#contactoFooter" onclick="irAContacto(event)">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php
    if (isset($_GET["ruta"]) && $_GET["ruta"] === "salir") {
        session_unset();
        session_destroy();
        echo '<script>window.location = "index.php?ruta=login";</script>';
        return;
    }

    if (isset($_GET["ruta"]) && $_GET["ruta"] === "login") {
        include "vistas/modulos/login.php";
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></body></html>';
        return;
    }

    if (isset($_GET["ruta"]) && $_GET["ruta"] === "admin") {
        include "vistas/modulos/admin.php";
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></body></html>';
        return;
    }
    ?>

    <main class="container my-5">

        <section class="row align-items-center mb-5 p-4 bg-light rounded shadow-sm">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="h2 fw-bold mb-3" style="color: #000000;">NUESTRA ESPECIALIDAD</h1>
                <p class="h5 text-muted mb-2">Pizzas artesanales</p>
                <p class="text-secondary mb-4">Ingredientes frescos y de la mejor calidad directo a tu mesa.</p>
                <a href="#menu" class="btn rounded-pill fw-bold px-4 py-2 text-white" style="background-color: #000000;">Ver Menú</a>
            </div>
            <div class="col-lg-6">
                <img src="vistas/img/presentacion.png" alt="Especialidad de la casa" class="img-fluid rounded shadow">
            </div>
        </section>

        <section id="menu" class="container mt-4 mb-5">
            <?php
            $platos = ControladorComidas::ctrMostrarDatos(null, null);
            ?>
            <div class="row text-center">
                <?php if (!empty($platos) && is_array($platos)) { ?>
                    <?php foreach ($platos as $plato) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="dish-card position-relative overflow-hidden rounded-top">
                                    <img src="vistas/img/<?php echo htmlspecialchars($plato["imagen"]); ?>" alt="<?php echo htmlspecialchars($plato["nombre"]); ?>" class="img-fluid dish-img w-100">
                                    <div class="nutrition-bar">
                                        <div class="nutri-item"><span><?php echo htmlspecialchars($plato["peso"]); ?></span><small>PESO</small></div>
                                        <div class="nutri-item"><span><?php echo htmlspecialchars($plato["calorias"]); ?></span><small>CAL</small></div>
                                        <div class="nutri-item"><span><?php echo htmlspecialchars($plato["grasas"]); ?></span><small>G</small></div>
                                        <div class="nutri-item"><span><?php echo htmlspecialchars($plato["carbohidratos"]); ?></span><small>CH</small></div>
                                        <div class="nutri-item"><span><?php echo htmlspecialchars($plato["proteinas"]); ?></span><small>P</small></div>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h3 class="h5 card-title mt-2"><?php echo htmlspecialchars($plato["nombre"]); ?></h3>
                                    <p class="card-text fw-bold fs-5 text-success">$<?php echo number_format((float) $plato["precio"], 0, ",", "."); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

    </main>

    <footer id="contactoFooter" class="footer-amarillo text-dark text-center py-3 mt-auto" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="container">
            <p class="mb-0 small fw-bold">
                <i class="fa-solid fa-location-dot me-1"></i> Dirección: Av. Principal 123 &mdash;
                <i class="fa-solid fa-phone ms-2 me-1"></i> Tel: 0000-0000 &mdash;
                <i class="fa-solid fa-clock ms-2 me-1"></i> Horarios: 12:00 a 23:00
            </p>
        </div>
    </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                <div id="modalNosotros" onclick="cerrarNosotrosFondo(event)" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.6); z-index: 2000; align-items: center; justify-content: center; padding: 16px;">
                    <div style="background: #ffffff; color: #333333; max-width: 520px; width: 100%; border-radius: 10px; padding: 24px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
                    <h3 style="margin-top: 0; color: #007863;">Sobre Nosotros</h3>
                        <p style="line-height: 1.5; margin-bottom: 12px;">
                        En <strong>"Sabores"</strong> preparamos platos caseros y artesanales al momento (como pizzas, hamburguesas, ensaladas, y más) con ingredientes frescos y recetas cuidadas.
                        </p>
                        <p style="line-height: 1.5; margin-bottom: 20px;">
                        Buscamos ofrecer la mejor experiencia, con una buena atención clara y cercana, un menú variado y que cada plato sea una explosión de sabor.
                        </p>
                        <button type="button" onclick="cerrarNosotros()" style="background: #007863; color: #ffffff; border: none; padding: 8px 18px; border-radius: 6px; cursor: pointer; font-weight: 600;">
                        Cerrar
                        </button>
                    </div>
                </div>  

        <script>        
        function abrirNosotros(e) {
        if (e) e.preventDefault();
        document.getElementById("modalNosotros").style.display = "flex";
        }

        function cerrarNosotros() {
        document.getElementById("modalNosotros").style.display = "none";
        }

        function cerrarNosotrosFondo(e) {                             
        if (e.target.id === "modalNosotros") {
        cerrarNosotros();
        }
    }
</script>

        <script>
            function irAContacto(e) {
                if (e) e.preventDefault();
                const footer = document.getElementById("contactoFooter");
                if (!footer) return;

                footer.scrollIntoView({ behavior: "smooth", block: "end" });
                footer.style.transform = "translateY(-4px)";
                footer.style.boxShadow = "0 -4px 16px rgba(0, 0, 0, 0.2)";

                setTimeout(() => {
                footer.style.transform = "translateY(0)";
                footer.style.boxShadow = "none";
                }, 900);
            }
            </script>
    </body>

</html>