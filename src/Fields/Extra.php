<?php

namespace Vicgonvt\Press\Fields;

class Extra
{
    public static function process($type, $value, $data)
    {
        $extra = isset($data['extra']) ? (array)json_decode($data['extra']) : [];
        return [
            'extra' => json_encode( array_merge($extra, [
                $type=> $value,
            ]))
        ];
    }
}