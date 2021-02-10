<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrandNameAPIRequest;
use App\Http\Requests\API\UpdateBrandNameAPIRequest;
use App\Models\BrandName;
use App\Repositories\BrandNameRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

/**
 * Class BrandNameController
 * @package App\Http\Controllers\API
 */

class BrandNameAPIController extends AppBaseController
{
    /** @var  BrandNameRepository */
    private $brandNameRepository;

    public function __construct(BrandNameRepository $brandNameRepo)
    {
        $this->brandNameRepository = $brandNameRepo;
    }

    /**
     * Display a listing of the BrandName.
     * GET|HEAD /brandNames
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $brandNames = $this->brandNameRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($brandNames->toArray(), 'Brand Names retrieved successfully');
    }

    /**
     * Store a newly created BrandName in storage.
     * POST /brandNames
     *
     * @param CreateBrandNameAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandNameAPIRequest $request)
    {
        $input = $request->all();

        $brandName = $this->brandNameRepository->create($input);

        return $this->sendResponse($brandName->toArray(), 'Brand Name saved successfully');
    }

    /**
     * Display the specified BrandName.
     * GET|HEAD /brandNames/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var BrandName $brandName */
        $brandName = $this->brandNameRepository->find($id);

        if (empty($brandName)) {
            return $this->sendError('Brand Name not found');
        }

        return $this->sendResponse($brandName->toArray(), 'Brand Name retrieved successfully');
    }

    /**
     * Update the specified BrandName in storage.
     * PUT/PATCH /brandNames/{id}
     *
     * @param int $id
     * @param UpdateBrandNameAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandNameAPIRequest $request)
    {
        $input = $request->all();

        /** @var BrandName $brandName */
        $brandName = $this->brandNameRepository->find($id);

        if (empty($brandName)) {
            return $this->sendError('Brand Name not found');
        }

        $brandName = $this->brandNameRepository->update($input, $id);

        return $this->sendResponse($brandName->toArray(), 'BrandName updated successfully');
    }

    /**
     * Remove the specified BrandName from storage.
     * DELETE /brandNames/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var BrandName $brandName */
        $brandName = $this->brandNameRepository->find($id);

        if (empty($brandName)) {
            return $this->sendError('Brand Name not found');
        }

        $brandName->delete();

        return $this->sendSuccess('Brand Name deleted successfully');
    }
}
