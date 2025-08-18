<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HocPhpController extends Controller
{
    public function __Construct()
    {
        // Constructor logic if needed
    }
    public function index()
    {
        // This method can be used to return a view or handle logic

        return view('client/Hocphp/list'); // Assuming you have a view named 'home'
    }

    public function getHocPHP($id)
    {
        return 'hocphp :'.$id ;
    }
    
    public function updateHocPHP($id)
    {
        return 'submit theo hocphp'. $id;
        // Logic to update HocPHP data
        // This could involve validating input, saving to the database, etc.
        // For example:
        // $data = request()->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        // ]);
    } // Dấu ngoặc nhọn đã được di chuyển lên đây

    public function addHocPHP(Request $request)
    {
        // Logic to add HocPHP data
        // This could involve validating input, saving to the database, etc.
        // For example:
        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        // ]);
        //return redirect()->back()->with('success', 'HocPHP added successfully!');
        return view ('client/Hocphp/add'); // Assuming you have a view named 'add'
    }
          public function handlePostRequest()
    {
        // Handle the POST request logic here
        // For example, you can access form data using $request->input('field_name')
        // and perform necessary actions like saving to the database or processing data.
        
        return "submit chuyên mục";
    }
    public function deleteHocPHP($id)
    {
        // Logic to delete HocPHP data
        // This could involve finding the record by ID and deleting it from the database.
        return 'delete hocphp: '.$id;
    }
}