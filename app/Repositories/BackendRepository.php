<?php

namespace App\Repositories;

use App\Models\Backend;
use App\Repositories\BaseRepository;

/**
 * Class BackendRepository
 * @package App\Repositories
 * @version January 4, 2021, 9:22 pm UTC
*/

class BackendRepository extends BaseRepository
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
        return Backend::class;
    }
}
