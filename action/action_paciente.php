<?php
use App\Paciente;
include('../vendor/autoload.php');
$action = $_GET['action'] ?? '';
switch ($action) {

    case 'cadastrar':
        $paciente = new Paciente();
        $paciente->nome = $_POST['nome'];
        $paciente->cpf = $_POST['cpf'];
        $paciente->data_nascimento = $_POST['data_nascimento'];
        $paciente->telefone = $_POST['telefone'];
        $paciente->email = $_POST['email'];
        $paciente->endereco = $_POST['endereco'];
        $paciente->convenio = $_POST['convenio'] ?? '';
        $paciente->observacao = $_POST['observacao'] ?? '';
        $paciente->cadastrar();
        header('Location: /consultorio/view/paciente/listar.php');
        exit;
    case 'alterar':
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die('ID do paciente não informado!');
        }
        $paciente = Paciente::buscarPorId($id);
        if (!$paciente) {
            die('Paciente não encontrado!');
        }
        $paciente->nome = $_POST['nome'];
        $paciente->cpf = $_POST['cpf'];
        $paciente->data_nascimento = $_POST['data_nascimento'];
        $paciente->telefone = $_POST['telefone'];
        $paciente->email = $_POST['email'];
        $paciente->endereco = $_POST['endereco'];
        $paciente->convenio = $_POST['convenio'] ?? '';
        $paciente->observacao = $_POST['observacao'] ?? '';
        $paciente->alterar();
        header('Location: /consultorio/view/paciente/listar.php');
        exit;

    case 'excluir':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die('ID do paciente não informado!');
        }
        $paciente = Paciente::buscarPorId($id);
        if (!$paciente) {
            die('Paciente não encontrado!');
        }
        $paciente->excluir();

        header('Location: /consultorio/view/paciente/listar.php');
        exit;
    default:
        header('Location: /consultorio/view/paciente/listar.php');
        exit;
}

?>