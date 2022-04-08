<?php

namespace App\Models;

use App\Models\Traits\Scope\BaseScope;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use BaseScope;
}
