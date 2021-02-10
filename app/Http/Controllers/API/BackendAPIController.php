<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBackendAPIRequest;
use App\Http\Requests\API\UpdateBackendAPIRequest;
use App\Models\Backend;
use App\Repositories\BackendRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;

/**
 * Class BackendController
 * @package App\Http\Controllers\API
 */

class BackendAPIController extends AppBaseController
{
    /** @var  BackendRepository */
    private $backendRepository;

    public function __construct(BackendRepository $backendRepo)
    {
        $this->backendRepository = $backendRepo;
    }

    /**
     * Display a listing of the Backend.
     * GET|HEAD /backends
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $backends = $this->backendRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($backends->toArray(), 'Backends retrieved successfully');
    }

    /**
     * Store a newly created Backend in storage.
     * POST /backends
     *
     * @param CreateBackendAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBackendAPIRequest $request)
    {

        $input = $request->json()->all();

        $user = Auth::user();

        $success['token'] =  $user->createToken('MyApp')-> accessToken;

        $success['name'] =  $user->name;

        $success['id'] =  $user->id;

        $backend = $this->backendRepository->create(['raw_json'=>$input, 'user_id'=>$user->id]);

//        $backend = $this->backendRepository->create(['raw_json'=>$input, 'user_id'=>2]);

        return $this->sendResponse($backend->toArray(),'Backend saved successfully');

//        return $this->sendResponse($backend->toArray(),['token' => $success['token'],'userId' => $user->id, 'Backend saved successfully']);
    }

    /**
     * Display the specified Backend.
     * GET|HEAD /backends/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Backend $backend */
        $backend = $this->backendRepository->find($id);

        $user = Auth::user();

        $success['token'] =  $user->createToken('MyApp')-> accessToken;

        $success['name'] =  $user->name;

        $success['id'] =  $user->id;

        if (empty($backend)) {
            return $this->sendError('Backend not found');
        }
        return $this->sendResponse($backend->toArray(), 'Backend retrieved successfully');

//        return $this->sendResponse([$backend->toArray(),$success], 'Backend retrieved successfully');
    }

    /**
     * Update the specified Backend in storage.
     * PUT/PATCH /backends/{id}
     *
     * @param int $id
     * @param UpdateBackendAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBackendAPIRequest $request)
    {
        $input = $request->all();

        /** @var Backend $backend */
        $backend = $this->backendRepository->find($id);

        if (empty($backend)) {
            return $this->sendError('Backend not found');
        }

        $backend = $this->backendRepository->update($input, $id);

        return $this->sendResponse($backend->toArray(), 'Backend updated successfully');
    }

    /**
     * Remove the specified Backend from storage.
     * DELETE /backends/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Backend $backend */
        $backend = $this->backendRepository->find($id);

        if (empty($backend)) {
            return $this->sendError('Backend not found');
        }

        $backend->delete();

        return $this->sendSuccess('Backend deleted successfully');
    }
}
