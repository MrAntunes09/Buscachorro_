<?php
function Confirma($msg, $pagina)
{
    print '
        <div class="modal fade" id="myModal" data-backdrop="static">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        Confirmação
                    </div>
                    <div class="modal-body text-center">
                        ' . $msg . '
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" onclick="redireciona()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function redireciona(){
                location.href = "' . $pagina . '";
            }
        </script>
    ';
}

function Erro($msg)
{
    print '
        <div class="modal fade" id="myModal" data-backdrop="static">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        Erro
                    </div>
                    <div class="modal-body text-center">
                        ' . $msg . '
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" onclick="redireciona()">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function redireciona(){
                history.go(-1);
            }
        </script>
    ';
}

function CadastrarUsuario($nome, $telefone, $email, $senha, $cidade, $estado, $cep)
{
    $sql = '
        INSERT INTO tb_usuario (nm_nome, ct_usuario, nm_email, nm_senha, nm_cidade, nm_estado, nm_cep, cd_tipo_usuario, cd_status_usuario)
        VALUES ("' . $nome . '", "' . $telefone . '", "' . $email . '", MD5("' . $senha . '"), "' . $cidade . '", "' . $estado . '", "' . $cep . '", "2", "1");
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("Cadastrado com sucesso!", "login.php");
    } else {
        Erro("Há algum erro aí! Verifique a inserção de dados.");
    }
}


function ValidarLogin($email, $senha)
{
    $sql = '
        SELECT cd_usuario, cd_tipo_usuario 
        FROM tb_usuario 
        WHERE nm_email = "' . $email . '" AND nm_senha = MD5("' . $senha . '") AND cd_status_usuario = "1";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res->num_rows == 1) {
        $exibe = $res->fetch_array();
        session_start();

        if ($exibe['cd_tipo_usuario'] == "1") {
            $_SESSION['id'] = $exibe['cd_usuario'];
            $_SESSION['user'] = $exibe['nm_nome'];
            $_SESSION['tipo'] = $exibe['cd_tipo_usuario'];
            Confirma("Bem vindo", "painel-adm/index.php");
        } else if ($exibe['cd_tipo_usuario'] == "2") {
            $_SESSION['id'] = $exibe['cd_usuario'];
            $_SESSION['user'] = $exibe['nm_nome'];
            $_SESSION['tipo'] = $exibe['cd_tipo_usuario'];
            Confirma("Bem vindo", "painel-cliente/index.php");
        } else {
            Erro("Login não realizado!");
        }
    } else {
        Erro("Ops... Parece que há algum erro! Tente novamente.");
    }
}

function CadastrarAnimal($nome_animal, $usuario, $pagina, $imagem, $raca, $sexo, $descricao, $pontoref, $porte, $cor)
{
    $sql = '
        INSERT INTO tb_animal (nm_animal, sexo_animal, nm_ponto_referencia, descricao, nm_porte, st_animal, id_cor, id_raca, id_usuario)
        VALUES ("' . $nome_animal . '", "' . $sexo . '", "' . $pontoref . '", "' . $descricao . '", "' . $porte . '", "1", "' . $cor . '", "' . $raca . '", "' . $usuario . '");
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        $sql = '
            SELECT cd_animal 
            FROM tb_animal 
            WHERE nm_animal = "' . $nome_animal . '" AND id_usuario = "' . $usuario . '";
        ';

        $busca = $GLOBALS['con']->query($sql);

        if ($busca->num_rows > 0) {
            $exibe = $busca->fetch_array();
            EnviarFoto($imagem, $exibe['cd_animal'], $pagina);
        } else {
            Erro("Animal nao encontrado!");
        }
    } else {
        Erro("Erro ao cadastrar animal!");
    }
}

function EnviarFoto($imagem, $cd_animal, $pagina)
{
    $sql = '
        INSERT INTO tb_foto (url_imagem, id_animal)
        VALUES ("' . $imagem . '", "' . $cd_animal . '");
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("Imagem Enviada com sucesso!", $pagina);
    } else {
        Erro("Imagem não enviada!");
    }
}

// Função para alterar o telefone
function AlterarTelefone($usuario, $telefone)
{
    $sql = '
        UPDATE tb_usuario
        SET ct_usuario = "' . $telefone . '"
        WHERE cd_usuario = "' . $usuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("Telefone alterado com sucesso!", "painel_controle.php");
    } else {
        Erro("Erro ao alterar o telefone!");
    }
}

// Função para alterar o e-mail
function AlterarEmail($usuario, $email)
{
    $sql = '
        UPDATE tb_usuario
        SET nm_email = "' . $email . '"
        WHERE cd_usuario = "' . $usuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("E-mail alterado com sucesso!", "painel_controle.php");
    } else {
        Erro("Erro ao alterar o e-mail!");
    }
}

// Função para alterar a cidade
function AlterarCidade($usuario, $cidade)
{
    $sql = '
        UPDATE tb_usuario
        SET nm_cidade = "' . $cidade . '"
        WHERE cd_usuario = "' . $usuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("Cidade alterada com sucesso!", "painel_controle.php");
    } else {
        Erro("Erro ao alterar a cidade!");
    }
}

// Função para alterar o estado
function AlterarEstado($usuario, $estado)
{
    $sql = '
        UPDATE tb_usuario
        SET nm_estado = "' . $estado . '"
        WHERE cd_usuario = "' . $usuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("Estado alterado com sucesso!", "painel_controle.php");
    } else {
        Erro("Erro ao alterar o estado!");
    }
}

// Função para alterar o CEP
function AlterarCep($usuario, $cep)
{
    $sql = '
        UPDATE tb_usuario
        SET nm_cep = "' . $cep . '"
        WHERE cd_usuario = "' . $usuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("CEP alterado com sucesso!", "painel_controle.php");
    } else {
        Erro("Erro ao alterar o CEP! Verifique a atualização de dados.");
    }
}



function ObterDadosUsuario($id_usuario)
{
    $sql = '
        SELECT nm_nome, ct_usuario, nm_email, nm_cidade, nm_estado, nm_cep
        FROM tb_usuario
        WHERE cd_usuario = "' . $id_usuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res && $res->num_rows > 0) {
        return $res->fetch_assoc();
    }

    return null;
}


?>


