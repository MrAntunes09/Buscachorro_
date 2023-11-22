<?php
require_once("header.php");
require_once("navigation.php");
?>

<body>
    <div class="container">
        <h2 class="text-center mt-4">Encontre seu animal!</h2>
        <hr>

        <div class="row">
            <?php
            $sql = '
            SELECT cd_animal, nm_animal, descricao, url_imagem
            FROM tb_animal AS an
            INNER JOIN tb_foto AS ft ON an.cd_animal = ft.id_animal;
            ';

            $res = $GLOBALS['con']->query($sql);
            while ($dados = mysqli_fetch_assoc($res)) {
                ?>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 d-flex flex-column shadow p-3 mb-5 bg-white rounded">
                        <img class="card-img-top" height="180" width="287"
                            src="<?php echo '../painel-cliente/img_animais/' . $dados['url_imagem']; ?>"
                            alt="Imagem do animal">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?php echo $dados['nm_animal']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $dados['descricao']; ?>
                            </p>
                            <button type="button" class="btn btn-primary mt-auto" data-toggle="modal"
                                data-target="#visitar<?php echo $dados['cd_animal']; ?>">
                                Visitar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para visitar o animal -->
                <div class="modal fade" id="visitar<?php echo $dados['cd_animal']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <?php echo $dados['nm_animal']; ?>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!-- <label for="foto"></label> -->
                                <img class="card-img-top" height="400" width="500"
                                    src="<?php echo 'img_animais/' . $dados['url_imagem']; ?>" alt="Imagem do animal">
                                <h3>
                                    <label for="nome do animal">Nome do Animal:</label><br>
                                    <?php echo $dados['nm_animal']; ?>
                                </h3>
                                <p class="card-text">
                                    <?php echo $dados['descricao']; ?>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</body>

<?php
require_once '../footer.php';
?>
