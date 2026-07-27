<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = ['path', 'type', 'alt', 'status', 'title', 'sort_order'];

    const TYPE_IMAGE = 1;
    const TYPE_VIDEO = 2;

    const MEDIA_TYPE_ENUM = [
        self::TYPE_IMAGE => 'image',
        self::TYPE_VIDEO => 'vidoe'
    ];

    const MEDIA_TYPE_TEXTS   = [
        self::TYPE_IMAGE => 'عکس',
        self::TYPE_VIDEO => 'ویدئو'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    const MEDIA_STATUS_ENUM = [
        self::STATUS_ACTIVE => 'active',
        self::STATUS_DEACTIVE => 'deactive'
    ];

    const MEDIA_STATUS_TEXTS   = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیرفعال'
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
