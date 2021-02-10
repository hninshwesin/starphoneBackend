<?php

namespace App\Repositories;

use App\Models\RawPublic;
use App\Repositories\BaseRepository;

/**
 * Class RawPublicRepository
 * @package App\Repositories
 * @version January 14, 2021, 5:08 pm +0630
*/

class RawPublicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'raw_json'
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
        return RawPublic::class;
    }
}
