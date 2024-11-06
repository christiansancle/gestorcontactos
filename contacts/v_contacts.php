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
        /* Fondo más oscuro y transición de color */
        body {
            background-color: #101010;
            color: #ffffff;
            font-family: Arial, sans-serif;
            transition: background-color 0.4s ease-in-out;
        }

        /* Títulos con efecto de destello y animación de brillo */
        h1,
        h2 {
            color: #00e5ff;
            text-align: center;
            text-shadow: 0px 0px 10px rgba(0, 229, 255, 0.6);
            position: relative;
            overflow: hidden;
        }

        h1:before,
        h2:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(0, 229, 255, 0.4), transparent);
            animation: shine 2.5s infinite;
        }

        @keyframes shine {
            to {
                left: 100%;
            }
        }

        .table,
        form {
            border: 2px solid #00e5ff;
            box-shadow: 0px 0px 12px rgba(0, 229, 255, 0.3);
            border-radius: 12px;
            padding: 12px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .table:hover,
        form:hover {
            transform: scale(1.02);
            box-shadow: 0px 0px 15px rgba(0, 229, 255, 0.6);
        }

        .table-bordered {
            background-color: #f9f9f9;
            color: #000;
            border-radius: 8px;
        }

        .table th {
            background-color: #00e5ff;
            color: #fff;
            text-align: center;
        }

        .table td {
            background-color: #fdfdfd;
            color: #333;
        }

        .table tr:hover td {
            background-color: #ccf2f4;
        }

        .btn-warning,
        .btn-danger,
        .btn-primary {
            border-radius: 6px;
            padding: 6px 12px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            box-shadow: 0px 0px 10px rgba(255, 165, 0, 0.4);
        }

        .btn-warning:hover {
            background-color: #ffcc80;
            box-shadow: 0px 0px 12px rgba(255, 165, 0, 0.7);
        }

        .btn-danger {
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.4);
        }

        .btn-danger:hover {
            background-color: #ff3333;
            color: #fff;
            box-shadow: 0px 0px 12px rgba(255, 0, 0, 0.7);
            transform: scale(1.05);
        }

        .btn-primary:hover {
            background-color: #00b8d4;
            box-shadow: 0px 0px 12px rgba(0, 229, 255, 0.7);
            transform: scale(1.05);
        }

        .form-control {
            background-color: #282828;
            color: #ffffff;
            border: 1px solid #00e5ff;
            border-radius: 8px;
            padding: 10px;
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #00b8d4;
            box-shadow: 0px 0px 8px rgba(0, 229, 255, 0.6);
        }

        .modal-content {
            background-color: #141414;
            border: 2px solid #00e5ff;
            box-shadow: 0px 0px 15px rgba(0, 229, 255, 0.6);
            border-radius: 12px;
            color: #ffffff;
        }

        .modal-header,
        .modal-footer {
            border-bottom: 1px solid #00e5ff;
            background-color: #101010;
        }

        .modal-title {
            color: #00e5ff;
            font-weight: bold;
        }

        .modal-body .form-control {
            background-color: #222;
            color: #ffffff;
            border: 1px solid #00e5ff;
        }

        .btn-close {
            background-color: #00e5ff;
            border-radius: 50%;
            opacity: 0.9;
        }

        .btn-close:hover {
            background-color: #00b8d4;
            opacity: 1;
        }

        /* Estilo del checkbox oculto */
        .notify-checkbox {
            display: none;
        }

        /* Estilos de la notificación */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateY(-20px);
            pointer-events: none;
            transition: opacity 0.5s, transform 0.5s;
        }

        .notify-checkbox:checked+.notification {
            opacity: 1;
            transform: translateY(0);
            animation: fadeInOut 3s ease forwards;
        }

        @keyframes fadeInOut {

            0%,
            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Agenda de Contactos</h1>

        <!-- Checkbox oculto para la notificación de guardado -->
        <input type="checkbox" id="notify" class="notify-checkbox" />
        <label for="notify" class="notification">¡Contacto guardado con éxito!</label>

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
            <button type="submit" class="btn btn-primary"
                onclick="setTimeout(() => { document.getElementById('notify').checked = true; }, 500);">
                Agregar Contacto
            </button>
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
    </div>
</body>

</html>