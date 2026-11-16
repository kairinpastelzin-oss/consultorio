<?php
use App\Paciente;
include('../vendor/autoload.php');
$action = $_GET['action'];
$paciente = new Paciente();
switch($action){
    case 'cadastrar':
        $paciente->nome = $_POST['nome'];
        $paciente->cpf = $_POST['cpf'];
        $paciente->data_nascimento = $_POST['data_nascimento'];
        $paciente->telefone = $_POST['telefone'];
        $paciente->email = $_POST['email'];
        $paciente->endereco = $_POST['endereco'];
        $paciente->convenio = $_POST['convenio'];
        $paciente->observacao = $_POST['observacao'];
        $paciente->cadastrar();
<<<<<<< HEAD
        header('location: /consultorio/view/paciente/listar.php');
    break;
    case 'alterar':

        break;
    case 'excluir':
        $paciente->id = $_GET('id');
        $paciente->excluir();
=======
        
        header('location: /consultorio/view/paciente/listar.php');
    break;
    case 'alterar':
        $paciente = Paciente::buscarPorId($_GET['id']);
        $paciente->nome = $_POST['nome'];
        $paciente->cpf = $_POST['cpf'];
        $paciente->data_nascimento = $_POST['data_nascimento'];
        $paciente->telefone = $_POST['telefone'];
        $paciente->email = $_POST['email'];
        $paciente->endereco = $_POST['endereco'];
        $paciente->convenio = $_POST['convenio'];
        $paciente->observacao = $_POST['observacao'];
        $paciente->alterar();
        header('location: /consultorio/view/paciente/listar.php');
    break;
    case 'excluir':
        $paciente->id = $_GET['id'];
        $paciente->excluir();
        header('location: /consultorio/view/paciente/listar.php');
>>>>>>> d7d7118ef4abeff5aa9b2ae3daef72b1dc3aa2dd
    break;
}
?>