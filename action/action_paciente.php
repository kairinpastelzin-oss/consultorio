<?php
    use App\Paciente;
    require('consultorio/vendor/autoload.php');
    $action = $_GET('action');
    $paciente = new Paciente();
    switch($action)
    {
    case 'cadastrar';
        $paciente->nome = $_POST['nome'];
        $paciente->cpf = $_POST['cpf'];
        $paciente->dataNascimento = $_POST['data_nascimento'];
        $paciente->telefone = $_POST['telefone'];
        $paciente->email = $_POST['email'];
        $paciente->endereco = $_POST['endereco'];
        $paciente->convenio = $_POST['convenio'];
        $paciente->observacao = $_POST['observacao'];
        $paciente->cadastrar();
        echo"<pre>";

        echo"</pre>";    
    break;
    case 'alterar';
    
    break;
    case 'excluir';

    break;
    }
?>