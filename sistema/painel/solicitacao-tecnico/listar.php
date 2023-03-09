<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Executando' && tecnico = $id_usuario ORDER BY data_solicitacao desc"); //
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Solicitante</th>
	<th class="esc">Setor</th> 	
	<th class="esc">Tipo</th>
	<th class="esc">Origem</th>
	<th class="esc">Destino</th>
	<th class="esc">Data Atendimento</th>
	<th>Status</th> 	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$id = $res[$i]['id'];
		$solicitante = $res[$i]['solicitante'];		
		$tipo_chamado = $res[$i]['tipo_chamado'];
		$descricao = $res[$i]['descricao'];
		$destino = $res[$i]['destino'];
		$data_atendimento = $res[$i]['data_atendimento'];
		$atendimento = $res[$i]['atendimento'];
		$tecnico = $res[$i]['tecnico'];
		$obstecnico = $res[$i]['obstecnico'];
		$km_inicial = $res[$i]['km_inicial'];
		$km_final = $res[$i]['km_final'];

		$data_atendimentoN = date('d/m/Y H:m:s', strtotime($data_atendimento));
		
		//retirar aspas do texto do obs
		$descricao = str_replace('"', "**", $descricao);
		
		//retirar aspas do texto do obs
		$descricao = str_replace('"', "**", $destino);

		if($atendimento == 'Aberto'){
			//$icone = 'fa-check-square';
			//$titulo_link = 'Desativar Item';
			//$acao = 'Não';
			$classe_linha = 'success';
		}else if($atendimento == 'Executando'){
			//$icone = 'fa-square-o';
			//$titulo_link = 'Ativar Item';
			//$acao = 'Sim';
			$classe_linha = 'text-muted';
		}

		//Recuperar nome do solicitante da chamada
		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$id_funcionario = $res2[0]['id_func'];
			$nome_solicitante = $res2[0]['nome'];
		}else{
			$id_funcionario = '';
			$nome_solicitante = 'Sem solicitante';
		}

		//Recuperar setor do Solicitante
		$query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_funcionario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){			
			$id_setor = $res2[0]['setor'];
		}else{
			$id_setor = '';
		}

		$query2 = $pdo->query("SELECT * FROM setor where id = '$id_setor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){			
			$nome_setor = $res2[0]['nome'];
		}else{
			$nome_setor = 'Sem setor';
		}



		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td> {$nome_solicitante} </td> 
		<td class="esc"> {$nome_setor} </td> 
		<td title="{$descricao}" class="esc"> {$tipo_chamado} </td>
		<td class="esc"> {$descricao} </td>
		<td class="esc"> {$destino} </td>
		<td class="esc"> {$data_atendimento} </td>
		
		<td> {$atendimento} </td>


		<td>
		
		<big><a href="#" onclick="editar('{$id}', '{$obstecnico}','{$km_inicial}','{$km_final}')" title="Parecer Técnico"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$id}','{$nome_solicitante}','{$nome_setor}','{$tipo_chamado}', '{$descricao}', '{$destino}', '{$data_atendimento}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		</td>  
		</tr> 
		HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	</small>
	HTML;
}else{
	echo 'Não possui nenhum registro cadastrado!';
}

?>




<script type="text/javascript">


	$(document).ready( function () {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
	} );



	function editar(id, obstecnico, km_inicial, km_final){

		for (let letra of obstecnico){  				
					if (letra === '+'){
						obstecnico = obstecnico.replace(' +  + ', '\n')
					}			
				}

		
		$('#id').val(id);
		$('#obstecnico').val(obstecnico);
		$('#km_inicial').val(km_inicial);
		$('#km_final').val(km_final);
		
		$('#tituloModal').text('Parecer Técnico');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}


	function mostrar(id, nome_solicitante, nome_setor, tipo_chamado, descricao, destino, data_atendimento){	

		for (let letra of descricao){  				
			if (letra === '+'){
				descricao = descricao.replace(' +  + ', '\n')
			}			
		}
		$('#id_mostrar').text(id);
		$('#nome_solicitante_mostrar').text(nome_solicitante);
		$('#nome_setor_mostrar').text(nome_setor);
		$('#tipo_chamado_mostrar').text(tipo_chamado);
		$('#descricao_mostrar').html(descricao);
		$('#destino_mostrar').html(destino);
		$('#data_atendimento_mostrar').text(data_atendimento);

		

		$('#modalMostrar').modal('show');		
	}




	function limparCampos(){
		$('#id').val('');
		$('#obstecnico').val('');
		$('#km_inicial').val('');
		$('#km_final').val('');
	}


	

</script>



