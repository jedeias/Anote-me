<?php

Class AnotacaoPsicologo{
    
    private $pk;
    private Pessoas $fkPsicologo;
    private $anotacoes;
    private $data;
    private $hora;

    public function __construct($fkPsicologo, $anotacoes) {
        $this->setFkPsicologo($fkPsicologo);
        $this->setAnotacoes($anotacoes);
    }

	public function getPk() {
		return $this->pk;
	}
	
	public function setPk($pk): self {
		$this->pk = $pk;
		return $this;
	}
	
	public function getFkPsicologo(): Pessoas {
		return $this->fkPsicologo;
	}
	
	public function setFkPsicologo(Pessoas $fkPsicologo): self {
		$this->fkPsicologo = $fkPsicologo;
		return $this;
	}
	
	
	public function getAnotacoes() {
		return $this->anotacoes;
	}
	
	public function setAnotacoes($anotacoes): self {
		$this->anotacoes = $anotacoes;
		return $this;
	}

}

?>