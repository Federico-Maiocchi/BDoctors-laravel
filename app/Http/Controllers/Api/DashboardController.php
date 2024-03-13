<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $logged_user = Auth::user();

        // return response()->json([
        //     'status' =>  $logged_user
        //     // 'results' => $results
        // ]);

        // if(Auth::user()) {
        //     // Ottieni l'utente attualmente loggato
        //     $logged_user = Auth::user();
            
        //     $results = [ 
        //         'name' => $logged_user->name,
        //         'surname' => $logged_user->surname
        //     ];

        //     return response()->json([
        //         'status' => true,
        //         'results' => $results
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         // 'results' => $results
        //     ]);
        // }
        return response()->json([
            'status' => false,
            'results' => Auth::user()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
