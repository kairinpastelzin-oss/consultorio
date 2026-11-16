<?php
use App\Consulta;
include('../includes/cabecalho.php');
include('../includes/menu.php');
include('../includes/rodape.php');
$consultas = Consulta::listar();
?>
<main class="container-fluid px-4">
    <h1 class="text-center">Lista de Consultas</h1>
    <div class="text-end my-2">
        <a href="/consultorio/view/consulta/cadastrar.php">
            <button class="btn btn-success">Nova Consulta</button>
        </a>
    </div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Paciente</th>
                <th>Dentista</th>
                <th>Data/Hora</th>
                <th>Valor Total</th>
                <th>Valor Pago</th>
                <th>Pagamento</th>
                <th>Proc. Realizados</th>
                <th>Proc. a Realizar</th>
                <th>Descrição</th>
                <th>Medicação</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta) { ?>
                <tr>
                    <td><?= htmlspecialchars($consulta->paciente_nome) ?></td>
                    <td><?= htmlspecialchars($consulta->dentista_nome) ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($consulta->data_hora)) ?></td>
                    <td>R$ <?= number_format($consulta->valor_total, 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($consulta->valor_pago, 2, ',', '.') ?></td>
                    <td><?= $consulta->forma_pagamento ?></td>
                    <td><?= htmlspecialchars($consulta->procedimentos_realizados ?? '') ?></td>
                    <td><?= htmlspecialchars($consulta->procedimentos_arealizar ?? '') ?></td>
                    <td><?= htmlspecialchars($consulta->descricao ?? '') ?></td>
                    <td><?= htmlspecialchars($consulta->medicacao ?? '') ?></td>
                    <td><a href="editar.php?id=<?= $consulta->id ?>">
                        <button class="btn btn-primary">Editar</button></a></td>
                    <td><a href="/consultorio/action/action_consulta.php?action=excluir&id=<?= $consulta->id ?>"
                           onclick="return confirm('Deseja realmente excluir esta consulta?')">
                        <button class="btn btn-danger">Excluir</button></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="pb-5"></div>
</main>
