<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendResponse($result, $message)

    {

        $response = [

            'success' => true,

            'data'    => $result,

            'message' => $message,

        ];


        return response()->json($response, 200);

    }


    /**

     * return error response.

     *

     * @return \Illuminate\Http\Response

     */

    public function sendError($error, $errorMessages = [], $code = 404)

    {

        $response = [

            'success' => false,

            'message' => $error,

        ];


        if(!empty($errorMessages)){

            $response['data'] = $errorMessages;

        }


        return response()->json($response, $code);

    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
