<?php

class Model 
{
    public function initObjectFromArray($array = []) 
    {
        foreach ($array as $key => $value) {
            $property = str_replace('_', '', lcfirst(ucwords($key, '_')));
            if (property_exists($this, $property)) {
              $this->$property = $value;
            }
        }
        
    }
    
    public function setObjectToSession($name)
    {
        foreach ($this as $property => $value) {
            $_SESSION[$name][$property] = $value;
        }
    }

}
