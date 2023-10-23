<?php

namespace Tests\Components\BinFetcher;

use App\Components\BinFetcher\BinNormalizer;
use App\Components\BinFetcher\BinValidator;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class BinNormalizerTest extends TestCase
{
    protected BinNormalizer $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = App::$facade->get(BinNormalizer::class);
        parent::setUp();
    }

    public function testNormalize(){
        $this->assertEquals(
            '12414125',
            $this->normalizer->normalize(' 12414125    ')
        );
    }
}
