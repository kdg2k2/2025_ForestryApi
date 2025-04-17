<?php

namespace App\Repositories;

use App\Traits\AssetPathTraits;
use App\Traits\PaginateTraits;

class BaseRepository
{
    use PaginateTraits, AssetPathTraits;
}
