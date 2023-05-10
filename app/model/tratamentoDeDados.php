<?php 

Class Filter{

    function filterString(string $elemente): self{
        
        $this->elemente = preg_replace('/[^a-zA-Z0-9]/', '', $elemente);

        return $this;
    }

    public function getAtributtOnString(string $string, int $parametro, int $parametro1): self
    {

        $this->string = substr($string, $parametro, $parametro1);        
        
        return $this;
    }

}


?>