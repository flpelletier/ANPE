<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Offre;
use Validator;
use App\Http\Resources\Offre as OffreResource;
   
class OffreController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = Offre::all();
    
        return $this->sendResponse(OffreResource::collection($offres), 'Offre retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'titre' => 'required',
            'description' => 'required',
            'niveau' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $offres = Offre::create($input);
   
        return $this->sendResponse(new OffreResource($offres), 'Offre created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offre = Offre::find($id);
  
        if (is_null($offre)) {
            return $this->sendError('Offre not found.');
        }
   
        return $this->sendResponse(new OffreResource($offre), 'Offre retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offre $offre)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'titre' => 'required',
            'description' => 'required',
            'niveau' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $offre->titre = $input['titre'];
        $offre->description = $input['description'];
        $offre->niveau = $input['description'];

        $offre->save();
   
        return $this->sendResponse(new OffreResource($offre), 'Offre updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offre $offre)
    {
        $offre->delete();
   
        return $this->sendResponse([], 'Offre deleted successfully.');
    }
}