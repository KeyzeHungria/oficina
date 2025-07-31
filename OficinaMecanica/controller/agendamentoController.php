<?php
require_once "model/agendamento.php";

class agendamentoController {
    private $model;

    public function __construct(){
        $this->model = new Agendamento();
    }

    public function listar(){
        $agendamentos = $this->model->listaTodos();   
        include "view/listaragendamento.php";
    }

    public function listarCb(){
        return $this->model->listaTodos();
    }

    public function conflitoExiste($data, $horario, $idcliente, $idveiculo, $id = null){
        $horario = date('H:i:s', strtotime($horario));
        return $this->model->conflitoExiste($data, $horario, $idcliente, $idveiculo, $id);
    }

    public function intervaloConflito($data, $horario, $idcliente, $idveiculo, $id = null){
        $horarioTimestamp = strtotime($horario);
        $inicio = date('H:i:s', strtotime("-1 hour", $horarioTimestamp));
        $fim = date('H:i:s', strtotime("+1 hour", $horarioTimestamp));

        $agendamentos = $this->model->buscaPorIntervalo($data, $inicio, $fim, $idcliente, $idveiculo, $id);
        return count($agendamentos) > 0;
    }

    public function cadastrar($data, $horario, $idcliente, $idveiculo){
        $horario = date('H:i:s', strtotime($horario));
        $status_agendamento = "agendado";
        $diaSemana = date('w', strtotime($data));

        if ($diaSemana == 0) return 'domingo';
        if ($diaSemana == 6 && ($horario < '09:00:00' || $horario > '12:00:00')) return 'sabado_manha';
        if ($diaSemana < 6 && ($horario < '09:00:00' || $horario > '17:00:00')) return 'fora_horario';

        // Verifica conflito exato (mesmo cliente ou veículo no mesmo horário)
        if ($this->conflitoExiste($data, $horario, $idcliente, $idveiculo)) return 'conflito';

        // Verifica limite geral de 3 agendamentos por data+hora
        if ($this->model->countAgendamentosNoHorario($data, $horario) >= 3) return 'limite_horario';

        // Verifica intervalo para o mesmo cliente OU veículo
        if ($this->intervaloConflito($data, $horario, $idcliente, $idveiculo)) return 'intervalo_conflito';


        $this->model->cadastrar($data, $horario, $status_agendamento, $idcliente, $idveiculo);
        return true;
    }

    public function buscaId($id, $clientes, $veiculos){
        $agendamento = $this->model->listaId($id);
        include "view/formAgendamento.php";
    }

    public function alterar($id, $data, $horario, $status_agendamento, $idcliente, $idveiculo){
        $horario = date('H:i:s', strtotime($horario));
        $diaSemana = date('w', strtotime($data));

        if ($diaSemana == 0) return 'domingo';
        if ($diaSemana == 6 && ($horario < '09:00:00' || $horario > '12:00:00')) return 'sabado_manha';
        if ($diaSemana < 6 && ($horario < '09:00:00' || $horario > '17:00:00')) return 'fora_horario';

        if ($this->model->countAgendamentosNoHorario($data, $horario, $id) >= 3) return 'limite_horario';

        if ($this->intervaloConflito($data, $horario, $idcliente, $idveiculo, $id)) return 'intervalo_conflito';

        if ($this->conflitoExiste($data, $horario, $idcliente, $idveiculo, $id)) return 'conflito';

        $this->model->alterar($data, $horario, $status_agendamento, $idcliente, $idveiculo, $id);
        return true;
    }

    public function excluir($id){
    try {
        $this->model->excluir($id);
        header("Location: agendamento.php?mensagem=Agendamento excluído com sucesso.&tipo=success");
        exit;
    } catch (Exception $e) {
        header("Location: agendamento.php?mensagem=Erro ao excluir agendamento.&tipo=danger");
        exit;
    }
}

}
