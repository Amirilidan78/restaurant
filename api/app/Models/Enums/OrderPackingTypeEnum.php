<?php

namespace App\Models\Enums;

enum OrderPackingTypeEnum : string
{
    case SelfDish = "self_dish" ;
    case PlasticContainer = "plastic_container" ;

    public function text() : string
    {
        return match($this) {
            OrderPackingTypeEnum::SelfDish => "ظرف خونگی",
            OrderPackingTypeEnum::PlasticContainer => "ظرف پلاستیکی",
        };
    }
}
