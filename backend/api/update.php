<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Valenderecoate.
  if (trim($request->nome) == '' || trim($request->cpf) == '') {
    return http_response_code(400);
  }

  // Sanitize.
  $endereco    = mysqli_real_escape_string($con, $request->endereco);
  $nome = mysqli_real_escape_string($con, trim($request->nome));
  $cpf = mysqli_real_escape_string($con, $request->cpf);

  // Update.
  $sql = "UPDATE `policies` SET `nome`='$nome',`cpf`='$cpf' WHERE `endereco` = '{$endereco}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}