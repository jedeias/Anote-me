<?php

class Login{

    public function __construct(string $email, string $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }


    public function security(string $input)
    {
        $this->input = $input;
      
        $security = new Security();

        return $security->input_Check($this->input); 
    
    }
    
    public function sql_Connect($email,$senha)
    {

        $locate = new Host_sql();
   
        $conn = new Connect($locate->host, $locate->user, $locate->password, $locate->db_name);

        $conn = new Connect("localhost","root", "","clinica_psicologica");

        $testar = $conn->query("SELECT psicologo.email, psicologo.senha FROM tipo_usuario
        LEFT JOIN psicologo ON (tipo_usuario.pk_tipo_usuario = psicologo.fk_tipo_usuario)
        UNION ALL
        SELECT paciente.email, paciente.senha FROM tipo_usuario
        LEFT JOIN paciente ON (tipo_usuario.pk_tipo_usuario = paciente.fk_tipo_usuario)
        UNION ALL
        SELECT secretario.email, secretario.senha FROM tipo_usuario
        LEFT JOIN secretario ON (tipo_usuario.pk_tipo_usuario = secretario.fk_tipo_usuario)");

        $check = mysqli_num_rows($testar);
    
        if ($check == 0){
            echo"<br> não cadastradas <br> ";
            //header("Refresh: 2; url=../index.html");
        
        }   

        $credencias = $conn->query("SELECT psicologo.email, psicologo.senha FROM tipo_usuario
        LEFT JOIN psicologo ON (tipo_usuario.pk_tipo_usuario = psicologo.fk_tipo_usuario) WHERE email='$email' AND senha='$senha'
        UNION ALL
        SELECT paciente.email, paciente.senha FROM tipo_usuario
        LEFT JOIN paciente ON (tipo_usuario.pk_tipo_usuario = paciente.fk_tipo_usuario) WHERE email='$email' AND senha='$senha'
        UNION ALL
        SELECT secretario.email, secretario.senha FROM tipo_usuario
        LEFT JOIN secretario ON (tipo_usuario.pk_tipo_usuario = secretario.fk_tipo_usuario) WHERE email='$email' AND senha='$senha'");
           
           
        $credencial = Mysqli_fetch_array($credencias);
        $email_2 = $credencial['email'];
        $senha_2 = $credencial['senha'];
        
        if($credencial['email'] == $this->email and $credencial['senha'] == $this->senha){

            header("Refresh: 0; url=../HTML/anotacoes.php");

            echo"localizado";


        }else{
        
            echo"<br>Dados invalidos tente novamente. pro favor<br>";

            header("Refresh: 0; url=../HTML/anotacoes.php");

        }

        
    }
    

}

?>