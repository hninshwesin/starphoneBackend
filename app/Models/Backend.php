<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Backend
 * @package App\Models
 * @version January 4, 2021, 9:22 pm UTC
 *
 * @property json $raw_json
 */
class Backend extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'backends';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'raw_json',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'raw_json' => 'json',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
