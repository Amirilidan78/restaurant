<?php

namespace App\Models;

use App\Models\Base\MongoAuthParent;
use App\Models\Enums\AdminRoleEnum;
use App\Models\Enums\AdminStateEnum;
use Jenssegers\Mongodb\Relations\HasMany;

class Admin extends MongoAuthParent
{

    protected $casts = [
        "state" => AdminStateEnum::class ,
        "role" => AdminRoleEnum::class ,
    ];

    public function notifications() : HasMany
    {
        return $this->hasMany( AdminNotification::class  ) ;
    }


}
