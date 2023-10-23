<?php

use App\Components\BinFetcher\Adapters\BinListAdapter;
use App\Components\BinFetcher\BinFetcher;
use App\Components\BinFetcher\BinFetcherConfig;
use App\Components\BinFetcher\BinNormalizer;
use App\Components\BinFetcher\BinValidator;
use App\Components\BinFetcher\Converters\BinListResponseToBinResponseConverter;
use App\Components\Cache\AdapterInterface;
use App\Components\Cache\Adapters\RedisAdapter;
use App\Components\Cache\Cache;
use App\Components\Cache\CacheConfig;
use App\Components\Cache\DatetimeConverter;
use App\Components\Exchanger\Exchanger;
use App\Components\Exchanger\ExchangerConfig;
use App\Components\FeeCalculator\AmountNormalizer;
use App\Components\FeeCalculator\EUZoneDetector;
use App\Components\FeeCalculator\FeeCalculator;
use App\Components\FeeCalculator\FeeCalculatorConfig;
use App\Components\FileReader\FileReader;
use App\Components\RatesFetcher\Adapters\ExchangeRatesApiAdapter;
use App\Components\RatesFetcher\CacheTtlSelector;
use App\Components\RatesFetcher\Converters\ExchangeRatesApiResponseToExchangeRatesResponseConverter;
use App\Components\RatesFetcher\RatesFetcher;
use App\Components\RatesFetcher\RatesFetcherConfig;
use App\Components\TransactionsParser\Converters\RowToTransactionConverter;
use App\Components\TransactionsParser\JsonParser;
use App\Components\TransactionsParser\TransactionsParser;
use App\Domain\App;
use App\Domain\AppConfig\AppConfig;
use App\Domain\AppConfig\AppConfigKeyParser;
use App\Domain\AppConfig\AppConfigStore;
use App\Domain\Facade;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

define('ROOT_PATH', dirname(__FILE__, 2) . '/');

require ROOT_PATH . 'vendor/autoload.php';

$app = new App(
    facade: new Facade()
);

$app::$facade->bind(
    AppConfigStore::class,
    function () use ($app) {
        $store = new AppConfigStore();

        $store->remember(
            'bin_fetcher',
            require ROOT_PATH . 'config/bin_fetcher.php'
        );

        $store->remember(
            'cache',
            require ROOT_PATH . 'config/cache.php'
        );

        $store->remember(
            'exchanger',
            require ROOT_PATH . 'config/exchanger.php'
        );

        $store->remember(
            'fee_calculator',
            require ROOT_PATH . 'config/fee_calculator.php'
        );

        $store->remember(
            'rates_fetcher',
            require ROOT_PATH . 'config/rates_fetcher.php'
        );

        return $store;
    }
);

$app::$facade->bind(
    AppConfig::class,
    function () use ($app) {
        return new AppConfig(
            store: $app::$facade->get(AppConfigStore::class),
            parser: $app::$facade->get(AppConfigKeyParser::class)
        );
    }
);

$app::$facade->bind(
    AppConfigKeyParser::class,
    function () use ($app) {
        return new AppConfigKeyParser();
    }
);

$app::$facade->bind(
    FileReader::class,
    function () use ($app) {
        return new FileReader(
            logger: $app::$facade->get(Logger::class)
        );
    }
);

$app::$facade->bind(
    TransactionsParser::class,
    function () use ($app) {
        return new TransactionsParser(
            converter: $app::$facade->get(RowToTransactionConverter::class),
            logger: $app::$facade->get(Logger::class),
            jsonParser: $app::$facade->get(JsonParser::class)
        );
    }
);

$app::$facade->bind(
    JsonParser::class,
    function () use ($app) {
        return new JsonParser(
            logger: $app::$facade->get(Logger::class)
        );
    }
);

$app::$facade->bind(
    RowToTransactionConverter::class,
    function () {
        return new RowToTransactionConverter();
    }
);

$app::$facade->bind(
    Logger::class,
    function () {
        $logger = new Logger('default');
        $logger->pushHandler(new StreamHandler(ROOT_PATH . 'log/log.log', Level::Warning));
        $logger->pushHandler(new StreamHandler('php://stdout', Level::Info));
        return $logger;
    }
);

$app::$facade->bind(
    BinListAdapter::class,
    function () use ($app) {
        return new BinListAdapter(
            client: new Client([
                'base_uri' => 'https://lookup.binlist.net'
            ]),
            logger: $app::$facade->get(Logger::class),
            converter: $app::$facade->get(BinListResponseToBinResponseConverter::class)
        );
    }
);

$app::$facade->bind(
    BinListResponseToBinResponseConverter::class,
    function () {
        return new BinListResponseToBinResponseConverter();
    }
);

$app::$facade->bind(
    BinFetcher::class,
    function () use ($app) {
        return new BinFetcher(
            logger: $app::$facade->get(Logger::class),
            normalizer: $app::$facade->get(BinNormalizer::class),
            validator: $app::$facade->get(BinValidator::class),
            defaultAdapter: $app::$facade->get(BinListAdapter::class),
            cache: $app::$facade->get(Cache::class),
            config: $app::$facade->get(BinFetcherConfig::class)
        );
    }
);

$app::$facade->bind(
    BinNormalizer::class,
    function () {
        return new BinNormalizer();
    }
);

$app::$facade->bind(
    BinValidator::class,
    function () {
        return new BinValidator();
    }
);

$app::$facade->bind(
    RatesFetcher::class,
    function () use ($app) {
        return new RatesFetcher(
            defaultAdapter: $app::$facade->get(ExchangeRatesApiAdapter::class),
            cache: $app::$facade->get(Cache::class),
            cacheTtlSelector: $app::$facade->get(CacheTtlSelector::class),
        );
    }
);

$app::$facade->bind(
    ExchangeRatesApiAdapter::class,
    function () use ($app) {
        return new ExchangeRatesApiAdapter(
            client: new Client([
                'base_uri' => 'http://api.exchangeratesapi.io'
            ]),
            logger: $app::$facade->get(Logger::class),
            converter: $app::$facade->get(ExchangeRatesApiResponseToExchangeRatesResponseConverter::class),
            config: $app::$facade->get(RatesFetcherConfig::class)
        );
    }
);

$app::$facade->bind(
    RatesFetcherConfig::class,
    function () use ($app) {
        return new RatesFetcherConfig(
            api_key: $app::$facade->get(AppConfig::class)->get('rates_fetcher.api_key')
        );
    }
);

$app::$facade->bind(
    ExchangeRatesApiResponseToExchangeRatesResponseConverter::class,
    function () use ($app) {
        return new ExchangeRatesApiResponseToExchangeRatesResponseConverter();
    }
);

$app::$facade->bind(
    Exchanger::class,
    function () use ($app) {
        return new Exchanger(
            config: $app::$facade->get(ExchangerConfig::class)
        );
    }
);

$app::$facade->bind(
    ExchangerConfig::class,
    function () use ($app) {
        return new ExchangerConfig(
            base_currency: $app::$facade->get(AppConfig::class)->get('exchanger.base_currency')
        );
    }
);

$app::$facade->bind(
    AmountNormalizer::class,
    function () {
        return new AmountNormalizer();
    }
);

$app::$facade->bind(
    FeeCalculator::class,
    function () use ($app) {
        return new FeeCalculator(
            detector: $app::$facade->get(EUZoneDetector::class),
            config: $app::$facade->get(FeeCalculatorConfig::class),
            normalizer: $app::$facade->get(AmountNormalizer::class)
        );
    }
);

$app::$facade->bind(
    EUZoneDetector::class,
    function () use ($app) {
        return new EUZoneDetector(
            config: $app::$facade->get(FeeCalculatorConfig::class)
        );
    }
);

$app::$facade->bind(
    FeeCalculatorConfig::class,
    function () use ($app) {
        return new FeeCalculatorConfig(
            eu_zone_fee: $app::$facade->get(AppConfig::class)->get('fee_calculator.eu_zone_fee'),
            non_eu_zone_fee: $app::$facade->get(AppConfig::class)->get('fee_calculator.non_eu_zone_fee'),
            eu_zone_countries: $app::$facade->get(AppConfig::class)->get('fee_calculator.eu_zone_countries')
        );
    }
);

$app::$facade->bind(
    BinFetcherConfig::class,
    function () use ($app) {
        return new BinFetcherConfig(
            bin_result_cache_ttl: $app::$facade->get(AppConfig::class)->get('bin_fetcher.bin_result_cache_ttl')
        );
    }
);

$app::$facade->bind(
    Cache::class,
    function () use ($app) {
        return new Cache(
            adapter: $app::$facade->get(RedisAdapter::class),
            config: $app::$facade->get(CacheConfig::class),
            converter: $app::$facade->get(DatetimeConverter::class)
        );
    }
);

$app::$facade->bind(
    RedisAdapter::class,
    function () {
        return new RedisAdapter(
            client: new \Predis\Client([
                'scheme' => 'tcp',
                'host' => 'redis',
                'port' => '6379',
                'password' => '9dE5WAxZz2k5',
            ])
        );
    }
);

$app::$facade->bind(
    CacheConfig::class,
    function () use ($app) {
        return new CacheConfig(
            ttl: $app::$facade->get(AppConfig::class)->get('cache.ttl')
        );
    }
);

$app::$facade->bind(
    AdapterInterface::class,
    function () use ($app) {
        return $app::$facade->get(RedisAdapter::class);
    }
);

$app::$facade->bind(
    DatetimeConverter::class,
    function () use ($app) {
        return new DatetimeConverter(
            config: $app::$facade->get(CacheConfig::class)
        );
    }
);

$app::$facade->bind(
    CacheTtlSelector::class,
    function () use ($app) {
        return new CacheTtlSelector();
    }
);