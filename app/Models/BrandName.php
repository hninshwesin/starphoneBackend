<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BrandName
 * @package App\Models
 * @version January 16, 2021, 2:57 am +0630
 *
 * @property string $brand_name
 * @property integer $raw_publics_id
 */
class BrandName extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'brand_names';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'brand_name',
        'raw_publics_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'brand_name' => 'string',
        'raw_publics_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'brand_name' => 'required',
        'raw_publics_id' => 'required'
    ];


}
