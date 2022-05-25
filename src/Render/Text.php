<?php

namespace FineDiff\Render;

use FineDiff\Parser\Operations\OperationInterface;

class Text extends Renderer
{
    public function callback(string $opcode, string $from, int $offset, int $length): string
    {
        if ($opcode === OperationInterface::COPY || $opcode === OperationInterface::INSERT) {
            return mb_substr($from, $offset, $length);
        }

        return '';
    }
}
