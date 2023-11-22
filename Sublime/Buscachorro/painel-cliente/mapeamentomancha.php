<?php

require_once 'header.php';
require_once 'navigation.php';
require_once '../validar.php';

$pagina = "cadastro_animal.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#333">   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
    .highlighted {
        outline: 2px solid red; /* Altere a cor e a largura da borda conforme necessário */
    }
    </style>

    <script>
        $(document).ready(function () {
            $('map area').click(function () {
                var dataId = $(this).data('id');
                var isHighlighted = $(this).hasClass('highlighted');

                if (isHighlighted) {
                    // Remove a classe 'highlighted' apenas desta área
                    $('map area[data-id="' + dataId + '"]').removeClass('highlighted');
                } else {
                    // Adiciona a classe 'highlighted' apenas a esta área
                    $('map area[data-id="' + dataId + '"]').addClass('highlighted');
                }
            });
        });
    </script>
</head>
<body>
   <center> <h2>Clique na(s) Região(ões) onde o animal possui manchas</h2></center>
   <center>  <section class="section">
        <figure>
            <center> <h3>Lado esquerdo</h3></center>
            <img src="./img/cachorrocadastro.png" alt="cachorrocadastro" usemap="#cachorrocadastro" >
        </figure>
        <map name="cachorrocadastro">
            <area target="" alt="pescoço" title="pescoço" href="#" coords="177,211,189,170,208,132,239,98,215,72,198,55,120,109" shape="poly" data-id="1">
    <area target="" alt="peitoral " title="peitoral " href="#" coords="198,163,217,118,238,102,307,123,287,168,286,257,227,294,203,263,181,211,188,185" shape="poly" data-id="2">
    <area target="" alt="flanco" title="flanco" href="#" coords="529,104,492,132,493,177,491,216,439,214,363,229,292,252,287,194,292,153,311,123,366,126,408,114,492,104" shape="poly" data-id="3">
    <area target="" alt="barriga" title="barriga" href="#" coords="334,289,402,269,482,235,492,222,452,218,320,240,265,275,281,289" shape="poly" data-id="4">
    <area target="" alt="coxa" title="coxa" href="#" coords="605,159,602,208,591,246,574,279,545,308,503,310,496,278,498,211,493,172,498,130,525,104,570,112" shape="poly" data-id="5">
    <area target="" alt="cauda" title="cauda" href="#" coords="591,120,619,167,631,214,636,261,653,336,642,343,627,298,621,259,607,204,610,171" shape="poly" data-id="6">
    <area target="" alt="ponta da cauda" title="ponta da cauda" href="#" coords="640,347,668,378,660,340" shape="poly" data-id="7">
    <area target="" alt="braço superior esquerdo" title="braço superior esquerdo" href="#" coords="250,275,233,293,232,321,238,379,257,389,274,388,279,358,279,316,272,285" shape="poly" data-id="8">
    <area target="" alt="braço inferior esquerdo" title="braço inferior esquerdo" href="#" coords="240,384,258,393,277,393,273,444,263,493,244,490,246,427" shape="poly" data-id="9">
    <area target="" alt="pata dianteira esquerda" title="pata dianteira esquerda" href="#" coords="219,499,233,495,260,492,260,510,239,514,217,515" shape="poly" data-id="10">
    <area target="" alt="pata traseira esquerda" title="pata traseira esquerda" href="#" coords="472,516,484,494,509,494,523,501,514,515" shape="poly" data-id="11">
    <area target="" alt="perna inferior esquerda" title="perna inferior esquerda" href="#" coords="526,499,503,489,514,462,524,441,541,414,553,404,561,416" shape="poly" data-id="12">
    <area target="" alt="perna superior esquerda" title="perna superior esquerda" href="#" coords="526,431,542,407,558,399,555,368,558,334,565,300,546,306,528,311,502,310" shape="poly" data-id="13">
    <area target="" alt="Orelha esquerda" title="Orelha esquerda" href="#" coords="83,21,86,50,95,77,119,82,136,62,136,33,133,17,111,10" shape="poly" data-id="14">
    <area target="" alt="cabeça" title="cabeça" href="#" coords="69,105,120,103,145,93,170,74,188,60,193,50,157,22,136,17,138,61,114,88,91,73,80,25,69,33,21,65,12,75,20,84,21,94,33,105,45,114" shape="poly" data-id="15">
        </map>
    </section>
</center>
</body>
</html>


















</body>
</html>