<?php

namespace App\Response\CalcSimple;

class CalcSimpleMessageResponse
{
    public $show = false;
    public $text = '';

    public function __construct($show, $text)
    {
        $this->show = $show;
        $this->text = $text;
    }

    public function toArray()
    {
        return [
            'show' => $this->show,
            'text' => $this->text,
        ];
    }
}