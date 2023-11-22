<?php

require_once 'header.php';
require_once 'navigation.php';
require_once '../validar.php';

$pagina = "cadastro_animal.php";
?>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Cadastro de Cachorro</h1>
        <a href="mapeamentomancha.php" class="btn btn-primary mb-3">Mapeamento da Mancha</a>
        <form onsubmit="submitForm()" action="" method="post" enctype="multipart/form-data">
        <form onsubmit="submitForm()" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome_animal" class="form-label">Nome do animal</label>
                <input type="text" class="form-control" name="nome_animal" placeholder="Digite o nome do animal"
                    required>
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" name="sexo" required>
                    <option value="1">Macho</option>
                    <option value="2">Fêmea</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="addressInput" class="form-label">Endereço:</label>
                <input type="text" id="addressInput" class="form-control" name="addressInput" placeholder="Digite o endereço" required>
            </div>
            <div class="mb-3">
                <label for="ponto_ref" class="form-label">Ponto de referência</label>
                <input type="text" class="form-control" name="ponto_ref" placeholder="Digite o ponto de referência"
                    required>
            </div>
            <div class="mb-3">
                <label for="porte" class="form-label">Porte do animal</label>
                <select class="form-select" name="porte" required>
                    <option value="1">Pequeno</option>
                    <option value="2">Médio</option>
                    <option value="3">Grande</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" name="descricao" placeholder="Digite a descrição">
            </div>
            <div class="mb-3">
                <label for="cor" class="form-label">Cor do animal</label>
                <select class="form-select" name="cor">
                    <option value="0">Selecione uma cor</option>
                    <?php
                    // Loop para preencher as opções de cor a partir do banco de dados
                    $sql = 'SELECT * FROM tb_cor ORDER BY nm_cor ASC;';
                    $res = $GLOBALS['con']->query($sql);

                    // Loop while para percorrer todos os registros de cor
                    while ($row = mysqli_fetch_assoc($res)) {
                        $cd_cor = $row['cd_cor'];
                        $nm_cor = $row['nm_cor'];
                        echo '<option value="' . $cd_cor . '">' . $nm_cor . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="raca" class="form-label">Raça</label>
                <select class="form-select" name="raca">
                    <option value="0">Selecione uma raça</option>
                    <?php
                    // Loop para preencher as opções de raça a partir do banco de dados
                    $sql = 'SELECT * FROM tb_raca ORDER BY nm_raca ASC;';
                    $res = $GLOBALS['con']->query($sql);

                    // Loop while para adicionar as opções de raça
                    while ($row = mysqli_fetch_assoc($res)) {
                        $cd_raca = $row['cd_raca'];
                        $nm_raca = $row['nm_raca'];
                        echo '<option value="' . $cd_raca . '">' . $nm_raca . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Selecione uma imagem</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagem" name="imagem" required>
                        <label class="custom-file-label" for="imagem">Escolha um arquivo</label>
                    </div>

                </div>

            </div>
            <button type="submit" name="action" value="Cadastrar" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        function submitForm() {
            var address = document.getElementById('addressInput').value;
            // Armazena o endereço no sessionStorage para acessar no card do animal cadastrado
            sessionStorage.setItem('userAddress', address);
            // Redireciona para a página do mapa
            window.location.href = 'index.php';
        }
    </script>


</body>

<?php
// Processar os dados do formulário quando o formulário for enviado
if (!empty($_POST)) {
    if ($_POST['action'] == "Cadastrar") {
        // Verificar a extensão do arquivo de imagem
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

        // Verificar se a extensão é válida
        if ($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" || $extensao == "jfif" || $extensao == "webp") {
            $uploaddir = "img_animais/";

            // Definir a extensão correta para a imagem
            if ($extensao == "jpeg" || $extensao == "jfif" || $extensao == "webp") {
                $ext = strtolower(substr($_FILES['imagem']['name'], -5));
            } else if ($extensao == "png" || $extensao == "jpg") {
                $ext = strtolower(substr($_FILES['imagem']['name'], -4));
            }

            // Gerar um nome único para a imagem
            $imagem = md5(date("d-m-y-h-i-s") . $_FILES['imagem']['name']) . $ext;
            $uploadfile = $uploaddir . basename($imagem);

            // Mover o arquivo de imagem para o diretório de upload
            move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile);

            // Chamar a função CadastrarAnimal com os dados do formulário
            CadastrarAnimal(
                $_POST['nome_animal'],
                $_SESSION['id'],
                $pagina,
                $imagem,
                $_POST['raca'],
                $_POST['sexo'],
                $_POST['descricao'],
                $_POST['ponto_ref'],
                $_POST['porte'],
                $_POST['cor'],
            );
        }
    } else {
        echo "Extensão não permitida!";
    }
}
?>


