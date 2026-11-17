<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PracticeFormRequest;

class PracticeController extends Controller
{
    public function requestInfo(Request $request){
        $name = $request->query('name');
        $age = $request->query('age');

        return "Name: {$name}, Age: {$age}";
    }

    public function allRequestData(Request $request){
        return $request->all();
    }

    public function useProfile(Request $request){
        return response()->json([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
        ]);
    }

    public function showForm()
    {
        return view('practice.form');
    }

    public function submitForm(PracticeFormRequest $request)
    {
        $validated = $request->validated();
        
        return response()->json([
            'message' => 'Form submitted successfully',
            'data' => $validated
        ]);
    }

    
}