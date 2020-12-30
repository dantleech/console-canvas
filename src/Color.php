<?php

namespace DTL\ConsoleCanvas;

final class Color
{
    public function __construct(private string $ansiCode)
    {
    }

    public function ansiCode(): string
    {
        return $this->ansiCode;
    }

    public static function red(): self
    {
        return new self("\x1b[31;1m");
    }

    public static function green(): self
    {
        return new self("\x1b[32;1m");
    }

    public static function yellow(): self
    {
        return new self("\x1b[33;1m");
    }

    public static function blue(): self
    {
        return new self("\x1b[34;1m");
    }

    public static function magenta(): self
    {
        return new self("\x1b[35;1m");
    }

    public static function cyan(): self
    {
        return new self("\x1b[36;1m");
    }

    public static function white(): self
    {
        return new self("\x1b[37;1m");
    }

    public static function none(): self
    {
        return new self("\x1b[0m");
    }
}
