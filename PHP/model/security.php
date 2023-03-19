<?php

class Security{

    public function input_Check(string $input)
    {
        
        $this->input = $input;

        $check_arrays = str_split($this->input);

        foreach($check_arrays as $input_String){
        
            
            if(($input_String == "-")    ||
            ($input_String == "'")       || 
            ($input_String == "#")       || 
            ($input_String == "%")       || 
            ($input_String == "&")       || 
            ($input_String == "`")       || 
            ($input_String == "!")       || 
            ($input_String == "|")       || 
            ($input_String == "<")       ||
            ($input_String == "=")       ||  
            ($input_String == ">")){

                $security_stats = FALSE;

                header("Refresh: 4, url='../index.html'");
                
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