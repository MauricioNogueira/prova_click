<?php

namespace App\Helpers;

use Throwable;
use Illuminate\Support\Facades\Log;

class LogError
{
    public static function registerLog(Throwable $throwable)
    {
        Log::error([
            'message' => $throwable->getMessage(),
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine()
        ]);
    }
}