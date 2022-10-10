<?php

namespace App\Service;

use App\Response\CalcSimple\CalcSimpleResponse;
use Symfony\Component\HttpFoundation\Request;

class CalcSimple
{
    private string $number1;
    private string $number2;
    private string $operation;

    public function setRequest(Request $request)
    {
        $this->number1 = $request->request->get('number1');
        $this->number2 = $request->request->get('number2');
        $this->operation = $request->request->get('operation');
    }

    public function setResponse(CalcSimpleResponse &$response)
    {
        $response->total   = $this->getTotal($response);
        $response->number1 = $this->number1;
        $response->number2 = $this->number2;
        $response->operation = $this->operation;
    }

    private function getTotal(&$response): float
    {
        $total = 0;

        if(!$this->isNumeric($response))
        {
            return $total;
        }

        switch ($this->operation)
        {
            case 'plus':
                $total = $this->plus();
                break;
            case 'minus':
                $total = $this->minus();
                break;
            case 'times':
                $total = $this->times();
                break;
            case 'divided by':
                $total = $this->devidedBy();
                break;
            default:
                $total = 0;
                break;
        }

        return $total;
    }

    private function isNumeric(&$response)
    {
        if (!is_numeric($this->number1) || !is_numeric($this->number2))
        {
            $response->error->show = true;
            $response->error->text = 'Numeric values are required';
            return false;
        }

            $this->number1 = (float)$this->number1;
            $this->number2 = (float)$this->number2;
            return true;
    }

    private function plus(): float
    {
        return $this->number1 + $this->number2;
    }

    private function minus(): float
    {
        return $this->number1 - $this->number2;
    }

    private function times(): float
    {
        return $this->number1 * $this->number2;
    }

    private function devidedBy(): float
    {
        if($this->number2 == 0)
        {
            return 0;
        }
        return $this->number1 / $this->number2;
    }
}