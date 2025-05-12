<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'address',
        'service_datetime',
        'service_type',
        'payment_type',
        'status',
        'cancel_reason',
        'user_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusTextAttribute()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_COMPLETED => 'Выполнен',
            self::STATUS_CANCELLED => 'Отменен'
        ][$this->status] ?? $this->status;
    }

    public function getServiceTypeTextAttribute()
    {
        return [
            'general_cleaning' => 'Генеральная уборка',
            'deep_cleaning' => 'Глубокая уборка',
            'post_construction_cleaning' => 'Уборка после ремонта',
            'carpet_furniture_cleaning' => 'Чистка ковров и мебели'
        ][$this->service_type] ?? $this->service_type;
    }
}
