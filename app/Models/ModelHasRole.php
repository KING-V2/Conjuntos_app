<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model_has_roles';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'role_id',
        'model_type',
        'model_id'
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
