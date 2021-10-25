<?php

namespace App\Message;

class CountRedirection
{
    private $urlId;

    public function __construct($urlId)
    {
        $this->urlId = $urlId;
    }

    public function getUrlId()
    {
        return $this->urlId;
    }

}
