<?php
class Grafo
{
private $V, $custo, $c, $c1, $infinito;

// construtor
public function Grafo($V)
{
	$this->V = $V; // atribui o número de vértices
	$this->infinito=10000;

	for($i=0; $i<=$V;$i++){
		$this->c[$i]=-2;
		$this->c1[$i]=$i;
		for($j=0; $j<=$V;$j++) {
			$this->custo[$i][$j]=$this->infinito;
		}
	}		
}
	// adiciona uma aresta ao grafo de v1 à v2
public function addAresta($v1, $v2, $cus)
{
	$this->custo[$v1-1][$v2-1]=$cus;
	$this->custo[$v2-1][$v1-1]=$this->custo[$v1-1][$v2-1];
}

public function prim ()
{	
	$orig=0; 
	$p1;
	$p2;
	$lst=0;
	$st=0; 
	$n=$this->V;
	$this->c[$orig]=$orig;
	$lines=0;
	
	printf("<br/><h2  id='line%d' name='final'>Passo 1:</h2><br/>", $lines);
	$lines++;
	printf("<p  id='line%d' name='final'>LST: %d;</p>", $lines,$lst);
	$lines++;
	printf("<p  id='line%d' name='final'>C = {%d};</p>", $lines,$this->c[$orig]+1);
	$lines++;
	printf("<p  id='line%d' name='final'>C' = {", $lines);
	$lines++;
	for($t=0; $t<=$n; $t++){
		if ($this->c1[$t]==$this->c[$t]){
			if($t!=0){
				$this->c1[$t]=-$t;
			}else $this->c1[$t]=-1;
		}
		if ($this->c1[$t]==$t) {
			printf("%d ",$this->c1[$t]+1);
		}
	}printf("};</p>");
	printf("<p  id='line%d' name='final'>ST = {};</p><br/>", $lines);
	$lines++;
	$k=0;
	printf("<h2  id='line%d' name='final'>Passo 2:</h2><br/>", $lines);
	$lines++;
	$i=$orig;
	while($k!=$this->V){
		printf("<p  id='line%d' name='final'>k = %d;</p>", $lines, $k+1);
		$lines++;
		$menor=1000;
		for($t=0; $t<=$n; $t++){
			if ($this->c1[$t]==$t){
				for($j=0; $j<=$n;$j++){
					if ($this->c[$j]==$j){
						if($this->custo[$j][$t]<$menor){
							$menor=$this->custo[$j][$t];
							$p1[$k]=$j;
							$p2[$k]=$t;
							$i=$t;
						}					
					}
				}
			}
		}
		$this->c[$i]=$i;
		$this->c1[$i]=-$i;
		$lst+=$menor;
		printf("<p  id='line%d' name='final'>LST: %d;</p>", $lines,$lst);
		$lines++;
		printf("<p  id='line%d' name='final'>C = {", $lines);
		$lines++;
		for($t=0; $t<=$n; $t++){
			if ($this->c[$t]>=0) printf("%d ",$this->c[$t]+1);
		}printf("};</p>");
		printf("<p  id='line%d' name='final'>C' = {", $lines);
		$lines++;
		for($t=0; $t<=$n; $t++){
			if ($this->c1[$t]==$t) printf("%d ",$this->c1[$t]+1);
		}printf("};</p>");
		printf("<p  id='line%d' name='final'>ST: {", $lines);
		$lines++;
		for($t=0; $t<=$k;$t++){
			if($t==$k){
				printf("(%d,%d)",$p1[$t]+1,$p2[$t]+1);
			}else printf("(%d,%d); ",$p1[$t]+1,$p2[$t]+1);
		}printf("};</p><br/>");
		$k++;
	}
	printf("<input type='hidden'  id='vertices' value='%d'>",$this->V+1);
}

};

?>