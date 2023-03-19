<?php

    class Host_sql{

        public function __construct(    string $host = "localhost",
                                        string $user = "root",
                                        string $password = "",
                                        string $db_name = "clinica_psicologica")
        {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->db_name = $db_name;
        }

        

    }

?>