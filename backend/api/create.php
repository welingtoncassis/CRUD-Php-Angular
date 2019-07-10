<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->nome) === '' || $request->cpf === '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $nome = mysqli_real_escape_string($con, trim($request->nome));
  $cpf = mysqli_real_escape_string($con, $request->cpf);
  $endereco = mysqli_real_escape_string($con, $request->endereco);


  // Create.
  $sql = "INSERT INTO `policies`(`nome`,`cpf`,`endereco`) VALUES ('{$endereco}','{$nome}','{$cpf}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'nome' => $nome,
      'cpf' => $cpf,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}