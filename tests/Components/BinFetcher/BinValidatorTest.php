<?php

namespace Tests\Components\BinFetcher;

use App\Components\BinFetcher\BinValidator;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class BinValidatorTest extends TestCase
{
    protected BinValidator $validator;

    protected function setUp(): void
    {
        $this->validator = App::$facade->get(BinValidator::class);
        parent::setUp();
    }

    public function testFailedValidation()
    {
        $this->assertFalse(
            $this->validator->validate('')
        );
    }

    public function testSuccessValidation()
    {
        $this->assertTrue(
            $this->validator->validate('12141414')
        );
    }
}
