<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRawPublicAPIRequest;
use App\Http\Requests\API\UpdateRawPublicAPIRequest;
use App\Models\RawPublic;
use App\Repositories\RawPublicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

/**
 * Class RawPublicController
 * @package App\Http\Controllers\API
 */

class RawPublicAPIController extends AppBaseController
{
    /** @var  RawPublicRepository */
    private $rawPublicRepository;

    public function __construct(RawPublicRepository $rawPublicRepo)
    {
        $this->rawPublicRepository = $rawPublicRepo;
    }

    /**
     * Display a listing of the RawPublic.
     * GET|HEAD /rawPublics
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rawPublics = $this->rawPublicRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rawPublics->toArray(), 'Raw Publics retrieved successfully');
    }

    /**
     * Store a newly created RawPublic in storage.
     * POST /rawPublics
     *
     * @param CreateRawPublicAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRawPublicAPIRequest $request)
    {
        $input = $request->json()->all();

        $rawPublic = $this->rawPublicRepository->create(['raw_json'=>$input]);

        return $this->sendResponse($rawPublic->toArray(), 'Raw Public saved successfully');
    }

    /**
     * Display the specified RawPublic.
     * GET|HEAD /rawPublics/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RawPublic $rawPublic */
        $rawPublic = $this->rawPublicRepository->find($id);

        if (empty($rawPublic)) {
            return $this->sendError('Raw Public not found');
        }

        return $this->sendResponse($rawPublic->toArray(), 'Raw Public retrieved successfully');
    }

    /**
     * Update the specified RawPublic in storage.
     * PUT/PATCH /rawPublics/{id}
     *
     * @param int $id
     * @param UpdateRawPublicAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRawPublicAPIRequest $request)
    {
        $input = $request->all();

        /** @var RawPublic $rawPublic */
        $rawPublic = $this->rawPublicRepository->find($id);

        if (empty($rawPublic)) {
            return $this->sendError('Raw Public not found');
        }

        $rawPublic = $this->rawPublicRepository->update($input, $id);

        return $this->sendResponse($rawPublic->toArray(), 'RawPublic updated successfully');
    }

    /**
     * Remove the specified RawPublic from storage.
     * DELETE /rawPublics/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RawPublic $rawPublic */
        $rawPublic = $this->rawPublicRepository->find($id);

        if (empty($rawPublic)) {
            return $this->sendError('Raw Public not found');
        }

        $rawPublic->delete();

        return $this->sendSuccess('Raw Public deleted successfully');
    }
}
