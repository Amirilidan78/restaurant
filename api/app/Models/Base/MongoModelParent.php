<?php

namespace App\Models\Base;

use Illuminate\Support\Facades\App;
use Jenssegers\Mongodb\Eloquent\Model;

abstract class MongoModelParent extends Model
{

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
