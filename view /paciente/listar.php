<?php

use App\Paciente;
    include('../cabecalho.php');
    include('../menu.php');
    include('../rodape.php');
    $pacientes = Paciente::listar();
?>
<main class="container">
    <h1>Lista de Pacotes</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Convenio</th>
                <th>Observação</th>
                <th>Acções</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach($pacientes as $paciente)
    {
        echo"<tr>
        <td>".$paciente->nome."</td>
        <td>".$paciente->cpf."</td>
        <td>".$paciente->dataNascimento."</td>
        <td>".$paciente->tefelone."</td>
        <td>".$paciente->email."</td>
        <td>".$paciente->endereco."</td>
        <td>".$paciente->convenio."</td>
        <td>".$paciente->obeservacao."</td>
        <td>
            <a href='editar.php?id=".$paciente->id.">
            <a href='consultorio/action/action_paciente.php?action=excluir&id=".$paciente->id."'>
        </td>
        </tr>";
    }
?>
        </tbody>
    </table>
    <div class="pb-5"></div>
</main>