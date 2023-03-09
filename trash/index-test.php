<?php 
$min = 1;
$max = 4;
$arr = range($min,$max);

shuffle( $arr );
foreach( $arr AS $each )
{
	echo $each, '<br />';
}

//session_destroy();
//@session_start();


//Funciona perfeitamente mas precisa fechar e abrir novamente o browser após terminar os 4 sorteios no caso
/*@session_start();
$sorteio = rand(1,4);

if (isset($_SESSION["a$sorteio"])){
	while (isset($_SESSION["a$sorteio"])){
		$sorteio = rand(1,4);
	}
}else{}

$_SESSION["a$sorteio"] = $sorteio;
echo "--> " .$sorteio;*/
 ?>