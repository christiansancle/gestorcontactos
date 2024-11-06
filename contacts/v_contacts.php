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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* Estilos generales futuristas tipo Tron */
        body {
            background-color: #121212;
            /* Fondo ligeramente más oscuro */
            color: #ffffff;
            font-family: Arial, sans-serif;
            transition: background-color 0.3s ease;
            /* Transición suave al cargar */
        }

        h1,
        h2 {
            color: #00bcd4;
            text-align: center;
            /* Centrando el título */
            text-shadow: 0px 0px 8px rgba(0, 188, 212, 0.6);
            /* Sutil sombra brillante */
        }

        /* Estilo de borde futurista para la tabla y formulario */
        .table,
        form {
            border: 2px solid #00bcd4;
            box-shadow: 0px 0px 15px rgba(0, 188, 212, 0.4);
            /* Sombra más suave */
            border-radius: 12px;
            /* Bordes ligeramente más redondeados */
            padding: 10px;
            transition: transform 0.3s ease;
            /* Suave efecto hover */
        }

        .table:hover,
        form:hover {
            transform: scale(1.02);
            /* Ligeramente más grande al pasar el cursor */
        }

        /* Estilos de la tabla */
        .table-bordered {
            background-color: #ffffff;
            color: #000000;
            border-radius: 8px;
        }

        .table th {
            background-color: #00bcd4;
            color: #ffffff;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .table td {
            background-color: #ffffff;
            color: #000000;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .table tr:hover td {
            background-color: #e0f7fa;
        }

        /* Botones */
        .btn-warning {
            background-color: #ffa500;
            border: none;
            color: #000;
            box-shadow: 0px 0px 8px rgba(255, 165, 0, 0.4);
        }

        .btn-danger {
            background-color: #ff0000;
            border: none;
            color: #ffeb3b;
            box-shadow: 0px 0px 8px rgba(255, 0, 0, 0.4);
        }

        .btn-danger:hover,
        .btn-warning:hover {
            opacity: 0.85;
            box-shadow: 0px 0px 12px rgba(255, 0, 0, 0.6);
        }

        /* Estilos del formulario */
        .form-control {
            background-color: #333;
            color: #ffffff;
            border: 1px solid #00bcd4;
            border-radius: 5px;
            padding: 8px;
            transition: background-color 0.3s ease;
        }

        .form-control:focus {
            background-color: #444;
        }

        /* Botón de formulario */
        .btn-primary {
            background-color: #00bcd4;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0097a7;
            transform: scale(1.05);
        }

        /* Estilos del modal */
        .modal-content {
            background-color: #1a1a1a;
            border: 2px solid #00bcd4;
            box-shadow: 0px 0px 20px rgba(0, 188, 212, 0.6);
            border-radius: 10px;
            color: #ffffff;
        }

        .modal-header,
        .modal-footer {
            border-bottom: 1px solid #00bcd4;
            background-color: #121212;
        }

        .modal-title {
            color: #00bcd4;
        }

        .modal-body .form-control {
            background-color: #333;
            color: #ffffff;
            border: 1px solid #00bcd4;
        }

        /* Botón de cierre del modal */
        .btn-close {
            background-color: #00bcd4;
            border-radius: 50%;
            opacity: 0.8;
        }

        .btn-close:hover {
            opacity: 1;
            background-color: #0097a7;
        }
    </style>



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
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="<?php echo $contact['cnto_id']; ?>"
                                    data-nombre="<?php echo htmlspecialchars($contact['cnto_nombre']); ?>"
                                    data-telefono="<?php echo htmlspecialchars($contact['cnto_numerotelefono']); ?>"
                                    data-email="<?php echo htmlspecialchars($contact['cnto_email']); ?>">
                                    Modificar
                                </button>
                                <form id="deleteForm-<?php echo $contact['cnto_id']; ?>" method="POST" action="index.php?modo=deleteContact" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $contact['cnto_id']; ?>">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('<?php echo $contact['cnto_id']; ?>')">Eliminar</button>
                                </form>
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
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            const telefono = button.getAttribute('data-telefono');
            const email = button.getAttribute('data-email');

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(contactId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás deshacer esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, envía el formulario correspondiente
                    document.getElementById(`deleteForm-${contactId}`).submit();
                }
            });
        }
    </script>
</body>

</html>