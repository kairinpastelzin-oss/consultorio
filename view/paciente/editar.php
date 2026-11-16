<?php
use App\Paciente;
include('../vendor/autoload.php');
include('../includes/cabecalho.php');
include('../includes/menu.php');
$id = $_GET['id'];
$paciente = Paciente::buscarPorId($id);

if (!$paciente) {
    die('Paciente não encontrado!');
}

?>
<main class="container">
    <h1>Editar Paciente</h1>
    <form method="POST" action="/consultorio/action/action_paciente.php?action=alterar&id=<?= $paciente->id ?>">

        Nome *:<input name="nome" type="text" value="<?=$paciente->nome?>"class="form-control" required>
        CPF *:<input name="cpf" type="text"value="<?=$paciente->cpf?>"class="form-control" required>
        Data de Nascimento *:<input name="data_nascimento" type="date" value="<?=$paciente->data_nascimento?>"class="form-control" required>
        Telefone *: <input name="telefone" type="text"value="<?=$paciente->telefone?>"class="form-control" required>
        Email *:<input name="email" type="email"value="<?= $paciente->email?>" class="form-control" required>
        Endereço *:<input name="endereco" type="text" value="<?=$paciente->endereco?>"class="form-control" required>
        Convênio:<input name="convenio" type="text" value="<?=$paciente->convenio ?? '' ?>"class="form-control">
        Observação:<input name="observacao" type="text"value="<?= $paciente->observacao ?? '' ?>"class="form-control">
        <br>
        <input type="submit" value="Salvar Alterações" class="btn btn-primary">
        <a href="/consultorio/view/paciente/listar.php" class="btn btn-secondary">Voltar</a>

    </form>

    <div class="pb-5"></div>

</main>
