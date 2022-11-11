<?php

namespace App\Http\Resources;

trait ResourceTrait
{
    public function has( string $name ) : bool
    {
        if ( $this->resource->hasAppended($name) )
            return true ;

        return array_key_exists($name,$this->resource->getAttributes());
    }

    public function get( string $name ) : mixed
    {
        return $this->when($this->has($name), fn() => $this[$name] ) ;
    }

    public function getCallback( string $name ,$callback ) : mixed
    {
        return $this->when($this->has($name), $callback ) ;
    }

}
