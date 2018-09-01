<?php

class MY_Validation extends CI_Validation {

   function MY_Validation()
   {
      parent::CI_Validation();
   }
   
   function set_errors($fields)
   {
      if (is_array($fields) and count($fields))
      {
         foreach($fields as $key => $val)
         {
            $error = $key.'_error';
            if (isset($this->$error) and isset($this->$key) and $this->$error != '')
            {
               $old_error = $this->$error;
               $new_error = $this->_error_prefix.sprintf($val, $this->$key).$this->_error_suffix;
               $this->error_string = str_replace($old_error, $new_error, $this->error_string);
               $this->$error = $new_error;
            }
         }
      }     
   }
   
}