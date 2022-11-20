<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Services\Sms\SmsTemplate;
use Jenssegers\Mongodb\Relations\BelongsTo;

class UserNotification extends MongoModelParent
{

    protected $casts = [
        "sms_template" => SmsTemplate::class
    ] ;

    public function user() : BelongsTo
    {
        return $this->belongsTo( User::class );
    }


}
