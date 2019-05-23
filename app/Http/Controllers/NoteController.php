<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Activities;
use View;
use App\http\Requests;
use App\Todo;


class NoteController extends Controller
{
	 public function index()
  { 
    $data = Activities::orderBy('created_at', 'desc')->paginate(10);
    $data2 = Todo::orderBy('created_at', 'desc')->paginate(10);
    return view('home', compact('data', 'data2'));
  }

  // Add Activity
  public function addNote(Request $request) 
  { 
   $validator = Validator::make($request->all(), [
      'title' => 'required|min:5',
      'contents' => 'required|min:5',
      'status' => 'required'
    ]);

    $input = $request->all();

    if ($validator->fails()){
      return Response::json(['errors' => $validator->errors()]);
    }
    else {

      $product = new Activities();
      $product->title = $request->title;
      $product->contents = $request->contents;
      $product->status = $request->status; 
      
      if($product->save()){
        $res['status'] = "200";
        $res['message'] ="Update Success!";
        $res['value'] = "$product";
        return Response::json($res);
      }
      else {
        $res['status'] = "400";
        $res['message'] = "Updated Failed!";
        return response($res);
      }
    }
  }

    // Update Activity
  public function updateNote(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'title' => 'required|min:5',
        'contents' => 'required|min:5',
        'status' => 'required'
      ]);

      $input = $request->all();

      if ($validator->fails()){
        return Response::json(['errors' => $validator->errors()]);
      }
      else {

        $product = Activities::findorFail($request->id);
        $product->title = $request->title;
        $product->contents = $request->contents;
       	$product->status = $request->status; 
        
        if($product->save()){
          $res['status'] = "200";
          $res['message'] ="Update Success!";
          $res['value'] = "$product";
          return Response::json($res);
        }
        else {
          $res['status'] = "400";
          $res['message'] = "Updated Failed!";
          return response($res);
        }
      }
      
  }

    // Delete Activity
    public function deleteNote(Request $request)
    {
      $product = Activities::find($request->id)->delete();
      if($product == true) {
        $res['status'] = "200";
        $res['message'] ="Deleted Success!";
        $res['value'] = "$product";
        return Response::json($res);
      }
      else {
        $res['status'] = "400";
        $res['message'] = "Deleted Failed!";
        return response($res);
      }
    }
}
