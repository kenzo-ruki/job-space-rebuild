<?php

namespace App\Utilities;

class FlashMessage
{
    public static function success($message)
    {
        static::message($message, 'success');
    }

    public static function error($message)
    {
        static::message($message, 'error');
    }

    public static function raw($message)
    {
        static::message($message, 'raw');
    }

    public static function message($message, $type ='message')
    {
        session()->flash('message', [
            'type' => $type,
            'text' => $message
        ]);
    }
}
