<?php
require_once("cabecalho.php");
?>


<style type="text/css">
    img {
        border-radius: 50px;
    }

    .top50 {
        margin-top: -80px;
    }

    .result {
        text-align: center;
        align-items: baseline;
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
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
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
        $fotos = ['', '', ''];
        $qtdts = [$qtdt1, $qtdt2, $qtdt3];

        $query = $pdo->query("SELECT SUBSTRING_INDEX(usr.nome, ' ', 1) as tecnico, foto, count(*) as qtd FROM `solicitacao` sol INNER JOIN usuarios usr on sol.tecnico = usr.id group by usr.nome order by qtd desc limit 3");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $nome_tecnicos[$i] = $res[$i]['tecnico'];
            $fotos[$i] = $res[$i]['foto'];
            $qtdts[$i] = $res[$i]['qtd'];
        }
        //T
        $qtdts_porcentagem1 = ($qtdts[0] * 100) / 500;
        $qtdts_porcentagem2 = ($qtdts[1] * 100) / 500;
        $qtdts_porcentagem3 = ($qtdts[2] * 100) / 500;

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

        $setor_foto1 = ' ';
        $setor_foto2 = ' ';
        $setor_foto3 = ' ';
        $setor_foto4 = ' ';
        $setor_foto5 = ' ';
        $setor_foto6 = ' ';
        $setor_foto7 = ' ';
        $setor_foto8 = ' ';
        $setor_foto9 = ' ';
        $setor_foto10 = ' ';
        $setor_foto11 = ' ';
        $setor_foto12 = ' ';

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
        $setor_foto = [$setor_foto1, $setor_foto2, $setor_foto3, $setor_foto4, $setor_foto5, $setor_foto6, $setor_foto7, $setor_foto8, $setor_foto9, $setor_foto10, $setor_foto11, $setor_foto12];
        $qtdrs = [$qtdr1, $qtdr2, $qtdr3, $qtdr4, $qtdr5, $qtdr6, $qtdr7, $qtdr8, $qtdr9, $qtdr10, $qtdr11, $qtdr12];

        $query = $pdo->query("SELECT st.nome as setor, st.foto, count(*) as qtd FROM solicitacao sl inner JOIN usuarios usr on sl.solicitante = usr.id inner JOIN funcionarios fn on usr.id_func = fn.id inner JOIN setor st on fn.setor = st.id GROUP by st.nome order by qtd desc limit 12");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $setor_chamados[$i] = $res[$i]['setor'];
            $setor_foto[$i] = $res[$i]['foto'];
            $qtdrs[$i] = $res[$i]['qtd'];
        }
        //setr


        $query = $pdo->query("SELECT * FROM solicitacao where atendimento != 'Finalizado' ORDER BY id desc limit 15");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);



        if ($total_reg > 0) {
        ?>

            <!--LINK CSS DOS CARDS-->
            <link rel="stylesheet" type="text/css" href="style.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" crossorigin="anonymous">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet" crossorigin="anonymous">



            <table class="table table-sm table-dark top50">
                <thead class="t1-c" style="bg-dark;">
                    <tr>
                        <th scope="col">&#x27A1;</th>
                        <th scope="col">SETOR</th>
                        <th scope="col">TIPO</th>
                        <th class="esc" scope="col">ORIGEM</th>
                        <th class="esc" scope="col">DESTINO</th>
                        <th class="esc" scope="col">DATA ATENDIMENTO</th>
                        <th class="esc" scope="col">STATUS</th>
                        <th class="esc" scope="col">MOTORISTA</th>
                    </tr>
                </thead>

                <tbody class="tabchamado">

                    <?php
                    for ($i = 0; $i < $total_reg; $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                        $id = $res[$i]['id'];
                        $solicitante = $res[$i]['solicitante'];
                        $data_atendimento = $res[$i]['data_atendimento'];
                        $tipo_chamado = $res[$i]['tipo_chamado'];
                        $descricao = $res[$i]['descricao'];
                        $destino = $res[$i]['destino'];
                        $atendimento = $res[$i]['atendimento'];
                        $tecnico = $res[$i]['tecnico'];
                        $obstecnico = $res[$i]['obstecnico'];
                        $data_tec = $res[$i]['data_tec'];

                        $data_tecF = date('d/m/y H:i:s', strtotime($data_tec));
                        $data_atendimentoF = date('d/m/Y H:i:s',  strtotime($data_atendimento));


                        if ($atendimento == 'Aberto') {
                            $classe_linha = 'bg-danger';
                        } else if ($atendimento == 'Executando') {
                            $classe_linha = 'bg-success'; //
                        } else if ($atendimento == 'Agendado') {
                            $classe_linha = 'bg-success';
                        }

                        //retirar aspas do texto
                        $descricao = str_replace('"', "**", $descricao);

                        $query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $nome_solicitante = $res2[0]['nome'];
                            $id_func = $res2[0]['id_func'];
                        } else {
                            $nome_solicitante = 'Sem Registro';
                        }


                        $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $id_setor = $res2[0]['setor'];
                        } else {
                            $id_setor = 0;
                        }

                        $query2 = $pdo->query("SELECT * FROM setor where id = '$id_setor'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $nome_setor = $res2[0]['nome'];
                        } else {
                            $nome_setor = 'Sem setor';
                        }

                        $query2 = $pdo->query("SELECT SUBSTRING_INDEX(nome, ' ', 1) as nome FROM usuarios where id = '$tecnico'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $nome_tecnico = $res2[0]['nome'];
                        } else {
                            $nome_tecnico = 'Não escalado';
                        }

                    ?>

                        <div class="result">

                            <tr class="<?php echo $classe_linha ?>">
                                <th scope="row">&#x27A1;</th>

                                <td>
                                    <font size="4"><b>
                                            <?php echo $nome_setor ?>
                                        </b></font>
                                </td>

                                <td>
                                    <font size="3">
                                        <?php echo $tipo_chamado ?>
                                    </font>
                                </td>

                                <td class="esc">
                                    <font size="3">
                                        <?php echo $descricao ?>
                                    </font>
                                </td>

                                <td class="esc">
                                    <font size="3">
                                        <?php echo $destino ?>
                                    </font>
                                </td>

                                <td class="esc">
                                    <font size="3">
                                        <?php echo date('d/m/Y H:m:s',  strtotime($data_atendimento)); ?>
                                    </font>
                                </td>

                                <td class="esc" align="center">
                                    <font size="3">
                                        <?php echo $atendimento ?>
                                    </font>
                                </td>

                                <td class="esc" align="center">
                                    <font size="3">
                                        <?php echo $nome_tecnico ?>
                                    </font>
                                </td>
                            </tr>

                        </div>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
        ?>
            <h3>TODOS OS CHAMADOS ATENDIDOS! &#x1F60E;</h3>

        <?php
        } ?>
    </div>


    <br>
    <br>

    <!-- OBS FALTA ALIMENTAR DADOS  DOS MOTORISTAS

    <div class="container" align="center">
        <style color="green"></style>
        <h3><strong>TÉCNICOS RANKING</strong></h3>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row" align="center">
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class='bx bx-wrench'></i> </div> &nbsp;&nbsp;&nbsp;
                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $nome_tecnicos[0] ?>
                                    </strong> </h5>
                            </div>
                        </div>
                        <div class="badge"> <span>Técnico 1</span> </div>
                    </div>
                    <div class="mt-5">
                        <img src="sistema/painel/images/perfil/<?php echo $fotos[0] ?>" width="200px">
                        <div class="mt-5">

                            <div class="progress progress-striped active">
                                <div class="bar green" style="width:<?php echo $qtdts_porcentagem1 ?>%;"></div>
                            </div>

                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdts[0] ?> Atendimentos <span class="text2">de 500 </span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class='bx bx-wrench'></i> </div> &nbsp;&nbsp;&nbsp;
                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $nome_tecnicos[1] ?>
                                    </strong></h5>
                            </div>
                        </div>
                        <div class="badge"> <span>Técnico 2</span> </div>
                    </div>
                    <div class="mt-5">
                        <img src="sistema/painel/images/perfil/<?php echo $fotos[1] ?>" width="200px">
                        <div class="mt-5">

                            <div class="progress progress-striped active">
                                <div class="bar green" style="width:<?php echo $qtdts_porcentagem2 ?>%;"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdts[1] ?> Atendimentos <span class="text2">de 500 </span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class='bx bx-wrench'></i> </div> &nbsp;&nbsp;&nbsp;
                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $nome_tecnicos[2] ?>
                                    </strong> </h5>
                            </div>
                        </div>
                        <div class="badge"> <span>Técnico 3</span> </div>
                    </div>
                    <div class="mt-5">
                        <img src="sistema/painel/images/perfil/<?php echo $fotos[2] ?>" width="150px">
                        <div class="mt-5">
                            <div class="progress progress-striped active">
                                <div class="bar green" style="width:<?php echo $qtdts_porcentagem3 ?>%;"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdts[2] ?> Atendimentos <span class="text2">de 500 </span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <br>
    <hr>
    <br>

    <div class="container" align="center">
        <h3><strong>RANKING DE CHAMADOS</strong></h3>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div id="chamado">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row">

                                <div class="ms-2 c-details">
                                    <h5 class="mb-0"> <strong>
                                            <?php echo $tipo_chamados[0] ?>
                                        </strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAAA8BJREFUeF7tnT2vDVEUhp9baQS5USkoJIhoRCgoEAWtXyARNFoSGl8VfoBERKPV6FCJglwJpVBpJKIhPqImOxkd1t57HWtmzX2nucWsr3mevefmJCdnL6ErFYGlVNNqWCQs2SKQMAlLRiDZuNphEpaMQLJxtcMkLBmBZONqh0lYMgLJxtUOk7BkBJKN691h64H9wHZgQ7Jnjx73C/AWeA58623eK+wYcA440tt4lec9BK4BK60cWoWV+NvA6dZGiv8jgevAxRY2rcLuAidbGijWJHADuGBGDQEtws4DN2sLK66JwAngXk1GrbBNwDtgTU1RxTQT+AxsBn5YmbXCLgFXrWK67yJwBrhjVagV9gLYZxXTfReBB8Bxq0KtsE/AslVM910Eyr+crVaFWmE/rUJ6ZZqELpsR2N+xWaSw2loVc88ypGbRmwzNgAHdQprNUkP9Qy2EoYTVA/dGSpiXYHC+hAUD97aTMC/B4HwJCwbubSdhXoLB+RIWDNzbTsK8BIPzJSwYuLedhHkJBudLWDBwbzsJ8xIMzpewYODedhLmJRicL2HBwL3tJMxLMDhfwoKBe9tJmJdgcL6EBQP3tpMwL8HgfAkLBu5tJ2FegsH5EhYM3NtOwrwEg/MlLBi4t52EeQkG50tYMHBvOwnzEgzOl7Bg4N52EuYlGJwvYcHAve0kzEswOF/CgoF720mYl2BwvoQFA/e2kzAvweB8CQsG7m0nYV6CwfmTExb8/LNsZ/6qgxkwYKlZHbMkGPxQpg8zQMJClZk+zAAJk7BQAsmamRvIDNAOC1Vu+jADJEzCQgkka2ZuIDNAOyxUuenDDBjG/Q6sDR199TUrjNdZj10r7A2wwyqm+y4Cr4FdVoVaYeXnuU9ZxXTfReAWcNaqUCvsKPDIKqb7LgKHgKdWhVphpc6z4egpq6butxMoooow82oRtgV4CWw0qyqghcAHYC9Q/ppXi7BSbDfwBCgHvenyE/gIHB4Ogquq1iqsFN05nMSzp6qDgv5G4PFwDtv7FkQ9wn7XPzicFXIA2FbzGaJlsBnGfgXKx6Py/+o+8KrnGT3Cevr9r5wrgHVURjmdqcSlviQsmT4Jk7BRCOiVOAr2/qYS1s9ulEwJGwV7f1MJ62c3SqaEjYK9v6mE9bNzZ07tW8aT+ugzqWEG1RL2jzUvYfYLYVKMJjWMdliy1SNhEmYTsCMm9Raa1DDaYclWj4RJmE3AjpjUW2hSw9jsFCFhydaAhElYMgLJxtUOk7BkBJKNqx0mYckIJBtXOyyZsF9ttaRtMQTSewAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[0] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[1] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABJxJREFUeF7tnOGxTEEQhftFgAjIABEgAkRABogAESADIkAEiAARIAMioI66fuDd7TOzZ7u2956per+2b3fP+bpnZrfenbPwaKXAWatsnWwYWLMiMDADa6ZAs3TdYQbWTIFm6brDDKyZAs3Sre6wn830YdMt07Es0DJzA2NLYMXOwPYUcHm8TMeyQO6wZpVhYAamUUDjpWylKgvkDmtWGQZmYBoFNF7KVqqyQAMdVp1Thoz57liWc1kgA8vqgvvcwHKd3GGJRtVFlCEzMAPLamT98+pqPqpqJWU7qpwNLKdmYF4S8ypZs3CH5dq5w9xheZW4w+Y1coe5w+arx3tYrt1Jd9iViLgcEdci4uI5WjzJ9QnGhnAjM2HyOc/me0R8iohvEfFVlY2iwwDmcUTcXECpcjslPwD3JiJeRARATo99gAHUg4h4uNJN00md8IOA9Twins7OcRYYYL1zR83K/nupvDXTbTPAsD8B1nl71PQMNvggug3QAI8eo8DcWbS0lOFwp40CQ2fhcOGhUwCHkbusuxFgAAVgHnoFsDS+Z9yOAPvoQwYj6ZQNYAFaOlhgOGgAGDN+LBspVTGMw6Y2f76XXiDzv84cQFhg+K71jAj8NiLuzxxXCd8dTXBIexkRt4nkHy3f0XaassDQLTeSoJ+9ZK4qhNPg1US/D8yBjgXG7F846eDE4/G/Anci4nUiDKBiWZR0GPOL9SUvhata40fxLxmMiPxmIrbDGGCsLyLvMhNmXkwyzNyZWKmf1GDJVhKMmXmxDTMvJiVGRyZW6ic1MDCGV76URYSBUVLuNmJEZMIwhc/ESv2kBu4whpc7jFJJYMRUPROGKXwmVuonNXCHMbzcYZRKAiOm6pkwTOEzsVI/qYE7jOHlDqNUambkDjOwdQUk1dFMYHW6Eg23voepoezyZ2CVagtiGZhAxEoXBlaptiCWgQlErHRhYJVqC2K1BMYkLdCm3AVz2mbmnvpJDcQ/TTFJl6stCMjoyMw99ZMaGBiFk9HRwCgpa4wMrEZnWRQDk0lZ48jAanSWRTEwmZQ1jgysRmdZlE0DYyYvU5pwJDmOd/1HUtXkCZ1lJqqcJX7YapYEU1WZDAXn6KjmbmA5tJMFNnuJ1r+SsUWUS62xYICVzZ0VB7e2sC9X7ysTm9O+cdjnGWCsr112eJk/vV2IFYd5x1mRNHywOaniZX6qgEnfcWZvEcgmz3y+VWDSWwTQqriksWJZ3CIwLId4Dzq9S3FEHGysuMjy0GMkp0PnAv8VSyLuT2QOLsP7BS4JuXdglbYG7NVyGQ0l64w4h4Y2kxM12UmjQ3bYEKx9TmS4RwktnN2OM6PRFoDhRAj9hu/j2lccbJS4OAx/zGD2wH1zYvIYsWE6jL3DF7fd4G/6lu1qcZjJV+eUwTuqnKvFOarJZ6SWz48qZwPLqRlYolF1EWXIDCxTqOHnZUVWFmhgP2jIa/gHiOk5Gti0dH89WKZjWSB3WLPKMDAD0yig8VK2UpUFcoc1qwwDMzCNAhovZStVWSCNLvZiYM1qwMAMrJkCzdJ1hxlYMwWapesOM7BmCjRL1x3WDNgvn87gbdv+0jcAAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[1] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[2] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[2] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[3] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[3] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[4] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABSFJREFUeF7tneGxTEEQhftFQAaIABEgAyJABIgAESACZCCDRwSIABkQAXXK3Cq1nj09M92zevdM1fu1vT1zz3d7pu9M731nplZKgbNSo9VgTcCK3QQCJmDFFCg2XEWYgBVToNhwFWECVkyBYsNVhAlYMQWKDVcRJmDFFCg2XEWYgBVToNhwFWECVkyBYsNVhJ0QsNtmdt/MbrS/Ypd+kOF+MjP8vTWz9yMjGIkwAHphZgCmNq4AgD1pAN1eeoEB1rmZXXb3IMN9Cnw3szs90HqACVbOzdcFrQcYIkvTYA40TI+INNq8wAAKwNTyFAAwmoh4gb1pGWHecOUZmeMDJoMX2Eel7kzK6c+R7t9kXrzAfjJH+jxEAcqDGrRhCFgID+qE8qAGAkZFjjSgPKiBgEXyoL4oD2ogYFTkSAPKgxoIWCQP6ovyoAYCRkWONKA8qIGARfKgvigPaiBgVORIA8qDGghYJA/qi/KgBouBfTCzd20TFFs1aFfbthg2oLHXdoledl0DyoMaLAL2rcFgu9U4OH15xBvRlAc1WADscztnw0GetyHSXnuNC9lRHtQgGdiPNuX1wNr0P8YjH8qDGiQDe2hmEH6kYXr8OrmmPR/p2PEdrLe3HHa7JpQHNUgEhnULCcVMe9wquEZ9eK+/1/8zM3va+yUz/hoO74AzjldemRkEn2kA/mXCgff6e7s4SmD3WgrfK8au/czNJGAd6ruKThz+8Cgwsl7AtYA5BN5MBOxvsegNRA0Skw5NicWAKekoBgzPUNc6ptCLTJXW/0PAmUxsH5PZB2ek9DM/zED6ndHw4DxS1k6XKGqQuIbBNbakEGUjW1PYS6SVshk0En1SHtQgGRjc4xgFGWMPtEdt1z5Ru4O4pjyowQJg6ALrGaZHz/EKfkx4bJG13R2UBzVYBGwbMIDhABNRh8NMNGw/XTezu+1vZs06SNh0dEp5UIPFwDqu7ShNKQ9qIGBLbwzKgxoImIDtUwDrFtavizLG7fUSV5ZKuLYzGkDUIDnCUCKAE+etUsojD5IQJCDIFJGMRDbcMCxT9fR3dCfOAIVdBsDqef7aFQvCwM/o8cquP5QMROx+HNUBJjZ9cUEzoHaFRsQB/mzNooD9oSyiCsJGTDkXTUt4PoPvmWlSwJqygIXpa6vm9awDozYz5W8C1lTHr+NXwNogj5YNCFh7ARbKq1e20ZrFkweGNHnkXCgC7kg598kDi6rbGAWIU4CeB+2TBhZR2TsKavtebwkB1r6ILLbkifMhp8MNWLWXmtGdJ2owsTUVNb3MRNlsKfdM3yPfpTyoQXFgGH5WAdEIEPYdyoMaCBjTOPRzyoMaTAALvZITcUZ5UAMBW3qrUB7UQMAEbKkCxTqjAUQNFGFLkVMe1EDABGypAsU6owFEDRRhS5FTHtRAwARsqQLFOqMBRA3aBeN4f6a4pZhuBxku3rmFYtm9zQtsprCFjUGf/1Yg9F95VDtXqngTuF6D4Y0wCDBaiVRRvNVjdh/29gDD/Apos9W1q8X43/vrqtnsAYYLF7RY/F2w0HUvsA0a6gyjfoAQK0Edb5gGUSTUVWA7AmyTZHtpMqJOKb/vRkHqDkDIuoeqs2aA+YYoq1AFBCxUznxnApavcWgPAhYqZ74zAcvXOLQHAQuVM9+ZgOVrHNqDgIXKme9MwPI1Du1BwELlzHcmYPkah/YgYKFy5jsTsHyNQ3sQsFA5850JWL7GoT0IWKic+c4ELF/j0B4ELFTOfGe/AIIG1G0M3DZfAAAAAElFTkSuQmCC" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[4] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[5] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAAA+JJREFUeF7tnO2NFDEMQH0VQCdABUAlUAJUwFEBlACVABUAnUAFIB97YgV7F9vjxI70RrpflzjJe/maKLNXwrMVgautaktlBWGbdQKEIWwzAptVlxGGsM0IbFZdRhjCNiOwWXV3GWHPROSFiDw+/WVi/iYi+vdRRD5nBp4Rq7swFfRORFTYikeFvT4JXFGeu4zOwlTWJxF56G7VsQw/ROR5V2ldhVXJulXdVlpXYTqyVk2Dd41HnR51pLV6OgpTUSqsw6PCWm1EOgr7cNoRdhCmO8eXHSpyW4eOwr5O2LpHmet2/0k084x8HYX9mtHQAzFbMWpVmRNUi7Cseq8s60Cf+Zs1q+EplUHYGCPCNmOEMISNCQxSrFxXVpZ1GIwGYISNMbZi1KoybDo26z0IQ9iIAGvYiJDh/yshrizL0PRxEtawzRghDGFjAryHxRkxwsbsWjFqVRm29Zv1HoQhbESAbf2IkOH/KyGuLMvQ9HGSXdewccvyUrRi1KoyJ8Z68eVRHu9Dkb43uhB005COwrjmdk8f6yiMi6SbCdPq6m3bp4cms+OZvzS4Lv5fKzqOMK2kfgyh0h4c5x6K8PMkS9fTVk9XYZXS2srquuk479E60t4vnB51GnzV9duwHYTdytONiH6UoAKzt/y6ddepT3enrb5UuTQXd54SPWvHtYi8GWR4KyKabusHYZvpQxjCSggwJZZgjxeKsDi7kpwIK8EeLxRhcXYlORFWgj1eKMLi7EpyIqwEe7xQhMXZleREWAn2eKEIC7AbHb4GQpqz6Gn+6MfE9CS+8jReD58PP5lniZY7focrvHGAFNYpQU4QEXZ/b0phnRIEYaZxn8I6JQjCEGYisFmilMGREoQRZuo6KaxTgiAMYSYCmyVKGRwpQRwjLOXl8YIofWkeXe3WO4ezXpwthwYprFOCOIRllnfurfpoyvIOmtL2lCAIE4Q51ydGmBOYJl/Wyy7UDWEIcxFY1llZw1xe7kyMMCdHpkQnMNawMbCU2SwlCNv6dRsuhI1HhiUFa5iF0lka1jAnMNawMbCU2SwlCGtY/zXMMgWN+5xI9Ltjy5phKT/SYUvbHqmwgiittPEYDGHORd4CjBFmoXSWhhHmBFY9uyAMYS4CTIkuXPEfuGTT4QR9IXmoszIl+sGXdlaEIcxFIDQt8B7mYnyTuHRaQBjCPARKOytrmEfVn7QI8zMznY5bwkY6LMIsZP9Jw2m9E1ppL2PT4bRVPY8jDGEeAqWzS2TR9TSOtMkEEJYMdHY4hM0mnBwfYclAZ4dD2GzCyfERlgx0djiEzSacHB9hyUBnh0PYbMLJ8X8DXMYHfOVVQ0YAAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[5] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[6] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABNRJREFUeF7tnTvMdVMQhp+/UQlxSXQUEgQFESTuNDqi1VCg0WgkKCQqjUSnISES1d9INBRuQeHaiBAd4hZBRKUik+wjEt//z+w960y+WefdzVesWTNznudbZ5/L2mefQEcrAidadatmkbBm/wQSJmHNCDRrVytMwpoRaNauVpiENSPQrF2tMAlrRqBZu1phEtaMQLN2tcIkrBmBZu1qhUlYMwLN2tUKOyBhNwH3APb3UuDsZo+9ut0/gK+A94CTwEdbGtiywi4DXgKu31JQc/4l8AbwEPDtGiZrhV0FvAmcu6aIYk9J4EfgNuDrKKM1wi4GPgTOiyZXXIjA98A1wM+R6DXCPgOujiRVzGoCrwF3RWZFhd0NvBpJqJjNBK4FPvFmR4W9AtzrJdN4isAzwKNehqiwb4ALvWQaTxH4GLjOyxAV9hdwhpdM4ykCv0defUeF/R1oJZorkGrKkCEMo5CHFJtSQ/xBDWEoYXHg2UgJyxIsni9hxcCz5SQsS7B4voQVA8+Wk7AsweL5ElYMPFtOwrIEi+dPJ+wJ4Hngl2KQVeWmEvYs8Miy5+GWSaVNI2wna/efbhtVZpQ2hbCngCePeE6aUVp7YY8BT5/mBDKbtNbC7HxlT4XeYdJuBH7zAhuMtxV2P/DiCsCfA7cDv66YcxxD2wo7H3h/2S0cBWvSbP9e55XWVphJOkRprYUdorT2wg5N2hTCdtLeAa6IntAAO6fdDNgVIV2OaYQZ8HOWy3DWSLOt43c0kjaVsEOQNp2w2aVNKWxmadMK20l7C7ALCKPHcT+nTS3sLOBdCfv//+px3PlrrxhnW11GfsoVNvPL++mEzSxruhW2RVa3TzumWWH2yf2Wj6a6fd0yhbBD+pqlvbBDktX+HHZosloLu2B5U2w/KBY9tmwRiDwFRet7cZH3s5F+3DxuwNLpkGJLrvuWHxfzIOzGt27CifQc7cGLi3CM9OPmcQP2IMxSRre5bVlZO7gRQJ6I6HiEY6QfN48bsCdhljaykTSzJzECKCrEi4twjPTj5nED9ijMUu9zq3YEkCciOh7hGOnHzeMG7FmYpd/XxRARQFEhXlyEY6QfN48bUCDsv9JG7qePAPJERMcjHCP9uHncgCJhVuZx4IWB14ZFAEWFeHERjpF+3DxuQKEwD8ra8QigtTlPFR/hGOnHzeMGNBY2SsaoPBI2imRRHgkrAj2qjISNIlmUR8KKQI8qI2GjSBblkbAi0KPKSNgokkV5JKwI9KgypcL+BM4c1bnyHEnAGNsW9dMe0U86vgTsNlQ69kfgC+BKL31UmP3K2gNeMo2nCDwHPOxliAq7E3jdS6bxFAHbGGtX7Ax5SrQkHwA3eAk1vomAiTJh7hFdYZboouV2SbanUMc4Aj8Adisq++sea4RZMrvh29u6QanLNRrw0/I7WvZNe+hYK8ySXg68vNwGMFREQUcSsJuWPgh8t4bPFmG7/LcutwW2rWiXRN5DrGlswlj7ERh7e2TnK7st8KdbHmNG2JZ6mpMkIGFJgNXTJayaeLKehCUBVk+XsGriyXoSlgRYPV3Cqokn60lYEmD1dAmrJp6sJ2FJgNXTJayaeLKehCUBVk+XsGriyXoSlgRYPV3Cqokn60lYEmD1dAmrJp6sJ2FJgNXT/wFN4Al8hEGjDAAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[6] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[7] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABEJJREFUeF7tnUvLTVEYx3/vyMDAZaBIUoqRqYGBSxJTn0AJUynkkmuRSxkYKGHiE5gpA6GIT8DIjJlLYkyrztHb2znv86y1tnU557+n67nt/289z9lnt9t7AR1dKbDQVbUqFgHrbBMImIB1pkBn5arDBKwzBTorVx0mYJ0p0Fm56jAB60yBzspVhwlYZwp0Vm5uh60CdgLbgNWdnXvpcn8AH4G3wM/U5KnADgKngH2piefc7xlwDXgXq0MssGD/ADgWm0j2ExW4CZyL0SYW2GPgSEwC2ZoK3ALOmlYjgxhgp4Hb3sCyi1LgMPDE4+EFtgH4BKzwBJVNtALfgE3Ab8vTC+wScNUKpvUsBY4DD60IXmDvgR1WMK1nKfAUOGRF8AL7Cqy1gmk9S4Hwk7PFiuAF9scKpJFpKnTZtMB+xmZIYN5Yjrpn0sSz6U0NTYORdIMkm0kM/pMaREMB8wueaylguQoW9hewwoLnphOwXAUL+wtYYcFz0wlYroKF/ecW2BpgO/C6sOC56eYWWBAunPx94CIQ7nT3cMw9sAApwArQArzWDwFbRCiMxwCu5TEpYBNaquUxKWBTZmCrY1LAjB+t1sakgDmvMloZkwLmBNbK1aSARQAbm9YckwKWAGzsUmNMClgGsBpjUsAygZUekwI2ELBSY1LABGy6AoPsjgEF9tTjTVfqytFTs/lQlGkwOutBknkVdNh56rHClL6F5anZ5GEazCgwXdbjeMzY2vIR657dOilcqfE3KbenZrOBTIMZ6bDS40/Alijg2a2lLte9g8FTs9lApkHHHVZz/KnDIjqshfEnYE5gNa7+NBIdCiz9PWht/KnDpnRYq+NPwCYAa3n8CdgSBXY1/gyigDl+11o3mev/Ya3DUYf1SMj5V2SxmXkjwzRo9E5Hj/w0EjujJmACNl2BQXZHZwIPXe4gGuo3bGgs/3nTDwlM71NcHn7Rl4N9AdaX24xzmekzsNE6c2+HvQD2WsG0nqXAc+CAFcELTC9otpTMXz8B3LPCeIGtG72keaUVUOtJCoQvRWwGvlveXmAhzkngrhVQ60kKhA83PPJ4xgAL8cJbn496AsvGrcAd4IzXOhZYsA87QV+H8Cq8vN0N4EJMqFhg49j7gfPAnphksv2nQPhYznXgTawmqcDGecKLusLnqLYC4dNUtY6wcXYbyV8BL2sVCITPUX0YQfqVWkcusNS8Q/tdAaw7CeFOTLDr+hCwzvAJmIBVUUAjsYrs6UkFLF27Kp4CVkX29KQClq5dFU8BqyJ7elIBS9euiqeAVZE9PamApWtXxVPAqsienlTA0rXL9vQ8cJmdJCJAU7fvmipmJKKALbObBMxutaY0aqoYdVhnu0fABMxWwLZoago1VYw6rLPdI2ACZitgWzQ1hZoqxtZOFgLW2R4QMAHrTIHOylWHCVhnCnRWrjpMwDpToLNy1WGdAfsLYTX9bSZLfU4AAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[7] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[8] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[8] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <br>
    <hr>
    <br>

    <div class="container" align="center">
        <h3><strong>RANKING SETOR</strong></h3>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div id="chamado">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row">

                                <div class="ms-2 c-details">
                                    <h5 class="mb-0"> <strong>
                                            <?php echo $setor_chamados[0] ?>
                                        </strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[0] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[0] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[1] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[1] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[1] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[2] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[2] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[2] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[3] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[3] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[3] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[4] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[4] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[4] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[5] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[5] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[5] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[6] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[6] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[6] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[7] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[7] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[7] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[8] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[8] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[8] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[9] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[9] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[9] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[10] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[10] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[10] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        //<?php echo $setor_chamados[11] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img src="sistema/painel/images/setores/<?php echo $setor_foto[11] ?>" width="110px">
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    //<?php echo $qtdrs[11] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <br>
    <br>
    <hr>

    <div class="rodape" text-align="center" align="center">
        <h6 class="credits">Secretaria do Trabalho e Bem Estar Social
            <p>
                UGAM-<strong>NTI</strong>
            </p>
        </h6>
    </div>

</section>

    -->




    <?php
    include_once("rodape.php");
    ?>





    <!--AJAX PARA CHAMAR O ENVIAR.PHP DO EMAIL -->
    <script type="text/javascript">
        $(document).ready(function() {

            $('#btn-enviar').click(function(event) {
                $('#mensagem').addClass('text-info')
                $('#mensagem').text("Enviando!!")
                event.preventDefault();

                $.ajax({
                    url: "enviar.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function(mensagem) {

                        $('#mensagem').removeClass()

                        if (mensagem.trim() === 'Enviado com Sucesso!') {

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