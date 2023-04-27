<?php
class Paciente extends Pessoas{

    private $responsavel;
    private $psicologo;
    private $imagem;

    public function __construct($responsavel, $psicologo, $imagem){
        $this->setResponsavel($responsavel);
        $this->setPsicologo($psicologo);
        $this->setImagem($imagem);
    }

    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function setResponsavel($responsavel): self{
        $this->responsavel = $responsavel;
        return $this;
    }

    public function getPsicologo()
    {
        return $this->psicologo;
    }

    public function setPsicologo($psicologo): self{
        $this->psicologo = $psicologo;
        return $this;
    }


	public function getImagem() {
		return $this->imagem;
	}

	public function setImagem($imagem): self {
		$this->imagem = $imagem;
		return $this;
	}
}

?>