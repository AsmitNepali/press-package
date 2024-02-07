<?php

namespace Vicgonvt\Press\Tests\Feature;

use Orchestra\Testbench\TestCase;
use Vicgonvt\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    public function test_experiment()
    {
        $this->assertEquals("<h1>heading</h1>", MarkdownParser::parse('#heading'));

    }
}