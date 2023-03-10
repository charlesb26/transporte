<?php 
require_once("cabecalho.php");
?>


<style type="text/css">
    img{border-radius: 50px;
    .top50{
        margin-top: -80px;
    }
</style>

<!-- Inicio da tabela atendimento -->
<section class="search-section spad">
    <div class="container">
        
<?php

//9 Tipos de chamada -tc
$chamado1 = ' ';
$chamado2 = ' ';
$chamado3 = ' ';
$chamado4 = ' ';
$chamado5 = ' ';
$chamado6 = ' ';
$chamado7 = ' ';
$chamado8 = ' ';
$chamado9 = ' ';

$qtd1 = 0;
$qtd2 = 0;
$qtd3 = 0;
$qtd4 = 0;
$qtd5 = 0;
$qtd6 = 0;
$qtd7 = 0;
$qtd8 = 0;
$qtd9 = 0;

$tipo_chamados = [$chamado1, $chamado2, $chamado3, $chamado4, $chamado5, $chamado6, $chamado7, $chamado8, $chamado9];
$qtds = [$qtd1, $qtd2, $qtd3, $qtd4, $qtd5, $qtd6, $qtd7, $qtd8, $qtd9];

$query = $pdo->query("SELECT tipo_chamado, count(*) as qtd FROM solicitacao GROUP BY tipo_chamado order by qtd desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
    $tipo_chamados[$i] = $res[$i]['tipo_chamado'];
    $qtds[$i] = $res[$i]['qtd'];
}
//tc

//T
//3 Melhores tecnicos
$tecnico1 = ' ';
$tecnico2 = ' ';
$tecnico3 = ' ';

$qtdt1 = 0;
$qtdt2 = 0;
$qtdt3 = 0;

$nome_tecnicos = [$tecnico1, $tecnico2, $tecnico3];
$fotos = ['','',''];
$qtdts = [$qtdt1, $qtdt2, $qtdt3];

$query = $pdo->query("SELECT SUBSTRING_INDEX(usr.nome, ' ', 1) as tecnico, foto, count(*) as qtd FROM `solicitacao` sol INNER JOIN usuarios usr on sol.tecnico = usr.id group by usr.nome order by qtd desc limit 3");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
    $nome_tecnicos[$i] = $res[$i]['tecnico'];
    $fotos[$i] = $res[$i]['foto'];
    $qtdts[$i] = $res[$i]['qtd'];
}
//T


//9 Tipos de chamada -setr
$setor1 = ' ';
$setor2 = ' ';
$setor3 = ' ';
$setor4 = ' ';
$setor5 = ' ';
$setor6 = ' ';
$setor7 = ' ';
$setor8 = ' ';
$setor9 = ' ';
$setor10 = ' ';
$setor11 = ' ';
$setor12 = ' ';

$qtdr1 = 0;
$qtdr2 = 0;
$qtdr3 = 0;
$qtdr4 = 0;
$qtdr5 = 0;
$qtdr6 = 0;
$qtdr7 = 0;
$qtdr8 = 0;
$qtdr9 = 0;
$qtdr10 = 0;
$qtdr11 = 0;
$qtdr12 = 0;

$setor_chamados = [$setor1, $setor2, $setor3, $setor4, $setor5, $setor6, $setor7, $setor8, $setor9, $setor10, $setor11, $setor12];
$qtdrs = [$qtdr1, $qtdr2, $qtdr3, $qtdr4, $qtdr5, $qtdr6, $qtdr7, $qtdr8, $qtdr9, $qtdr10, $qtdr11, $qtdr12];

$query = $pdo->query("SELECT st.nome as setor, count(*) as qtd FROM solicitacao sl inner JOIN usuarios usr on sl.solicitante = usr.id inner JOIN funcionarios fn on usr.id_func = fn.id inner JOIN setor st on fn.setor = st.id GROUP by st.nome order by qtd desc limit 12");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
    $setor_chamados[$i] = $res[$i]['setor'];
    $qtdrs[$i] = $res[$i]['qtd'];
}
//setr


$query = $pdo->query("SELECT * FROM solicitacao where atendimento != 'Finalizado' ORDER BY id desc limit 15");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);



if($total_reg > 0){
?>



<table class="table table-sm table-dark top50">
          <thead class="t1-c"
          style="bg-dark;">
            <tr>
              <th scope="col">&#x27A1;</th>
              <th scope="col">Repartição</th>
              <th scope="col">Situação</th>
              <th class="esc" scope="col">Dt Solicitação</th>
              <th scope="col">Atendimento</th>
          </tr>
        </thead>
    <tbody>

        <?php 
        for($i=0; $i < $total_reg; $i++){
        foreach ($res[$i] as $key => $value){}
            $id = $res[$i]['id'];
            $solicitante = $res[$i]['solicitante'];
            $data_solicitacao = $res[$i]['data_solicitacao'];
            $tipo_chamado = $res[$i]['tipo_chamado'];
            $descricao = $res[$i]['descricao'];
            $destino = $res[$i]['destino'];
            $atendimento = $res[$i]['atendimento'];
            $tecnico = $res[$i]['tecnico'];
            $obstecnico = $res[$i]['obstecnico'];
            $data_tec = $res[$i]['data_tec'];
            

            if($atendimento == 'Aberto'){            
                $classe_linha = 'bg-danger';
            }else if($atendimento == 'Executando'){          
                $classe_linha = 'bg-warning';//
            }else if($atendimento == 'Agendado'){          
                $classe_linha = 'bg-success';
            }

        //retirar aspas do texto
        $descricao = str_replace('"', "**", $descricao);
       
        $data_tecF = date('d/m/Y H:i:s', strtotime($data_tec));
        $data_solicitacaoF = date('d/m/Y H:i:s', strtotime($data_solicitacao));

        $query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        if(@count($res2) > 0){
            $nome_solicitante = $res2[0]['nome'];
            $id_func = $res2[0]['id_func'];
        }else{
            $nome_solicitante = 'Sem Registro';
        }


        $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        if(@count($res2) > 0){            
            $id_setor = $res2[0]['setor'];
        }else{
            $id_setor = 0;
        }

        $query2 = $pdo->query("SELECT * FROM setor where id = '$id_setor'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        if(@count($res2) > 0){            
            $nome_setor = $res2[0]['nome'];
        }else{
            $nome_setor = 'Sem setor';
        }



        ?>
        <tr class="<?php echo $classe_linha ?>">
          <th scope="row">&#x27A1;</th>
          <td><font size="5"><b><?php echo $nome_setor ?></b></font></td>
          <td><font size="5"><?php echo $tipo_chamado ?></font></td>
          <td class="esc"><font size="5"><?php echo $data_solicitacao ?></font></td>
          <td><font size="5"><?php echo $atendimento ?></font></td>
        </tr>
                <?php
                    }
                ?>
    </tbody>
</table>
<?php
  }else{
      ?>
 <h3>TODOS OS CHAMADOS ATENDIDOS! &#x1F60E;</h3>

 <?php
  }?>
</div>


<br>
<br>
<div class="container" align="center">
    <h3>TÉCNICOS RANKING</h3>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <img src="sistema/painel/images/perfil/<?php echo $fotos[0] ?>" width="87px" class="mr-4">
            <h5><strong><big><?php echo $nome_tecnicos[0] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdts[0] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <img src="sistema/painel/images/perfil/<?php echo $fotos[1] ?>" width="87px" class="mr-4">
            <h5><strong><big><?php echo $nome_tecnicos[1] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdts[1] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <img src="sistema/painel/images/perfil/<?php echo $fotos[2] ?>" width="87px" class="mr-4">
            <h5><strong><big><?php echo $nome_tecnicos[2] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdts[2] ?></big></strong></h5>
        </div>
    </div>


    
</div>
<br>
<br>
<div class="container" align="center">
    <h3>TIPOS DE CHAMADOS</h3>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[0] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[0] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[1] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[1] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[2] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[2] ?></big></strong></h5>
        </div>
    </div>

<hr>
    <div class="row">
        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[3] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[3] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[4] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[4] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[5] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[5] ?></big></strong></h5>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[6] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[6] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[7] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[7] ?></big></strong></h5>
        </div>

        <div class="col-md-4">
            <h5><strong><big><?php echo $tipo_chamados[8] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtds[8] ?></big></strong></h5>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<div class="container" align="center">
    <h3>CHAMADOS POR SETOR</h3>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[0] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[0] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[1] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[1] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[2] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[2] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[3] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[3] ?></big></strong></h5>
        </div>
    </div>

<hr>
    <div class="row">

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[4] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[4] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[5] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[5] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[6] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[6] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[7] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[7] ?></big></strong></h5>
        </div>
    </div>

    <hr>
    <div class="row">

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[8] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[8] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[9] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[9] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[10] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[10] ?></big></strong></h5>
        </div>

        <div class="col-md-3">
            <h5><strong><big><?php echo $setor_chamados[11] ?></big></strong></h5>
            <h5><strong><big><?php echo $qtdrs[11] ?></big></strong></h5>
        </div>
    </div>

    <hr>
    
</div>

</section>




    <?php 
    include_once("rodape.php");
    ?> 





    <!--AJAX PARA CHAMAR O ENVIAR.PHP DO EMAIL -->
    <script type="text/javascript">
        $(document).ready(function(){

            $('#btn-enviar').click(function(event){
                $('#mensagem').addClass('text-info')
                $('#mensagem').text("Enviando!!")
                event.preventDefault();

                $.ajax({
                    url: "enviar.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function(mensagem){

                        $('#mensagem').removeClass()

                        if(mensagem.trim() === 'Enviado com Sucesso!'){

                            $('#mensagem').addClass('text-success')


                            $('#nome').val('');
                            $('#telefone').val('');
                            $('#email').val('');
                            $('#comentario').val('');

                            $('#mensagem').text(mensagem)
                        //$('#btn-fechar').click();
                        //location.reload();


                    } else {

                        $('#mensagem').addClass('text-danger')
                        $('#mensagem').text("Você precisa está com o site hospedado para fazer envio de Emails")

                    }
                    
                    

                },
                
            })
            })
        })
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script src="js/mascara.js"></script>
    <script type="text/javascript"></script>
