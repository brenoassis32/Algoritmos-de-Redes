<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
	<script type="text/javascript" src="_js/teste.js"></script>
	<script type="text/javascript" src="_js/load2.js"></script>
	<script type="text/javascript" src="_js/pdf.js"></script>
	<script type="text/javascript" src="_js/html2canvas.js"></script>
	<script type="text/javascript" src="_js/html2canvas.min.js"></script>
	<meta charset="UTF-8">
	<title>Algoritmo de PRIM</title>
</head>

<body>
<div id="wrapper">
	        
<div id="innerwrapper">
				
<div id="header">
					
<h1>Breno Assis</h1>
					
					
<ul id="nav">
						
<li>
<a href="index.html" class="active">Home</a>
</li>
						
<li>
<a href="otimizacao_em_redes.html" >Otimização em Redes</a>
</li>

<li>
<a href="filas.html" >Teoria de Filas</a>
</li>

<li>
<a href="simulacao.html" >Simulação</a>
</li>
<li>
<a href="contato.html">Contato</a>
</li>
</ul>				
<ul id="subnav">

<li>
<a href="Prim.html">Prim</a>
</li>

</ul>
				
</div>

<div id="sidebar">
                	
<h2>Acesso direto</h2>
                    
<ul class="subnav">
                        
<li>
<a href="http://lattes.cnpq.br/7026944709521992"><b>»</b>Curriculum Lattes</a>
</li>
                        
<li>
<a href="trabalhos.html"><b>»</b>Trabalhos realizados</a>
</li>
                        
</ul>
                    
                    
<h2>Downloads</h2>
                    
<ul class="subnav">
                    	
<li>
<a href=""><b>»</b>Listas</a>
</li>
                    
</ul>
                    
                    
<h2>Links</h2>
                    
<ul class="subnav">
						
<li>
<a href="https://www.linkedin.com/in/breno-assis-4431a6111/"><b>»</b>LinkedIn</a>
</li>
                        
</ul>
                
                    
</div>
				
<div id="contentnorightbar">                
                    
<?php
	require_once 'PRIM++.php';

	$v=isset($_POST["vertices"])?$_POST["vertices"]:"[não informado]";
	$conex=isset($_POST["conex"])?$_POST["conex"]:"[não informado]";
	$g=new Grafo($v-1);
	$contador1=0;
	$contador2=0;
	for($c=0;$c<=$conex-1;$c++){
		if($_POST["a1$c"]>$v || $_POST["a2$c"]>$v){
			$contador1++;
			echo "Vértice inputado maior que o número de vértices declarado, preencha os campos corretamente!<br/>";
		}else{
			$g->addAresta(isset($_POST["a1$c"])?$_POST["a1$c"]:10000,isset($_POST["a2$c"])?$_POST["a2$c"]:10000,isset($_POST["c$c"])?$_POST["c$c"]:10000);
//			if(($_POST["a1$c"]==$v) || ($_POST["a2$c"]==$v)) {$contador2++;}
			
		}
	}

	for($d=1;$d<=$v;$d++){
		for($c=0;$c<=$conex-1;$c++){
			if(($_POST["a1$c"]==$d) || ($_POST["a2$c"]==$d)) {
				$contador2=$contador2+$d;
				break;
			}		
		}
	}


	if($contador2==($v*($v+1)/2)){ //$contador1==0 && 
		$g->prim();
	}else{
		echo "Preencha os campos corretamente! O grafo está DESCONEXO!";
	}
?>
</div>

				
<button style="margin-left: 500px" id="report" type="button" onclick=genPDF_2()>Relatório JPEG</button>
<button style="margin-left: 2px" id="report2" type="button" onclick=genPDF_prim()>Relatório PDF</button>
				
<div id="footer">
					
</div>
		
            
</div>
        
</div>
	


</body>
</html>