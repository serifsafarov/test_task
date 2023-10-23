<?php

use App\Components\BinFetcher\Adapters\BinListAdapter;
use App\Components\BinFetcher\BinFetcher;
use App\Components\Exchanger\Exchanger;
use App\Components\Exchanger\Requests\ExchangerChangeRequest;
use App\Components\FeeCalculator\FeeCalculator;
use App\Components\FeeCalculator\Requests\FeeCalculatorCalculateFeeRequest;
use App\Components\FileReader\FileReader;
use App\Components\RatesFetcher\Adapters\ExchangeRatesApiAdapter;
use App\Components\RatesFetcher\RatesFetcher;
use App\Components\TransactionsParser\Entities\Transaction;
use App\Components\TransactionsParser\TransactionsParser;
use App\Domain\App;

require '../bootstrap/bootstrap.php';

$argv = ['asf', '../input.txt'];

/** @var TransactionsParser $transactionsParser */
$transactionsParser = App::$facade->get(TransactionsParser::class);
/** @var FileReader $fileReader */
$fileReader = App::$facade->get(FileReader::class);

$fileContents = $fileReader->getFileContents(path: ROOT_PATH . 'input.txt');
$rows = $transactionsParser->parse(text: $fileContents);

/** @var Transaction $row */
foreach ($rows as $row) {
    /** @var BinListAdapter $binListAdapter */
    $binListAdapter = App::$facade->get(BinListAdapter::class);
    /** @var BinFetcher $binFetcher */
    $binFetcher = App::$facade->get(BinFetcher::class);

    /** @var RatesFetcher $ratesFetcher */
    $ratesFetcher = App::$facade->get(RatesFetcher::class);
    /** @var ExchangeRatesApiAdapter $exchangeRatesApiAdapter */
    $exchangeRatesApiAdapter = App::$facade->get(ExchangeRatesApiAdapter::class);

    $binResponse = $binFetcher->fetch($row->getBin(), $binListAdapter);

    $exchangeRatesResponse = $ratesFetcher->fetch($exchangeRatesApiAdapter);

    /** @var Exchanger $exchanger */
    $exchanger = App::$facade->get(Exchanger::class);

    $resultAmount = $exchanger->change(
        new ExchangerChangeRequest(
            rate: $exchangeRatesResponse->getRates()[$row->getCurrency()],
            result_currency: $row->getCurrency(),
            amount: $row->getAmount()
        )
    );

    /** @var FeeCalculator $feeCalculator */
    $feeCalculator = App::$facade->get(FeeCalculator::class);

    $fee = $feeCalculator->calculateFee(
        new FeeCalculatorCalculateFeeRequest(
            amount: $resultAmount,
            country_code: $binResponse->getCountry()->getAlpha2() ?? null
        )
    );

    echo $fee;
    print "<br>";
}