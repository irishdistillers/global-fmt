<?php

declare(strict_types=1);

namespace GlobalFmt;

final class ScannerStatus
{
    protected static $status = [
        "MISSING" => "missing",
        "DIFFERENT" => "different",
        "OK" => "ok"
    ];

    public static function getStatusMissing()
    {
        return self::$status['MISSING'];
    }

    public static function getStatusOk()
    {
        return self::$status['OK'];
    }

    public static function getStatusDifferent()
    {
        return self::$status['DIFFERENT'];
    }
}
