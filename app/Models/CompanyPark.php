<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPark extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'company_parks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tvde_week_id',
        'company_id',
        'value',
        'fleet_management',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tvde_week()
    {
        return $this->belongsTo(TvdeWeek::class, 'tvde_week_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
