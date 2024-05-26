<?php

namespace Tempest\Console\Highlight\LogLanguage\Patterns;

use Tempest\Console\Highlight\ConsoleTokenType;
use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenType;

final readonly class LogNamePattern implements Pattern
{
    use IsPattern;

    public function getPattern(): string
    {
        return '/^(\[.*?\]) (?<match>[\w\.]+)/';
    }

    public function getTokenType(): TokenType
    {
        return ConsoleTokenType::EM;
    }
}