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
                
                echo"<br> bad required <br>";
                
                echo"<br> We detected malicious code in your request. Please try again. <br> ";
                
                echo "<br> You can't use this character:<br>" . $input_String . "<br> ";
                
                header("Refresh: 4, url='../index.html'");
                
                $security_stats = FALSE;

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