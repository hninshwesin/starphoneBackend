<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if(!$request->hasFile('images')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowableExtension=['jpeg','jpg','png','gif','svg'];
        $files = $request->file('images');
//        $errors = [];

        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();

            $check = in_array($extension,$allowableExtension);

            if($check) {
                foreach($request->file('images') as $images) {

                    $image = $images->store('public');
                    $image_name[] = basename($image);
//                    $name = $images->getClientOriginalName();
                    $url = Storage::disk('public')->url($image);
                    $input_image = $image_name;
                    
                    //store image file into directory and db
                }
                
                return response()->json([
                    "success" => true,
                    "message" => "Image successfully uploaded",
                    "image_name" => $image_name,
                    // "image_url" => $url,
                ], 200);
            } else {
                return response()->json(['invalid_file_format'], 422);
            }

        }
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
