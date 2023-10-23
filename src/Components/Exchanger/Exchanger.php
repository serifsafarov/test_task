<?php

namespace App\Components\Exchanger;

use App\Components\Exchanger\Requests\ExchangerChangeRequest;

readonly class Exchanger
{
    public function __construct(
        private ExchangerConfig $config
    )
    {
    }

    public function change(ExchangerChangeRequest $request): float
    {
        $res = $request->getAmount();
        if (
            $request->getResultCurrency() !== $this->config->getBaseCurrency() &&
            !empty($request->getRate())
        ){
            $res /= $request->getRate();
        }
        return $res;
    }
}