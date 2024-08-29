<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
class FormController extends Controller
{
    public function showData()
    {
        $data = FormData::get();
   
        return view('welcome',compact('data'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:form_data,email',
            'phone' => 'required|string',
            'selected_items' => 'required',
            'prices' => 'required',
        ]);
  
        FormData::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'selected_items' => $request->input('selected_items'),
            'prices' => $request->input('prices'),
        ]);

    
        return redirect()->back()->with('success', 'Data saved successfully!');
    }
 
}
