<?php

namespace App\Classes;

class Expression
{
    protected $expression = '';

    public static function make()
    {
        return new static;

    }

    public function find($value)
    {
        return $this->add($this->sanitize($value));
    }

    public function then($value)
    {
        return $this->find($value);
    }

    public function anything()
    {
        return $this->add('.*');
    }

    public function maybe($value)
    {
        $value = $this->sanitize($value);
        return $this->add("(?:$value)?");
    }

    public function getRegex()
    {
        return '/' . $this->expression . '/';
    }

    public function __toString()
    {
        return $this->getRegex();
    }

    public function anythingBut($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?!$value).*?");
    }

    /*
     * protected functions
     * */

    protected function sanitize($value)
    {
        return preg_quote($value,'/');
    }

    protected function add($value)
    {
        $this->expression .= $value;

        return $this;
    }

}
