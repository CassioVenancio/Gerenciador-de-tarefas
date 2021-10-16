<?php
error_reporting(E_ALL);
ini_set ('display_errors', 1);
require_once(dirname(__FILE__, 2) . '/app-lista-tarefas/Conexao.php');
require_once(dirname(__FILE__, 2) . '/app-lista-tarefas/Tarefa_model.php');
require_once(dirname(__FILE__, 2) . '/app-lista-tarefas/Tarefa_service.php');

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
if($acao == 'inserir'){
    $conexao = new Conexao();

    $tarefa = new Tarefa();

    $tarefa->__set('tarefa', $_POST['tarefa']);
    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefaService->inserir();

    header('Location: nova_tarefa.php?inclusao=1');
}elseif($acao == 'recuperar'){
    $tarefa = new Tarefa();
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();
}elseif($acao == 'Atualizar'){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    
    if($tarefaService->atualizar()){
        if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');
        }
        
    }
    
}elseif($acao == 'remover'){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();
   
    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('location: index.php');
    }else{
        header('location: todas_tarefas.php');
    }
        


}elseif($acao == 'marcarRealizada'){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();

    
    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('location: index.php');
    }else{
        header('location: todas_tarefas.php');
    }
        
    

}elseif($acao == 'recuperarPendente'){
    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperarPendente();
}

