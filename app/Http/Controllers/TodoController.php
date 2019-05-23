<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use App\http\Requests;
use App\Todo;

class TodoController extends Controller
{
	public function index()
  {  
    $data = Todo::orderBy('created_at', 'desc')->paginate(10);
    return view('home', compact('data'));
  }
	
	// Add todo
  public function addTodo(Request $request) 
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

        $product = new Todo();
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
  // Update todo
  public function updateTodo(Request $request)
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

        $product = Todo::findorFail($request->id);
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
  public function deleteTodo(Request $request)
  {
    $product = Todo::find($request->id)->delete();
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
