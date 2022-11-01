<?php

namespace App\Models;

use App\Models\Base\MongoAuthParent;

class User extends MongoAuthParent
{

    protected $visible = [
        "name" ,
        "phone" ,
        "created_at" ,
    ] ;

}
