<?php

namespace App\Models\Base;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Jenssegers\Mongodb\Auth\User;

abstract class MongoAuthParent extends User
{
    use Notifiable ;

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);

        $this->guarded = [] ;

        if( App::runningUnitTests() )
        {
            $this->connection = "sqlite" ;
        }
        else
        {
            $this->connection = "mongo" ;
        }
    }

    protected $guarded = [] ;

}
