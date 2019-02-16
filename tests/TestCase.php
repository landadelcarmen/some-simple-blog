<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        TestResponse::macro('data', function($key) {

            return $this->original->getData()[$key];

        });

        Collection::macro('assertEquals', function($items) {

            Assert::assertCount($this->count(), $items);

            $this->zip($items)->each( function($itemPair) {
                Assert::assertTrue($itemPair[0]->is($itemPair[1]));
            });

        });
    }
}
