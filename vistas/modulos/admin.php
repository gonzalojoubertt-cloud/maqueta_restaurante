<?php
if (!isset($_SESSION["iniciarSesion"]) || $_SESSION["iniciarSesion"] !== "ok") {
    echo '<script>window.location = "index.php?ruta=login";</script>';
    return;
}

$platosAdmin = ControladorComidas::ctrMostrarDatos(null, null);
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Panel de Administración — Sabores</h2>
            <small class="text-muted">Usuario: <?php echo htmlspecialchars($_SESSION["nombre"] ?? $_SESSION["usuario"] ?? "Admin"); ?></small>
        </div>
        <div class="d-flex gap-2">
            <a href="index.php" class="btn btn-outline-dark">Ver Frente</a>
            <a href="index.php?ruta=salir" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <?php
    $crear = new ControladorComidas();
    $crear->ctrCrearPlato();

    $editar = new ControladorComidas();
    $editar->ctrEditarPlato();

    $eliminar = new ControladorComidas();
    $eliminar->ctrEliminarPlato();
    ?>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-dark text-white fw-bold">Agregar nuevo plato</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="nuevoNombre" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio *</label>
                    <input type="text" name="nuevoPrecio" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Imagen (ej: pizza.jpg)</label>
                    <input type="text" name="nuevaImagen" class="form-control" placeholder="vistas/img/...">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="nuevaDescripcion" class="form-control">
                </div>
                <div class="col-6 col-md-2">
                    <label class="form-label">Peso</label>
                    <input type="text" name="nuevoPeso" class="form-control">
                </div>
                <div class="col-6 col-md-2">
                    <label class="form-label">Calorías</label>
                    <input type="text" name="nuevasCalorias" class="form-control">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">Grasas</label>
                    <input type="text" name="nuevasGrasas" class="form-control">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">Carbohidratos</label>
                    <input type="text" name="nuevosCarbohidratos" class="form-control">
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Proteínas</label>
                    <input type="text" name="nuevasProteinas" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success fw-bold">Guardar Plato</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">Platos cargados</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Peso</th>
                        <th>Calorías</th>
                        <th>Grasas</th>
                        <th>Carbos</th>
                        <th>Proteínas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($platosAdmin) && is_array($platosAdmin)) { ?>
                        <?php foreach ($platosAdmin as $p) { ?>
                            <tr>
                                <td><?php echo (int) $p["id"]; ?></td>
                                <td><?php echo htmlspecialchars($p["nombre"]); ?></td>
                                <td>$<?php echo number_format((float) $p["precio"], 0, ",", "."); ?></td>
                                <td><?php echo htmlspecialchars($p["peso"]); ?></td>
                                <td><?php echo htmlspecialchars($p["calorias"]); ?></td>
                                <td><?php echo htmlspecialchars($p["grasas"]); ?></td>
                                <td><?php echo htmlspecialchars($p["carbohidratos"]); ?></td>
                                <td><?php echo htmlspecialchars($p["proteinas"]); ?></td>
                                <td class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo (int) $p["id"]; ?>">
                                        Editar
                                    </button>
                                    <form method="post" onsubmit="return confirm('¿Eliminar este plato?');">
                                        <input type="hidden" name="eliminarId" value="<?php echo (int) $p["id"]; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditar<?php echo (int) $p["id"]; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Plato #<?php echo (int) $p["id"]; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body row g-3">
                                                <input type="hidden" name="editarId" value="<?php echo (int) $p["id"]; ?>">
                                                <div class="col-md-6">
                                                    <label class="form-label">Nombre *</label>
                                                    <input type="text" name="editarNombre" class="form-control" value="<?php echo htmlspecialchars($p["nombre"]); ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Precio *</label>
                                                    <input type="text" name="editarPrecio" class="form-control" value="<?php echo htmlspecialchars($p["precio"]); ?>" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Imagen</label>
                                                    <input type="text" name="editarImagen" class="form-control" value="<?php echo htmlspecialchars($p["imagen"]); ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Descripción</label>
                                                    <input type="text" name="editarDescripcion" class="form-control" value="<?php echo htmlspecialchars($p["descripcion"]); ?>">
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <label class="form-label">Peso</label>
                                                    <input type="text" name="editarPeso" class="form-control" value="<?php echo htmlspecialchars($p["peso"]); ?>">
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <label class="form-label">Calorías</label>
                                                    <input type="text" name="editarCalorias" class="form-control" value="<?php echo htmlspecialchars($p["calorias"]); ?>">
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <label class="form-label">Grasas</label>
                                                    <input type="text" name="editarGrasas" class="form-control" value="<?php echo htmlspecialchars($p["grasas"]); ?>">
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <label class="form-label">Carbos</label>
                                                    <input type="text" name="editarCarbohidratos" class="form-control" value="<?php echo htmlspecialchars($p["carbohidratos"]); ?>">
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <label class="form-label">Proteínas</label>
                                                    <input type="text" name="editarProteinas" class="form-control" value="<?php echo htmlspecialchars($p["proteinas"]); ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">No hay platos cargados todavía.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>