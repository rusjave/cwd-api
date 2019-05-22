<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Activities;
use View;
use App\http\Requests;

class ActivityController extends Controller
{

  public function index()
  { 
    $data = Activities::orderBy('created_at', 'desc')->paginate(10);
    return view('home', compact('data'));
  }

  // Add Activity
    public function addActivity(Request $request) 
    { 
       $validator = Validator::make($request->all(), [
          'title' => 'required|min:5',
          'contents' => 'required|min:5',
          'activity_type' => 'required',
          'status' => 'required'
        ]);

        $input = $request->all();

        if ($validator->passes()) {

            $product = new Activities();
            $product->id = $request->id;
            $product->title = $request->title;
            $product->contents = $request->contents;
            $product->activity_type = $request->activity_type;
           	$product->status = $request->status; 
            $product->save();
            return Response::json(['success' => '1']);

        }
        
        return Response::json(['errors' => $validator->errors()]);
    }

    // Update Activity
    public function updateProduct(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'title' => 'required|min:5',
          'contents' => 'required|min:5',
          'activity_type' => 'required',
          'status' => 'required'
        ]);

        $input = $request->all();

        if ($validator->passes()) {

            $product = Activities::find($request->id);
            $product->title = $request->title;
            $product->contents = $request->contents;
            $product->activity_type = $request->activity_type;
           	$product->status = $request->status; 
            $product->save();
         
            return Response::json(['success' => '1']);

        }
        
        return Response::json(['errors' => $validator->errors()]);    
    }

    // Delete Activity
    public function deleteProduct(Request $request)
    {
      $product = Activities::find($request->id)->delete();
      return response()->json($product);
     
    }
}
