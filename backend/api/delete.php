<?php

require 'database.php';

// Extract, valcpfate and sanitize the cpf.
$cpf = ($_GET['cpf'] !== null && (int)$_GET['cpf'] !== '')? mysqli_real_escape_string($con, $_GET['cpf']) : false;

if(!$cpf)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `policies` WHERE `cpf` ='{$cpf}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}