<?php
use App\Consulta;
ob_start(); // evita erro de "headers already sent" por causa dos echo do DataBase
include('../vendor/autoload.php');
$action = $_GET['action'];
$consulta = new Consulta();
switch($action){
    case 'cadastrar':
        $consulta->paciente_id = $_POST['paciente_id'];
        $consulta->dentista_id = $_POST['dentista_id'];
        $consulta->data_hora = str_replace('T', ' ', $_POST['data_hora']);
        $consulta->valor_total = $_POST['valor_total'] ?: 0;
        $consulta->valor_pago = $_POST['valor_pago'] ?: 0;
        $consulta->forma_pagamento = $_POST['forma_pagamento'];
        $consulta->procedimentos_realizados = $_POST['procedimentos_realizados'];
        $consulta->procedimentos_arealizar = $_POST['procedimentos_arealizar'];
        $consulta->descricao = $_POST['descricao'];
        $consulta->medicacao = $_POST['medicacao'];
        $consulta->cadastrar();
        header('location: /consultorio/view/consulta/listar.php');
    break;
    case 'alterar':
        $consulta = Consulta::buscarPorId($_GET['id']);
        $consulta->paciente_id = $_POST['paciente_id'];
        $consulta->dentista_id = $_POST['dentista_id'];
        $consulta->data_hora = str_replace('T', ' ', $_POST['data_hora']);
        $consulta->valor_total = $_POST['valor_total'] ?: 0;
        $consulta->valor_pago = $_POST['valor_pago'] ?: 0;
        $consulta->forma_pagamento = $_POST['forma_pagamento'];
        $consulta->procedimentos_realizados = $_POST['procedimentos_realizados'];
        $consulta->procedimentos_arealizar = $_POST['procedimentos_arealizar'];
        $consulta->descricao = $_POST['descricao'];
        $consulta->medicacao = $_POST['medicacao'];
        $consulta->alterar();
        header('location: /consultorio/view/consulta/listar.php');
    break;
    case 'excluir':
        $consulta->id = $_GET['id'];
        $consulta->excluir();
        header('location: /consultorio/view/consulta/listar.php');
    break;
}
?>
