<?php
class Security{

public function inputCheck(string $input){

    $this->input = $input;

    $check_arrays = str_split($this->input);

        foreach($check_arrays as $input_String){


            if(($input_String == "-")   ||
            ($input_String == "'")   ||
            ($input_String == "#")   ||
            ($input_String == "%")   ||
            ($input_String == "&")   ||
            ($input_String == "`")   ||
            ($input_String == "!")   ||
            ($input_String == "|")   ||
            ($input_String == "<")   ||
            ($input_String == "=")   ||
            ($input_String == ">")){

                $security_stats = FALSE;

                session_destroy();

                die(header("location: ../index.php?invalido"));
                
                break;
                
            }else{

                $security_stats = TRUE;

                continue;
            }

        }

    return $security_stats;
}

}
?>