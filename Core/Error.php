<?php

namespace Core;

class Error
{
    protected $errors = [];

    public function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }

    public function pluckError($key) 
    {
        $val = $this->errors[$key];
        unset($this->errors[$key]);
        return $val;
    }

    public function hasError($key)
    {
        return isset($this->errors[$key]);
    }

    public function hasAnyError()
    {
        return !empty($this->errors);
    }

    public function clean()
    {
        $this->errors = [];
    }
}