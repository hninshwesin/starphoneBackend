<?php

namespace App\Repositories;

use App\Models\BrandName;
use App\Repositories\BaseRepository;

/**
 * Class BrandNameRepository
 * @package App\Repositories
 * @version January 16, 2021, 2:57 am +0630
*/

class BrandNameRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'brand_name',
        'raw_publics_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BrandName::class;
    }
}
