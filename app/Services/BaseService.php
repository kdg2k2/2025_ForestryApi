<?php

namespace App\Services;

use App\Traits\AssetPathTraits;
use App\Traits\TryCatchTraits;
use CheckLocalTraits;

class BaseService
{
    use TryCatchTraits, AssetPathTraits, CheckLocalTraits;
}