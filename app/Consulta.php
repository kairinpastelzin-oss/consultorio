<?php
namespace App;
use PDO;
class Consulta
{
    public $id;
    public $paciente;
    public $dentista;
    public $data_hora;
    public $valor_total;
    public $valor_pago;
    public $forma_pagamento;
    public $procedimentos_realizados;
    public $procedimentos_arealizar;
    public $descricao;
    public $medicacao;

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

    public static function listar($where = null, $order = null, $limit = null)
    {
        $consultas = (new DataBase('consulta'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS);
        foreach ($consultas as $consulta) {
            $consulta->paciente = Paciente::buscarPorId($consulta->paciente_id);
            $consulta->dentista = Funcionario::buscarPorId($consulta->dentista_id);
        }
        return $consultas;
    }

    public static function buscarPorId($id)
    {
        $consulta = (new DataBase('consulta'))->select('id = ' . (int) $id)->fetchObject(self::class);
        $consulta->paciente = Paciente::buscarPorId($consulta->paciente_id);
        $consulta->dentista = Funcionario::buscarPorId($consulta->dentista_id);
        return $consulta;
    }
}
