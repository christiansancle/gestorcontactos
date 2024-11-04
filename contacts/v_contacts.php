<?php
include_once 'c_contacts.php';
$controller = new ContactController();
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
                            <td><?php echo htmlspecialchars($contact['cnto_nombre']); ?></td>
                            <td><?php echo htmlspecialchars($contact['cnto_numerotelefono']); ?></td>
                            <td><?php echo htmlspecialchars($contact['cnto_email']); ?></td>
                            <td>
                                <!-- Botón de modificar -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-id="<?php echo $contact['cnto_id']; ?>" 
                                    data-nombre="<?php echo htmlspecialchars($contact['cnto_nombre']); ?>" 
                                    data-telefono="<?php echo htmlspecialchars($contact['cnto_numerotelefono']); ?>" 
                                    data-email="<?php echo htmlspecialchars($contact['cnto_email']); ?>">
                                    Modificar
                                </button>
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
        <form method="POST" action="index.php?modo=createContact" class="mt-3">
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

        <!-- Modal para editar contacto -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modificar Contacto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="index.php?modo=updateContact">
                            <input type="hidden" id="editId" name="id">
                            <div class="mb-3">
                                <label for="editNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="editNombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTelefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="editTelefono" name="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Contacto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluyendo JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para llenar el modal con los datos del contacto
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget; // Botón que abrió el modal
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            const telefono = button.getAttribute('data-telefono');
            const email = button.getAttribute('data-email');

            // Actualiza el contenido del modal
            const editId = editModal.querySelector('#editId');
            const editNombre = editModal.querySelector('#editNombre');
            const editTelefono = editModal.querySelector('#editTelefono');
            const editEmail = editModal.querySelector('#editEmail');

            editId.value = id;
            editNombre.value = nombre;
            editTelefono.value = telefono;
            editEmail.value = email;
        });
    </script>
</body>
</html>
