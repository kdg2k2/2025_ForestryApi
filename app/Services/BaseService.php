<?php

namespace App\Services;

use App\Traits\AssetPathTraits;
use App\Traits\TryCatchTraits;

class BaseService
{
    use TryCatchTraits, AssetPathTraits;
}