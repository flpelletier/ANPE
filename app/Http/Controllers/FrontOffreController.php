<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offre;

class FrontOffreController extends Controller
{
    
    /**
     * Récupération de toutes les offres
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $offre = Offre::all();
        //$offre = Offre::paginate(5);

        return view('front.index', compact('offre'));
    }
   
}
