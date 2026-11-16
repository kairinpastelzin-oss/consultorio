<?php
namespace App;
use PDO;
class Consulta
{
    public $id;
    public $paciente_id;
    public $dentista_id;
    public $data_hora;
    public $valor_total;
    public $valor_pago;
    public $forma_pagamento;
    public $procedimentos_realizados;
    public $procedimentos_arealizar;
    public $descricao;
    public $medicacao;

    public $paciente_nome;
    public $dentista_nome;

    public function cadastrar()
    {
        $db = new DataBase('consulta');

        $this->id = $db->insert([
            'paciente_id' => $this->paciente_id,
            'dentista_id' => $this->dentista_id,
            'data_hora' => $this->data_hora,
            'valor_total' => $this->valor_total,
            'valor_pago' => $this->valor_pago,
            'forma_pagamento' => $this->forma_pagamento,
            'procedimentos_realizados' => $this->procedimentos_realizados,
            'procedimentos_arealizar' => $this->procedimentos_arealizar,
            'descricao' => $this->descricao,
            'medicacao' => $this->medicacao
        ]);

        return $this->id;
    }

    public function alterar()
    {
        return (new DataBase('consulta'))->update(
            'id = ' . (int) $this->id,
            [
                'paciente_id' => $this->paciente_id,
                'dentista_id' => $this->dentista_id,
                'data_hora' => $this->data_hora,
                'valor_total' => $this->valor_total,
                'valor_pago' => $this->valor_pago,
                'forma_pagamento' => $this->forma_pagamento,
                'procedimentos_realizados' => $this->procedimentos_realizados,
                'procedimentos_arealizar' => $this->procedimentos_arealizar,
                'descricao' => $this->descricao,
                'medicacao' => $this->medicacao
            ]
        );
    }

    public function excluir()
    {
        return (new DataBase('consulta'))->delete(
            'id = ' . (int) $this->id
        );
    }

    public static function listar(
        $where = null,
        $order = 'consulta.data_hora DESC',
        $limit = null
    ) {
        $tabelas = 'consulta
            INNER JOIN paciente ON consulta.paciente_id = paciente.id
            INNER JOIN funcionario ON consulta.dentista_id = funcionario.id';

        $campos = 'consulta.*,
            paciente.nome AS paciente_nome,
            funcionario.nome AS dentista_nome';

        return (new DataBase($tabelas))
            ->select($where, $order, $limit, $campos)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function buscarPorId($id)
    {
        $consulta = (new DataBase('consulta'))->select('id = ' . (int) $id)->fetchObject(self::class);
    }
}
