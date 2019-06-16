<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class AuditLogMongo extends MongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'audit_events';

    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'payload',
        'created_at'
    ];
}
