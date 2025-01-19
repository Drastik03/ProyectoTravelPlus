<?php
require_once HEADER;
?>
<div class="d-flex justify-content-center align-items-center">
    <section class="container mt-4 p-4 shadow-lg rounded">
        <header class="mb-4 text-center">
            <h1>Listado de Usuarios</h1>
        </header>
        <!--BARRA DE BUSQUEDA-->
        <div class="row mb-4 justify-content-center">
            <div class="col-12 col-md-4 mb-2">
                <input type="text" class="form-control" id="busqueda" placeholder="Buscar usuario" aria-label="Buscar usuario">
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-center align-items-center mb-2">
                <button class="btn btn-primary w-100" id="btn_buscar" aria-label="Buscar usuario">Buscar</button>
            </div>
        </div>
        <table class="mx-auto table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Username</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['lastName']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="index.php?app=user&action=index&page=<?php echo ($page - 1); ?>">Anterior</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?app=user&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                <?php endfor; ?>

                <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="index.php?app=user&action=index&page=<?php echo ($page + 1); ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
    </section>

</div>
<?php
require_once FOOTER;
?>