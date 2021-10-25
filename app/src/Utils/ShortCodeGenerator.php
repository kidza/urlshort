<?php

namespace App\Utils;

class ShortCodeGenerator
{
    private $chars = "abcdefghijklmnopqrstuvwxyz0123456789";

    private $shortCodeLength = 10;

    public function generateCode(): string
    {
        $generatedString = "";
        $charLength = strlen($this->chars)-1;

        for ($i=0; $i<$this->shortCodeLength; $i++) {
            $pos = rand(0,$charLength);
            $generatedString .= $this->chars[$pos];
        }
        return $generatedString;
    }
}
