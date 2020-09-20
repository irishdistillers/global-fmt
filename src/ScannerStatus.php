<?php

declare(strict_types=1);

namespace GlobalFmt;

final class ScannerStatus
{
    /**
     * @var string[]
     */
    protected static $status = [
        "MISSING" => "missing",
        "DIFFERENT" => "different",
        "OK" => "ok"
    ];

    public static function getStatusMissing(): string
    {
        return self::$status['MISSING'];
    }

    public static function getStatusOk(): string
    {
        return self::$status['OK'];
    }

    public static function getStatusDifferent(): string
    {
        return self::$status['DIFFERENT'];
    }
}
