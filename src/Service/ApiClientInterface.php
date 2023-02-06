<?php

namespace App\Service;

interface ApiClientInterface
{
    public function fetch(array $params = []);
}