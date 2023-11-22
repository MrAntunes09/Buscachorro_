<?php
require_once("header.php");
require_once("navigation.php");
require_once("validar.php");

function SenhaAtualCorreta($senhaArmazenada, $senhaAtual)
{
    return md5($senhaAtual) === $senhaArmazenada;
}

function AtualizarSenhaBanco($idUsuario, $novaSenha)
{
    $sql = '
        UPDATE tb_usuario
        SET nm_senha = "' . $novaSenha . '"
        WHERE cd_usuario = "' . $idUsuario . '";
    ';

    $res = $GLOBALS['con']->query($sql);

    if ($res) {
        Confirma("Senha alterada com sucesso!", "painel_controle.php");
    } else {
        Erro("Erro ao alterar a Senha! Verifique a atualização de dados.");
    }
}

function AtualizarSenha($idUsuario, $senhaAtual, $senhaNova)
{
    $senhaArmazenada = ObterSenhaUsuario($idUsuario);
    if (SenhaAtualCorreta($senhaArmazenada, $senhaAtual)) {
        AtualizarSenhaBanco($idUsuario, md5($senhaNova));
        Confirma("Senha alterada com sucesso!", "painel_controle.php");
    } else {
        Erro("A senha atual está incorreta.");
    }
}

if (!empty($_POST)) {
    if ($_POST['action'] == "Alterar Senha") {
        AtualizarSenha(
            $_SESSION['id'],
            $_POST['senhaatual'],
            $_POST['senhanova']
        );
    }

}



if (!empty($_POST)) {
    if ($_POST['action'] == "Cadastrar") {
        if ($_POST['senha'] == $_POST['senha2']) {
            CadastrarUsuario(
                $_POST['nome'],
                $_POST['telefone'],
                $_POST['email'],
                $_POST['senha'],
                $_POST['cidade'],
                $_POST['estado'],
                $_POST['cep']
            );
        } else {
            Erro("Ops! As senhas digitadas não coincidem!");
        }
    } else if ($_POST['action'] == "Entrar") {
        ValidarLogin($_POST['email'], $_POST['senha']);
    } else if ($_POST['action'] == "Alterar Telefone") {
        AlterarTelefone($_SESSION['id'], $_POST['telefone']);
    } else if ($_POST['action'] == "Alterar Email") {
        AlterarEmail($_SESSION['id'], $_POST['email']);
    } else if ($_POST['action'] == "Alterar Cidade") {
        AlterarCidade($_SESSION['id'], $_POST['cidade']);
    } else if ($_POST['action'] == "Alterar Estado") {
        AlterarEstado($_SESSION['id'], $_POST['estado']);
    } else if ($_POST['action'] == "Alterar Cep") {
        AlterarCep($_SESSION['id'], $_POST['cep']);
    } else if ($_POST['action'] == "Alterar Senha") {
        AlterarSenha($_SESSION['id'], $_POST['senhaatual'], $_POST['senhanova']);
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php
                        $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                        if ($dadosUsuario) {
                            echo '<h4 class="card-title">' . $dadosUsuario['nm_nome'] . '</h4>';
                        } else {
                            echo '<p class="card-text">Erro ao recuperar dados do usuário.</p>';
                        }
                        ?>
                    </h4>
                    <hr>
                    <p class="card-text">No Buscachorro desde 1990 </p>
                    <a href="#" class="btn btn-primary">Editar Perfil</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Seu cadastro</h4>
                    <hr>
                    <div class="container mt-5">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="card-text"><strong>Telefone: </strong>
                                <?php
                                $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                                if ($dadosUsuario) {
                                    echo  $dadosUsuario['ct_usuario'] ? $dadosUsuario['ct_usuario'] : 'N/A';
                                } else {
                                    echo '<p class="card-text">Erro ao recuperar dados do usuário.</p>';
                                }
                                ?>
                            </p>
                            <a href="#" data-toggle="modal" data-target="#edittel" class="btn btn-link">Alterar</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="card-text"><strong>E-mail: </strong>
                                <?php
                                $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                                if ($dadosUsuario) {
                                    echo  $dadosUsuario['nm_email'] ? $dadosUsuario['nm_email'] : 'N/A';
                                } else {
                                    echo '<p class="card-text">Erro ao recuperar dados do usuário.</p>';
                                }
                                ?> 
                            </p>
                            <a href="#" data-toggle="modal" data-target="#editemail" class="btn btn-link">Alterar</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text"><strong>Cidade: </strong>
                                <?php
                                $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                                if ($dadosUsuario) {
                                    echo $dadosUsuario['nm_cidade'] ? $dadosUsuario['nm_cidade'] : 'N/A';
                                } else {
                                    echo '<p class="card-text">Erro ao recuperar dados do usuário.</p>';
                                }
                                ?>
                            </p>
                            <a href="#" data-toggle="modal" data-target="#editcidade" class="btn btn-link">Alterar</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="card-text"><strong>Estado: </strong>
                                <?php
                                $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                                if ($dadosUsuario) {
                                    echo  $dadosUsuario['nm_estado'] ? $dadosUsuario['nm_estado'] : 'N/A';
                                } else {
                                    echo '<p class="card-text">Erro ao recuperar dados do usuário.</p>';
                                }
                                ?>   
                            </p>
                            <a href="#" data-toggle="modal" data-target="#editestado" class="btn btn-link">Alterar</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="card-text"><strong>CEP: </strong>
                                <?php
                                $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                                if ($dadosUsuario) {
                                    echo !empty($dadosUsuario['nm_cep']) ? $dadosUsuario['nm_cep'] : 'N/A';
                                } else {
                                    echo '<p class="card-text">Erro ao recuperar dados do usuário.</p>';
                                }
                                ?>
                            </p>
                            <a href="#" data-toggle="modal" data-target="#editcep" class="btn btn-link">Alterar</a>
                        </div>
   
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="card-text"><strong>Senha: </strong>
                                <?php
                                $dadosUsuario = ObterDadosUsuario($_SESSION['id']);
                                if ($dadosUsuario && isset($dadosUsuario['nm_senha'])) {
                                    echo $dadosUsuario['nm_senha'];
                                } else {
                                    echo '<p class="card-text">Erro ao recuperar a senha do usuário.</p>';
                                }
                                ?>
                                <a href="#" data-toggle="modal" data-target="#editsenha" class="btn btn-link"  style="margin-left: 143%; margin-top:-12%;">Alterar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--modal telefone-->
<div class="modal fade" id="edittel" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header text-center">
                    Altere seu telefone!
                </div>

                <div class="modal-body text-center">
                    <input type="text" name="telefone" placeholder="Seu telefone" class="form-group" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Alterar Telefone" class="btn btn-primary" name="action">
                </div>
            </form>
        </div>
    </div>
</div>

<!--modal email-->
<div class="modal fade" id="editemail" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header text-center">
                    Altere seu email!
                </div>

                <div class="modal-body text-center">
                    <input type="email" name="email" placeholder="Seu email" class="form-group" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Alterar Email" class="btn btn-primary" name="action">
                </div>
            </form>
        </div>
    </div>
</div>

<!--modal cidade-->
<div class="modal fade" id="editcidade" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header text-center">
                    Altere sua cidade!
                </div>

                <div class="modal-body text-center">
                    <input type="text" name="cidade" placeholder="Sua cidade" class="form-group" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Alterar Cidade" class="btn btn-primary" name="action">
                </div>
            </form>
        </div>
    </div>
</div>

<!--modal estado-->
<div class="modal fade" id="editestado" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header text-center">
                    Altere seu estado!
                </div>

                <div class="modal-body text-center">
                    <input type="text" name="estado" placeholder="Seu estado" class="form-group" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Alterar Estado" class="btn btn-primary" name="action">
                </div>
            </form>
        </div>
    </div>
</div>

<!--modal cep-->
<div class="modal fade" id="editcep" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header text-center">
                    Altere seu CEP!
                </div>

                <div class="modal-body text-center">
                <input type="text" name="cep" placeholder="Seu CEP" class="form-group" required>

                    <br>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Alterar Cep" class="btn btn-primary" name="action">
                </div>
            </form>
        </div>
    </div>
</div>


<!--modal Senha-->
<div class="modal fade" id="editsenha" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header text-center">
                    Altere sua Senha!
                </div>

                <div class="modal-body text-center">
                    <input type="password" name="senhaatual" placeholder="Senha Atual" class="form-group" required>
                    <br>
                    <input type="password" name="senhanova" placeholder="Senha Nova" class="form-group" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Alterar Senha" class="btn btn-primary" name="action">
                </div>
            </form>
        </div>
    </div>
</div>


