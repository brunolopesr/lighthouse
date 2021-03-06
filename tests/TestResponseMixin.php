<?php

namespace Tests;

use Closure;
use Illuminate\Foundation\Testing\TestResponse;

/**
 * @mixin \Illuminate\Foundation\Testing\TestResponse
 */
class TestResponseMixin
{
    public function jsonGet(): Closure
    {
        return function (string $key = null) {
            return data_get($this->decodeResponseJson(), $key);
        };
    }

    public function assertErrorCategory(): Closure
    {
        return function (string $category): TestResponse {
            $this->assertJson([
                'errors' => [
                    [
                        'extensions' => [
                            'category' => $category,
                        ],
                    ],
                ],
            ]);

            return $this;
        };
    }
}
