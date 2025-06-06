﻿<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
		<script type="text/javascript" src="_js/teste.js"></script>
		<script type="text/javascript" src="_js/load2.js"></script>
		<script type="text/javascript" src="_js/pdf.js"></script>
		<title>Algoritmo de Floyd</title>
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
							<a href="contato.html">Contato</a>
						</li>
					</ul>				

					<ul id="subnav">
						<li>
							<a href="Dijkstra.html">Dijkstra</a>
						</li>
						<li>
							<a href="Floyd.html">Floyd</a>
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
						require_once 'Floyd++.php';
						$v=isset($_POST["vertices"])?$_POST["vertices"]:"[não informado]";
						$conex=isset($_POST["conex"])?$_POST["conex"]:"[não informado]";
						$g=new Grafo($v-1);
						for($c=0;$c<$conex;$c++){
							$g->addAresta(isset($_POST["a1$c"])?$_POST["a1$c"]:10000,isset($_POST["a2$c"])?$_POST["a2$c"]:10000,isset($_POST["c$c"])?$_POST["c$c"]:10000,isset($_POST["D"])?$_POST["D"]:10000);
						}
						$g->floyd();//(isset($_POST["orig"])?$_POST["orig"]:10000,isset($_POST["dest"])?$_POST["dest"]:10000);
					?>
				</div>
				<button style="margin-left: 500px" id="report2" type="button" onclick=genPDF_floyd()>Relatório PDF</button>

				<div id="footer">
				</div>
			</div>
		</div>
	</body>
</html>
