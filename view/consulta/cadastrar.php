<?php
use App\Paciente;
use App\Funcionario;
include('../includes/cabecalho.php');
include('../includes/menu.php');
include('../includes/rodape.php');

$pacientes = Paciente::listar();
$dentistas = Funcionario::listar("perfil = 'dentista'");
$formas = ['DINHEIRO', 'PIX', 'CARTÃO DE DEBITO', 'CARTÃO DE CREDITO'];
?>
<main class="container">
    <h1>Cadastrar Consulta</h1>
    <form method="POST" action="/consultorio/action/action_consulta.php?action=cadastrar">
        Paciente * : <select name="paciente_id" class="form-select" required>
            <option value="">Selecione o paciente</option>
            <?php foreach ($pacientes as $p) { ?>
                <option value="<?= $p->id ?>"><?= htmlspecialchars($p->nome) ?></option>
            <?php } ?>
        </select>
        Dentista * : <select name="dentista_id" class="form-select" required>
            <option value="">Selecione o dentista</option>
            <?php foreach ($dentistas as $d) { ?>
                <option value="<?= $d->id ?>"><?= htmlspecialchars($d->nome) ?></option>
            <?php } ?>
        </select>
        Data e Hora * : <input name="data_hora" type="datetime-local" value="<?= date('Y-m-d\TH:i') ?>" class="form-control" required>
        Valor Total (R$) : <input name="valor_total" type="number" step="0.01" min="0" value="0.00" class="form-control">
        Valor Pago (R$) : <input name="valor_pago" type="number" step="0.01" min="0" value="0.00" class="form-control">
        Forma de Pagamento * : <select name="forma_pagamento" class="form-select" required>
            <option value="">Selecione a forma de pagamento</option>
            <?php foreach ($formas as $f) { ?>
                <option value="<?= $f ?>"><?= $f ?></option>
            <?php } ?>
        </select>
        Procedimentos Realizados : <input name="procedimentos_realizados" type="text" maxlength="255" class="form-control">
        Procedimentos a Realizar : <input name="procedimentos_arealizar" type="text" maxlength="255" class="form-control">
        Descrição : <input name="descricao" type="text" maxlength="255" class="form-control">
        Medicação : <input name="medicacao" type="text" maxlength="255" class="form-control">
        <input type="submit" value="Cadastrar" class="btn btn-primary mt-2">
    </form>
    <div class="pb-5"></div>
</main>
