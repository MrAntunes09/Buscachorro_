<?php

require_once '../conect.php';

$sql = '
select * from tb_usuario;
';

$result = $GLOBALS['con']->query($sql);

$usuario = array();

while ($row = mysqli_fetch_assoc($result)) {
    $usuario[] = $row;
}

echo json_encode($usuario);
?>
