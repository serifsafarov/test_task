<?php

namespace Tests\Components\FeeCalculator;

use App\Components\FeeCalculator\AmountNormalizer;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class AmountNormalizerTest extends TestCase
{
    private AmountNormalizer $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = App::$facade->get(AmountNormalizer::class);

        parent::setUp();
    }

    public function testNormalize()
    {
        $result = $this->normalizer->normalize(213.17846172428);
        $this->assertEquals(
            213.18,
            $result
        );
    }
}
