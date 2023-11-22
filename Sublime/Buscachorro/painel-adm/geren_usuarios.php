<?php
require_once 'navigation.php';
require_once 'header.php';
?>
<body>
    
    <div class="container">
        <h1 class="display-6 mb-4">Listar Animais</h1>
        <table id="listar-usuario" class="table table-striped table-hover display" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Tipo de Usuário</th>
                    <th>Status do Usuário</th>

                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#listar-usuario').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            },
            "ajax": {
                "url": "get_usuarios.php",
                "dataSrc": "" 
            },
            "columns": [
                { "data": "cd_usuario" },
                { "data": "nm_nome" },
                { "data": "nm_email" },
                { "data": "ct_usuario" },
                { "data": "cd_tipo_usuario" },
                { "data": "cd_status_usuario" }
            ]
        });
    });
</script>


    </body>