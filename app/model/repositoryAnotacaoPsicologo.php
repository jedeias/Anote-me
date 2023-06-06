<?php

class RepositoryAnotacaoPsicologo extends Connect{

public function save(AnotacaoPsicologo $notas, $pkPaciente){
    $query = "INSERT INTO anotacoes_psicologo 
              VALUES (DEFAULT, 
                      {$notas->getFkPsicologo()->getId()},   
                      DEFAULT, 
                      CURDATE(), 
                      CURTIME(), 
                      '{$notas->getAnotacoes()}');";

    $this->getConn()->query($query);
 
    $AnotacaoPsicologo = $this->getConn()->insert_id; 

    //$query = "UPDATE anotacoes_paciente set fk_anota";

}

}

?>