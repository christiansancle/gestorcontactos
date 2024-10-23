<?php


include_once 'c_contacts.php';
$controller = new contactController();
$contacts = $controller->getAllContacts();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
    <!-- Incluyendo Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Agenda de Contactos</h1>

        <!-- Mostrar lista de contactos -->
        <?php if (!empty($contacts)): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?php echo $contact['cnto_nombre']; ?></td>
                            <td><?php echo $contact['cnto_numerotelefono']; ?></td>
                            <td><?php echo $contact['cnto_email']; ?></td>
                            <td>
                                <!-- Botón de modificar -->
                                <a href="index.php?action=edit&id=<?php echo $contact['cnto_id']; ?>" class="btn btn-sm btn-warning">Modificar</a>
                                <!-- Botón de eliminar -->
                                <a href="index.php?action=delete&id=<?php echo $contact['cnto_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este contacto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning mt-4" role="alert">
                No hay contactos en la agenda.
            </div>
        <?php endif; ?>

        <!-- Formulario para agregar nuevos contactos -->
        <h2 class="mt-4">Agregar Nuevo Contacto</h2>
        <form method="POST" action="index.php?action=add" class="mt-3">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Contacto</button>
        </form>
    </div>

    <!-- Incluyendo JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


