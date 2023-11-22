<?php

require_once '../conect.php';

$sql = '
SELECT
A.cd_animal,
A.nm_animal,
A.sexo_animal, 
U.nm_nome ,
R.nm_raca ,
C.nm_cor 
FROM
tb_animal A
JOIN
tb_usuario U ON A.id_usuario = U.cd_usuario
JOIN
tb_raca R ON A.id_raca = R.cd_raca
JOIN
tb_cor C ON A.id_cor = C.cd_cor;
';

$result = $GLOBALS['con']->query($sql);

$animais = array();

while ($row = mysqli_fetch_assoc($result)) {
    $animais[] = $row;
}

echo json_encode($animais);
?>
