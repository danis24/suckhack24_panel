<?php

namespace App\Presenters;

interface JsonApiPresenterable{

    public function transform();

    public function entityType();
}
