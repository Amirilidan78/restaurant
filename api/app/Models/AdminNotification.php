<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Services\Sms\SmsTemplate;
use Jenssegers\Mongodb\Relations\BelongsTo;

class AdminNotification extends MongoModelParent
{
    protected $casts = [
        "sms_template" => SmsTemplate::class
    ] ;

    public function admin() : BelongsTo
    {
        return $this->belongsTo( Admin::class );
    }

}
