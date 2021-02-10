<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RawPublic
 * @package App\Models
 * @version January 14, 2021, 5:08 pm +0630
 *
 * @property json $raw_json
 */
class RawPublic extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'raw_publics';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'raw_json'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'raw_json' => 'json',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'raw_json' => 'required'
    ];


}
