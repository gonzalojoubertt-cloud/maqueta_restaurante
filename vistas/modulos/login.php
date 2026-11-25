<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="text-center fw-bold mb-4">Iniciar Sesión</h3>

                    <form method="post">
                        <div class="mb-3">
                            <label for="ingUsuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="ingUsuario" name="ingUsuario" required>
                        </div>

                        <div class="mb-3">
                            <label for="ingPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="ingPassword" name="ingPassword" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 fw-bold">Ingresar</button>

                        <?php
                        $login = new ControladorUsuarios();
                        $login->ctrIngresoUsuario();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>