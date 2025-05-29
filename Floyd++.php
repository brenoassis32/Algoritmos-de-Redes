<?php

class Grafo
{
private $V, $roteamento, $rota, $distancias, $custo, $infinito;	

public function Grafo($V)
{
	$this->V = $V; // atribui o número de vértices
	$this->infinito=10000;	

	for($i=0; $i<=$V;$i++){
		for($j=0; $j<=$V;$j++) {
			if($i==$j){
				$this->custo[$i][$j]=0;
			}else $this->custo[$i][$j]=$this->infinito;
		}
	}		
}
	// adiciona uma aresta ao grafo de v1 à v2
public function addAresta($v1, $v2, $c,$tipo)
{
	//printf(" %d",$tipo);
	if($tipo==1){
		$this->custo[$v1-1][$v2-1]=$c;
		$this->custo[$v2-1][$v1-1]=$c;
	}else $this->custo[$v1-1][$v2-1]=$c;
}

public function floyd ()
{
	$i; 
	$j; 
	$k=0;
	$lines=0;

	//Gera Rotas			
	for($k = 0; $k <= $this->V+1; $k++ )	{
		for($i = 1; $i<=$this->V+1; $i++ ){
			for($j = 1; $j<=$this->V+1; $j++ ){
				$this->rota[$i-1][$j-1] = $i;
				$this->roteamento[$i][$j][$k] = $this->rota[$i-1][$j-1];
			}
		}
	}
	//Passo1
	for($k = 0; $k <= 1; $k++ )	{
		for($i = 0; $i <= $this->V; $i++ ){
			for($j = 0; $j<= $this->V; $j++ ){
				$this->distancias[$i+1][$j+1][$k] = $this->custo[$i][$j];
			}
		}
	}


//	printf("<div id='top_content_floyd'>");	
	printf("<h2 id='l%d' name='total'>Passo 1</h2><br/>",$lines);
	$lines++;
	printf("<h3 id='l%d' name='total'>Iteração 0</h3><br/>",$lines);
	$lines++;
	for($k = 0; $k <1; $k++ )	{
	printf("<br/>");
//	printf("<h3>Iteração %d</h3><br/>",$k);
	
	//Imprime Matriz de Distâncias
	printf("<div id='dist'>");	
	printf("<table id='arestas'>");//printf("<table id='arestasD%d'>",k);
	printf("<tbody id='tab1'>");//printf("<tbody id='tabD%d'>",k);
	printf("<tr id='top'><td id='l%d' name='total' colspan='%d'>Matriz de Distâncias</td></tr>",$lines,$this->V+1);
	$lines++;
		for($i = 1; $i <= $this->V+1; $i++){
			if($k == $i){
				printf("<tr id='l%d' name='total'>",$lines);
				$lines++;
			}else{
				printf("<tr id='l%d' name='total'>",$lines);
				$lines++;
			}
			for($j = 1; $j <= $this->V+1; $j++){
				if($k == $j){
					printf("<td>");
				}else printf("<td>");
				if($this->distancias[$i][$j][$k] != $this->infinito){
					printf(" %d",$this->distancias[$i][$j][$k]);
				}else printf(" inf");
				printf("</td>");
			}
			printf("</tr>");
		}
	printf("</tbody>");
	printf("</table>");
	printf("</div>");	

	//Imprime roteamento	
	printf("<table id='arestas'>");//printf("<table id='arestasD%d'>",k);
	printf("<tbody id='tab1'>");//printf("<tbody id='tabD%d'>",k);
	printf("<tr id='top'><td id='l%d' name='total' colspan='%d'>Matriz de Roteamento</td></tr>",$lines,$this->V+1);
	$lines++;
		for($i = 1; $i <= $this->V+1; $i++){
			if($k == $i){
				printf("<tr id='l%d' name='total'>",$lines);
				$lines++;
			}else{
				printf("<tr id='l%d' name='total'>",$lines);
				$lines++;
			}
			for($j = 1; $j <= $this->V+1; $j++){
				if($k == $j){
					printf("<td>");
					printf(" %d",$this->roteamento[$i][$j][$k]);
					printf("</td>");
				}else{
					printf("<td>");
					printf(" %d",$this->roteamento[$i][$j][$k]);
					printf("</td>");
				}
			}
			printf("</tr>");
		}
	printf("</tbody>");	
	printf("</table>");
	}//printf("</div>");	


	//Passo 2	
	for($k = 1; $k <= $this->V+1; $k++ )	{
		for($i = 1; $i<=$this->V+1; $i++ ){
			for($j = 1; $j<=$this->V+1; $j++ ){
				$this->distancias[$i][$j][$k] = $this->distancias[$i][$j][$k-1];
				$this->roteamento[$i][$j][$k] = $this->roteamento[$i][$j][$k-1];
				if($this->distancias[$i][$j][$k-1] != $this->infinito){
					if($this->distancias[$i][$j][$k-1] > $this->distancias[$i][$k][$k-1] + $this->distancias[$k][$j][$k-1]) {
					$this->distancias[$i][$j][$k] = $this->distancias[$i][$k][$k-1] + $this->distancias[$k][$j][$k-1];
					$this->roteamento[$i][$j][$k]= $this->roteamento[$k][$j][$k-1];
				    }
				} else{
					if(($this->distancias[$i][$k][$k-1] == $this->infinito) || ($this->distancias[$k][$j][$k-1] == $this->infinito)){
						$this->distancias[$i][$j][$k] = $this->infinito;
					} else{
						$this->distancias[$i][$j][$k] = $this->distancias[$i][$k][$k-1] + $this->distancias[$k][$j][$k-1];
						$this->roteamento[$i][$j][$k]= $this->roteamento[$k][$j][$k-1];
					}
			    }
			}
		}
	}
	printf("<div id='body_content_floyd' class='floyd'>");
	printf("<h2 id='l%d' name='total'>Passo 2</h2><br/>",$lines);
	$lines++;
	printf("<p class='floyd'></p>");	
	for($k = 1; $k <= $this->V+1; $k++ )	{
	printf("<br/>");
	printf("<h3 id='l%d' name='total'>Iteração %d</h3><br/>",$lines,$k);
	$lines++;
	
	//Imprime Matriz de Distâncias
	printf("<table id='arestas'>");//printf("<table id='arestasD%d'>",$k);
	printf("<tbody id='tab1'>");//printf("<tbody id='tabD%d'>",k);
	printf("<tr id='top'><td id='l%d' name='total' colspan='%d'>Matriz de Distâncias</td></tr>",$lines,$this->V+1);
	$lines++;
		for($i = 1; $i <= $this->V+1; $i++){
			if($k == $i){
				printf("<tr id='l%d' name='total' style='background-color: #1ac4ff;'>",$lines);
				$lines++;
			}else{
				printf("<tr id='l%d' name='total''>",$lines);
				$lines++;
			}
			for($j = 1; $j <= $this->V+1; $j++){
				if($k == $j){
					printf("<td style='background-color: #1ac4ff;'>");
				}else printf("<td>");
				if($this->distancias[$i][$j][$k] != $this->infinito){
					printf(" %d",$this->distancias[$i][$j][$k]);
				}else printf(" inf");
				printf("</td>");
			}
			printf("</tr>");
		}
	printf("</tbody>");
	printf("</table>");

	//Imprime roteamento	
	printf("<table id='arestas'>");//printf("<table id='arestasD%d'>",k);
	printf("<tbody id='tab1'>");//printf("<tbody id='tabD%d'>",k);
	printf("<tr id='top'><td id='l%d' name='total' colspan='%d'>Matriz de Roteamento</td></tr>",$lines,$this->V+1);
	$lines++;
		for($i = 1; $i <= $this->V+1; $i++){
			if($k == $i){
				printf("<tr id='l%d' name='total' style='background-color: #1ac4ff;'>",$lines);
				$lines++;
			}else{
				printf("<tr id='l%d' name='total'>",$lines);
				$lines++;
			}
			for($j = 1; $j <= $this->V+1; $j++){
				if($k == $j){
					printf("<td style='background-color: #1ac4ff;'>");
					printf(" %d",$this->roteamento[$i][$j][$k]);
					printf("</td>");
				}else{
					printf("<td>");
					printf(" %d",$this->roteamento[$i][$j][$k]);
					printf("</td>");
				}
			}
			printf("</tr>");
		}
	printf("</tbody>");	
	printf("</table>");
	printf("<input type='hidden'  id='vertices' value='%d'>",$this->V+1);
	}printf("</div>");	
	
}
};

?>
