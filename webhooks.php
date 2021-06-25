<?php
include("./conexao.php");
//$json = $_POST;
$json = $HTTP_RAW_POST_DATA;
//$json = file_get_contents('teste.json');
$jsonDecodificado = json_decode($json);
$servidor = ($jsonDecodificado->web_server_config->agent_label);
$camera = $jsonDecodificado->web_server_config->camera_label;
$placa = $jsonDecodificado->best_plate->plate;
$carro = $jsonDecodificado->vehicle->make[0]->name ." ". $jsonDecodificado->vehicle->color[0]->name ." ". $jsonDecodificado->vehicle->body_type[0]->name ;
$porcentagem = ($jsonDecodificado->best_confidence );

echo $servidor."<br>";
echo $camera."<br>";
echo $placa."<br>";
echo $carro."<br>";
echo $porcentagem."<br>";
date_default_timezone_set('America/Sao_Paulo');
$data =  date('y/m/d');
$hora =  date('H:i:s');
//$conteudo = array("servidor"=> $servidor, "camera"=> $camera, "placa"=>$placa, "carro" => $carro, "porcentagem"=> $porcentagem);
//file_put_contents("test.txt",$conteudo);

$up = $conexao ->prepare("INSERT INTO registro (servidor,camera,placa,modelo,porcentagem,hora,dia) VALUES (:sever, :cam, :plate, :model, :per, :hr, :dt);");
$up -> bindValue(":sever",$servidor);
$up -> bindValue(":cam",$camera);
$up -> bindValue(":plate",$placa);
$up -> bindValue(":model",$carro);
$up -> bindValue(":per",$porcentagem);
$up -> bindValue(":hr",$hora);
$up -> bindValue(":dt",$data);
$up -> execute();
?>