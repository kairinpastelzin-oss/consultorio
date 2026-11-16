<?php
use App\Consulta;
use App\Paciente;
use App\Funcionario;
include('../includes/cabecalho.php');
include('../includes/menu.php');
include('../includes/rodape.php');
$id = $_GET['id'];
$consulta = Consulta::buscarPorId($id);
$pacientes = Paciente::listar();
$dentistas = Funcionario::listar("perfil = 'dentista'");
$formas = ['DINHEIRO', 'PIX', 'CARTÃO DE DEBITO', 'CARTÃO DE CREDITO'];
?>
<main class="container">
    <h1>Editar Consulta</h1>
    <form method="POST" action="/consultorio/action/action_consulta.php?action=alterar&id=<?= $id ?>">
        Paciente * : <select name="paciente_id" class="form-select" required>
            <?php foreach ($pacientes as $p) { ?>
                <option value="<?= $p->id ?>" <?= $p->id == $consulta->paciente_id ? 'selected' : '' ?>><?= htmlspecialchars($p->nome) ?></option>
            <?php } ?>
        </select>
        Dentista * : <select name="dentista_id" class="form-select" required>
            <?php foreach ($dentistas as $d) { ?>
                <option value="<?= $d->id ?>" <?= $d->id == $consulta->dentista_id ? 'selected' : '' ?>><?= htmlspecialchars($d->nome) ?></option>
            <?php } ?>
        </select>
        Data e Hora * : <input name="data_hora" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($consulta->data_hora)) ?>" class="form-control" required>
        Valor Total (R$) : <input name="valor_total" type="number" step="0.01" min="0" value="<?= $consulta->valor_total ?>" class="form-control">
        Valor Pago (R$) : <input name="valor_pago" type="number" step="0.01" min="0" value="<?= $consulta->valor_pago ?>" class="form-control">
        Forma de Pagamento * : <select name="forma_pagamento" class="form-select" required>
            <?php foreach ($formas as $f) { ?>
                <option value="<?= $f ?>" <?= $f == $consulta->forma_pagamento ? 'selected' : '' ?>><?= $f ?></option>
            <?php } ?>
        </select>
        Procedimentos Realizados : <input name="procedimentos_realizados" type="text" maxlength="255" value="<?= htmlspecialchars($consulta->procedimentos_realizados ?? '') ?>" class="form-control">
        Procedimentos a Realizar : <input name="procedimentos_arealizar" type="text" maxlength="255" value="<?= htmlspecialchars($consulta->procedimentos_arealizar ?? '') ?>" class="form-control">
        Descrição : <input name="descricao" type="text" maxlength="255" value="<?= htmlspecialchars($consulta->descricao ?? '') ?>" class="form-control">
        Medicação : <input name="medicacao" type="text" maxlength="255" value="<?= htmlspecialchars($consulta->medicacao ?? '') ?>" class="form-control">
        <input type="submit" value="Editar" class="btn btn-primary mt-2">
    </form>
    <div class="pb-5"></div>
</main>
