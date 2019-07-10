<?php

require 'database.php';

$clientes = [];
$sql = "SELECT Nome, cpf, endereco FROM clientes";

if($result = mysqli_query($con, $sql))
{
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $clientes[$i]['nome'] = $row['nome'];
        $clientes[$i]['cpf'] = $row['cpf'];
        $clientes[$i]['endereco']= $row['endereco'];
        $i++;
    }

    echo json_encode($clientes);
}
else
{
    http_response_code(404);
}