<?php

namespace Vicgonvt\Press\Fields;

use Vicgonvt\Press\MarkdownParser;

class Body
{
    public static function process( $type, $value)
    {
        return [
            $type => MarkdownParser::parse($value),
        ];
    }
}