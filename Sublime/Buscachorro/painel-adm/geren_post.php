<?php
require_once 'navigation.php';
require_once 'header.php';
?>

<body>

    <div class="container">
        <h1 class="display-6 mb-4">Listar Animais</h1>
        <table id="listar-animais" class="table table-striped table-hover display" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Usuario</th>
                    <th>Raça</th>
                    <th>Cor</th>
                    <th>Ações</th> <!-- New column for actions -->
                </tr>
            </thead>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#listar-animais').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
                },
                "ajax": {
                    "url": "get_animais.php",
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "cd_animal" },
                    { "data": "nm_animal" },
                    { "data": "sexo_animal" },
                    { "data": "nm_nome" },
                    { "data": "nm_raca" },
                    { "data": "nm_cor" },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<button class="btn btn-danger" onclick="deleteAnimal(' + row.cd_animal + ')">Delete</button>' +
                                '<button class="btn btn-primary ml-2" onclick="editAnimal(' + row.cd_animal + ')">Edit</button>';
                        }
                    }
                ]
            });
        });

        function deleteAnimal(cd_animal) {
            // Implement your delete logic here
            console.log('Delete animal with ID ' + cd_animal);
        }

        function editAnimal(cd_animal) {
            // Implement your edit logic here
            console.log('Edit animal with ID ' + cd_animal);
        }
    </script>

</body>
