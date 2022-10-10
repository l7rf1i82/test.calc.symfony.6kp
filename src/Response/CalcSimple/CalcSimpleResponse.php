<?php

namespace App\Response\CalcSimple;

use App\Response\CalcSimple\CalcSimpleMessageResponse;

class CalcSimpleResponse
{
    public string $number1 = '';
    public string $number2 = '';

    public string $operation = '';
    public float $total = 0;

    public CalcSimpleMessageResponse $error;
    public CalcSimpleMessageResponse $info;

    public function __construct(CalcSimpleMessageResponse $error, CalcSimpleMessageResponse $info)
    {
        $this->error = $error;
        $this->info  = $info;
    }

    public function toArray()
    {
        return [
            'number1' => $this->number1,
            'number2' => $this->number2,
            'operation' => $this->operation,
            'total'     => $this->total,
            'error' => $this->error->toArray(),
            'info'  => $this->info->toArray(),
        ];
    }
}