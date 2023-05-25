<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_percentage',
        'start_date',
        'end_date',
        'usage_limit',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    public static function validationRules(Coupon $coupon = null)
    {
        $uniqueCode = Rule::unique('coupons', 'code');

        if ($coupon !== null) {
            $uniqueCode->ignore($coupon->id);
        }

        return [
            'code' => ['required', 'string', 'min:4', 'max:6', $uniqueCode],
            'discount_percentage' => ['required', 'numeric', 'min:1', 'max:100'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_date'],
        ];
    }
}
