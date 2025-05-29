<?php

class Grafo
{
private $V;

private $custo;

private $d,$p, $ultimo, $rotulado, $nrotulado, $infinito;

public function Grafo($V)
{
	$this->V = $V;
	$this->infinito=10000000000;
	for($i=0; $i<$V+1;$i++){
		$this->rotulado[$i]=-2;
		$this->nrotulado[$i]=$i;
		for($j=0; $j<=$V;$j++) {
			$this->custo[$i][$j]=$this->infinito;
//			if($i==$j) $this->custo[$i][$j]=0;
		}
	}		
}

public function addAresta($v1, $v2, $c,$tipo)
{
	if($tipo==1){
		$this->custo[$v1-1][$v2-1]=$c;
		$this->custo[$v2-1][$v1-1]=$c;
	}else $this->custo[$v1-1][$v2-1]=$c;
}

public function dijkstra($orig,$dest)
{
	$orig=$orig-1;
	$dest=$dest-1;
	$n=$this->V+1;
	$contador=0;
	$k=1;
	$r=0;
	$lines=4;
	//Passo 1:	
	printf("<br/><h2 id='l0' name='final'>Passo 1:</h2><br/>");
	$this->rotulado[$orig]=$orig;
	$this->d[$orig]=0;
	$this->p[$orig]=0;
	$this->ultimo=$orig;
	printf("<br/><p id='l1' name='final'>R = {%d};</p>",$this->rotulado[$orig]+1);
	printf("<p id='l2' name='final'>NR = {");
	for($t=0; $t<$n; $t++){
		if ($this->nrotulado[$t]==$this->ultimo){
			if($t!=0){
				$this->nrotulado[$t]=-$t;
			}else $this->nrotulado[$t]=-1;
		}
		if ($this->nrotulado[$t]==$t) {
			printf("%d ",$this->nrotulado[$t]+1);
			$this->d[$t]=$this->infinito;
			$this->p[$t]=$n+1;
		}
	}printf("}</p>");
	printf("<p id='l3' name='final'>d(%d) = %d; &#09",$orig+1,$this->d[$orig]);
	printf("p(%d) =; %d;</p>",$orig+1,$this->p[$orig]);
	for($t=1; $t<$n; $t++){
                printf("<p id='l%d' name='final'>d(%d) = +inf; &#09", $lines,$t+1);
                printf("p(%d) = %d;</p>",$t+1,$this->V+2);
		$lines++;
		}
	printf("<p id='l%d' name='final'>último = %d;</p><br/><br/>",$lines,$this->ultimo+1);
	$lines++;
	$soma=0;
	//Passo 2:
	while($this->ultimo != $dest){  //$this->nrotulado[$dest]==$dest ||
	printf("<h2 id='l%d' name='final'>Passo 2:</h2><br/><br/>",$lines);
	$lines++;
	printf("<p id='l%d' name='final'>k=%d;</p>",$lines,$k);
	$lines++;
	$candidato=$orig;
	$cand=10000000;
	for($t=0; $t<$n; $t++){
		if($t==$this->nrotulado[$t]){
			if( $this->d[$t] <= ($this->d[$this->ultimo] + $this->custo[$this->ultimo][$t])){
				if($this->d[$t]==$this->infinito){
					printf("<p id='l%d' name='final'>d(%d) = +inf;</p>",$lines,$t+1);
					$lines++;

				}else{
					printf("<p id='l%d' name='final'>d(%d) = %d;    </p>",$lines,$t+1,$this->d[$t]);
					$lines++;
				}
			}else{
				$this->d[$t]=$this->d[$this->ultimo] + $this->custo[$this->ultimo][$t];
				printf("<p id='l%d' name='final'>d(%d) = %d;    ",$lines,$t+1,$this->d[$t]);
				$lines++;
				if($this->d[$t]<$this->infinito){
					$this->p[$t]=$this->ultimo+1;
					printf("p(%d) = %d;</p>",$t+1,$this->p[$t]);
				}printf("</p>");
			}
			if($this->d[$t]<$cand){
			$cand=$this->d[$t];
			$candidato=$t;
			}
		}
	}
	if($candidato!=0){
		$this->nrotulado[$candidato]=-$candidato;
		$this->rotulado[$candidato]=$candidato;
		$r++;
	}else{
		$this->nrotulado[$candidato]=-1;
		$this->rotulado[$candidato]=0;
		$r++;
	}
	$this->d[$candidato]=$cand;
	$this->ultimo=$candidato;

	printf("<p id='l%d' name='final'>R = {",$lines);
	$lines++;
	for($t=0; $t<$n; $t++){
		if ($this->rotulado[$t]>=0) printf("%d ",$this->rotulado[$t]+1);
	}printf("}<br/>");
	printf("<p id='l%d' name='final'>NR = {",$lines);
	$lines++;
	for($t=0; $t<$n; $t++){
		if ($this->nrotulado[$t]==$t) printf("%d ",$this->nrotulado[$t]+1);
	}printf("}</p>");
	printf("<p id='l%d' name='final'>último = %d;</p>",$lines,$this->ultimo+1);
	$lines++;

	if($this->d[$this->ultimo]<$cand){
		printf("<p id='l%d' name='final'>d(%d) = %d;</p><br/>",$lines,$this->ultimo+1,$this->d[$this->ultimo]);
		$lines++;
		printf("<p id='l%d' name='final'>p(%d) = %d;</p><br/>",$lines,$this->ultimo+1,$this->p[$this->ultimo]);
		$lines++;
		printf("<p id='l%d' name='final'>último = %d;</p><br/><br/>",$lines,$this->ultimo+1);
		$lines++;
	}else printf("<br/>");
	//Passo 3
	printf("<br/><br/><h2 id='l%d' name='final'>Passo 3:</h2><br/><br/>",$lines);
	$lines++;
	if($this->ultimo != $dest){
		printf("<p id='l%d' name='final'>Nodo %d não rotulado. Retorne ao Passo 2</p><br/><br/>",$lines,$dest+1);
		$lines++;
	}else{
		printf("<p id='l%d' name='final'>Nodo %d rotulado. PARE! Recuperando o caminho ótimo: </p><br/><br/>",$lines,$dest+1);
		$lines++;
	}

	$k++;
	}

	if($this->nrotulado[$dest]==-$dest ){//$this->verif[$dest]==false
		$i=$dest;
		$c=0;
		while($i!=$orig){
			$v1[$c]=$this->p[$i];
			$v2[$c]=$i+1;
			printf("<p id='l%d' name='final'> p(%d) = %d; </p>",$lines,$i+1,$this->p[$i]);
			$lines++;
			$i=$this->p[$i]-1;
			$c++;		
		}printf("<br/><br/>");

		printf("<p id='l%d' name='final'>O caminho mínimo do nó %d ao nó %d e dado por:</p><br/>",$lines,$orig+1,$dest+1);
		$lines++;
		$i=$dest;
		printf("<p id='l%d' name='final' value='%d'>C = {",$lines,$lines);
		$lines++;
		for($t=$c-1; $t>=0; $t--){
			if($v2[$t]==$dest+1){
				printf("(%d,%d)",$v1[$t],$v2[$t]);
			}else printf("(%d,%d);",$v1[$t],$v2[$t]);		
		}printf("} = %d</p><br/><br/>",$this->d[$dest]);
	}else{
		printf("<p id='l%d' name='final' value='%d'>Não há caminho disponível entre o nó de origem %d e o de destino %d</p><br/>",$lines,$lines,$orig+1,$dest+1);
		$lines++;
	}
}
}

?>