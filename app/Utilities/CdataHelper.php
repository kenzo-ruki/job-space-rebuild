<?php

namespace App\Utilities;

class CdataHelper
{
    public static function out($data)
    {
        // See https://www.w3.org/TR/REC-xml/#dt-cdsection
        $replace = [
            '<!CDATA[' => '', // CDATA cannot be nested.
            ']]>' => ']]&gt;', // CDEnd needs to be escaped.
        ];

        if (!is_null($data)) {
            return '<![CDATA[' . str_replace(array_keys($replace), array_values($replace), $data) . ']]>';
        }
    }
}
