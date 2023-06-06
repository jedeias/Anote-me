<?php

class Crud extends Connect implements CrudController{

    public function insert_atividades_paciente($fk_paciente, $fk_psicologo, $assunto, $atividade){
        $sql = "INSERT INTO atividades_paciente(
            pk_atividades_paciente,
            fk_paciente,
            fk_psicologo,
            assunto_atividade,
            atividade,
            data)
            VALUES (
            DEFAULT,
            $fk_paciente,
            $fk_psicologo,
            '$assunto',
            '$atividade',
            CURDATE()
            )";

        $this->query($sql);
}

    public function insert_notas_paciente($id, $idPsicologo, $emocao, $emocaoGrau, $descricao) {

        $sql = "INSERT INTO anotacoes_paciente (
            pk_anotacoes_paciente,
            redflag,
            fk_paciente,
            fk_psicologo,
            anotacao,
            emocao,
            intensidade,
            data,
            hora
        ) 
        VALUES (
            null,
            '1',
            $id,
            '$idPsicologo',
            '$descricao',
            '$emocao',
            '$emocaoGrau',
            CURDATE(),
            DATE_FORMAT(NOW(), '%k:%i')
        )";
    
        $this->query($sql);
    }

    public function delete_atividades_paciente($pk_ativdades_paciente){

        $sql = "DELETE FROM atividades_paciente WHERE atividades_paciente.pk_atividades_paciente = '$pk_ativdades_paciente'";

        $this->query($sql);
    }

    public function delete_anotacao_paciente($pk_anotacoes_paciente){
        $sql = "DELETE FROM anotacoes_paciente WHERE anotacoes_paciente.pk_anotacoes_paciente = '$pk_anotacoes_paciente'";

        $this->query($sql);
    }

    // atualizar a imagem do perfil do usuario de acordo com a tabela
    public function atualizar_imagem($tabela, $imagem, $id){

        $stmt = $this->getConn()->prepare("SELECT * FROM $tabela WHERE $tabela.pk_$tabela = ?");
        if (!$stmt) {

            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {

            return false;
        }
    
        $stmt = $this->getConn()->prepare("UPDATE $tabela SET imagem = ? WHERE $tabela.pk_$tabela = ?");
        if (!$stmt) {
            // Se a preparação da consulta falhar, mostre o erro do MySQLi
            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("si",$imagem, $id);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }  
    }

    public function atualizar_perfil($tabela, $nome, $email, $senha, $id){
        $stmt = $this->getConn()->prepare("UPDATE $tabela SET nome = ?, email = ?, senha = ? WHERE pk_$tabela = ?");
        if (!$stmt) {
            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("sssi", $nome, $email, $senha, $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertNotaPsicologo($noteId, $psiId, $comentario, $redFlagCor){
        $inserteNota = "INSERT INTO anotacoes_psicologo (fk_anotacoes_paciente, fk_psicologo, comentario) VALUES ('$noteId', '$psiId', '$comentario')";
        $updateRedFlag = "UPDATE anotacoes_paciente SET redflag='$redFlagCor' WHERE pk_anotacoes_paciente = '$noteId'";
        $this->query($inserteNota);
        $this->query($updateRedFlag);

    }

    public function atualizarNotaPsicologo($noteId, $comentario, $redFlagCor){
        $atualizarNota = "UPDATE anotacoes_psicologo SET comentario = '$comentario' WHERE fk_anotacoes_paciente = '$noteId'";
        $updateRedFlag = "UPDATE anotacoes_paciente SET redflag='$redFlagCor' WHERE pk_anotacoes_paciente = '$noteId'";
        $this->query($atualizarNota);
        $this->query($updateRedFlag);
    }

    function insertPaciente($dados) {

        require_once("tratamentoDeDados.php");

        $filter = new Filter();

        $cep = $filter->filterString($dados["cep"]);

        $enderecoQuery = "INSERT INTO endereco (rua, numero, bairro, cep, cidade, estado, complemento) 
                  VALUES ('{$dados['rua']}', '{$dados['casaNum']}', '{$dados['bairro']}', '{$cep->elemente}', 
                          '{$dados['cidade']}', '{$dados['estado']}', '{$dados['complemento']}')";

        if (!$this->query($enderecoQuery)) {
            die("Erro na query: " . mysqli_error($this->getConn()));
        }

        $telefone = $filter->filterString($dados["telefone"]); 

        $telefone = $filter->getAtributtOnString($telefone->elemente, 2, 9);

        $ddd = $filter->getAtributtOnString($dados["telefone"], 1, 2);


        $fk_endereco = $this->getConn()->insert_id; // Pega o ID do endereço inserido

        $telefoneQuery = "INSERT INTO telefone (fk_tipo_telefone, ddd, numero, ddi)
                           VALUES (1, '{$ddd->string}', '{$telefone->elemente}', 55)";
        if (!$this->query($telefoneQuery)) {
            die("Erro na query: " . mysqli_error($this->getConn()));
        }

        $fk_telefone = $this->getConn()->insert_id; // Pega o ID do telefone inserido

        if(isset($dados['responsavelBox'])) {

            $resCPF = $filter->filterString($dados["resCPF"]);

            $responsavelQuery = "INSERT INTO responsavel (fk_endereco, fk_telefone, fk_tipo_usuario, nome, email, RG, CPF) 
                                 VALUES ('$fk_endereco', '$fk_telefone', 3, '{$dados['resNome']} {$dados['resSobrenome']}', '{$dados['resEmail']}', '{$dados['resRG']}', '{$resCPF->elemente}')";
            if (!$this->query($responsavelQuery)) {
                die("Erro na query: " . mysqli_error($this->getConn()));
            }
                

            $fk_responsavel = $this->getConn()->insert_id; 
        } else {

            $fk_responsavel = null;

        }
            $CPF = $filter->filterString($dados["CPF"]);
        
            $pacienteQuery = "INSERT INTO paciente (fk_endereco, fk_telefone, fk_tipo_usuario, fk_responsavel, fk_psicologo, nome, email, senha, RG, CPF, sexo, data_nasc) 
                            VALUES ('$fk_endereco', '$fk_telefone', 3, null, '{$dados['psicologoResponsavel']}','{$dados['nome']} {$dados['sobrenome']}', '{$dados['email']}', '{$dados['senha']}', '{$dados['RG']}', '{$CPF->elemente}', '{$dados['sexo']}', '{$dados['data-nasc']}' )";
            if (!$this->query($pacienteQuery)) {
                die("Erro na query: " . mysqli_error($this->getConn()));
            }
            
            $fk_paciente = $this->getConn()->insert_id; // Pega o ID do paciente inserido
        return $fk_paciente;
        
    }

    public function insertPsicologo($dados){

        require_once("tratamentoDeDados.php");

        $filter = new Filter();

        $cep = $filter->filterString($dados["cep"]);

        $enderecoQuery = "INSERT INTO endereco (rua, numero, bairro, cep, cidade, estado, complemento) 
                  VALUES ('{$dados['rua']}', '{$dados['casaNum']}', '{$dados['bairro']}', '{$cep->elemente}', 
                          '{$dados['cidade']}', '{$dados['estado']}', '{$dados['complemento']}')";

        if (!$this->query($enderecoQuery)) {
            die("Erro na query: " . mysqli_error($this->getConn()));
        }

        $telefone = $filter->filterString($dados["telefone"]); 

        $telefone = $filter->getAtributtOnString($telefone->elemente, 2, 9);

        $ddd = $filter->getAtributtOnString($dados["telefone"], 1, 2);


        $fk_endereco = $this->getConn()->insert_id; // Pega o ID do endereço inserido

        $telefoneQuery = "INSERT INTO telefone (fk_tipo_telefone, ddd, numero, ddi)
                           VALUES (1, '{$ddd->string}', '{$telefone->elemente}', 55)";
        if (!$this->query($telefoneQuery)) {
            die("Erro na query: " . mysqli_error($this->getConn()));
        }

        $fk_telefone = $this->getConn()->insert_id; // Pega o ID do telefone inserido

        $CPF = $filter->filterString($dados["CPF"]);
        
        $psicologoQuery = "INSERT INTO psicologo (fk_endereco, fk_telefone, fk_tipo_usuario, nome, email, senha, RG, CPF, sexo, data_nasc) 
                          VALUES ('$fk_endereco', '$fk_telefone', 1,'{$dados['nome']} {$dados['sobrenome']}', '{$dados['email']}', '{$dados['senha']}', '{$dados['RG']}', '{$CPF->elemente}', '{$dados['sexo']}', '{$dados['data-nasc']}' )";
        if (!$this->query($psicologoQuery)) {
            die("Erro na query: " . mysqli_error($this->getConn()));
        }
        
        $fk_psicologo = $this->getConn()->insert_id; // Pega o ID do psicologo inserido
        
        return $fk_psicologo;
    }

    public function notificacaoLida($pk_paciente){
        $sql = "UPDATE consulta SET lida = 1 WHERE fk_paciente = $pk_paciente ORDER BY id DESC LIMIT 1";

        $this->query($sql);
    }

    public function update_psicologo_paciente($pk_paciente, $fk_psicologo){
        $sql = "UPDATE paciente SET fk_psicologo = $fk_psicologo WHERE pk_paciente = $pk_paciente";

        $this->query($sql);
    }

}

?>