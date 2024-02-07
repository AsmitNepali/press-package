<?php

namespace Vicgonvt\Press\Tests\Feature;

use Vicgonvt\Press\Tests\TestCase;
use Vicgonvt\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    public function test_experiment()
    {
        $this->assertEquals("<h1>heading</h1>", MarkdownParser::parse('#heading'));

    }
}