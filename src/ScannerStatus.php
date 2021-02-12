<?php

declare(strict_types=1);

namespace Templateschecker;

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

    /**
     * @return array<string>
     */
    public static function getAll(): array
    {
        return array_values(self::$status);
    }

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
