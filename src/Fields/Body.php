<?php

namespace Vicgonvt\Press\Fields;

use Vicgonvt\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process( $type, $value, $data)
    {
        return [
            $type => MarkdownParser::parse($value),
        ];
    }
}