@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
          <ul class="nav nav-tabs" id="myTabs" role="tablist"> 
            <li role="presentation" class="active">
              <a href="#note" id="note-tab" role="tab" data-toggle="tab" aria-controls="note" aria-expanded="true">Note</a>
            </li> 
            <li role="presentation" class="">
              <a href="#todo" role="tab" id="todo-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Todo</a>
            </li> 
            </ul> 
            <div class="tab-content" id="myTabContent"> 
              <div class="tab-pane fade active in" role="tabpanel" id="note" aria-labelledby="note-tab"> 
              <div class="table-responsive-sm">
                <table class="table table-hover"> 
                <thead> 
                  <tr> 
                    <th>#</th> 
                    <th>Title</th> 
                    <th>Contents</th> 
                    <th>Date created</th>
                    <th>Date updated</th>
                    <th>Status</th>
                    <th class="text-center" width="150px">
                      <a href="#" class="add-modal btn btn-success btn-sm" data-toggle="modal" data-target="#AddModal ">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add 
                      </a>
                    </th>   
                  </tr>
                {{ csrf_field() }}
                <?php $no = 1; ?>
                @forelse ($data as $value)
                  <tr class="post{{$value->id}}">
                    <td>{{ $no++ }}</td>
                    <?php
                      if($value->status == 0){
                        echo '<td>'.ucfirst(trans($value->title)).'</td>';
                        echo '<td>'.ucfirst(trans($value->contents)).'</td>';
                        echo '<td>'.$value->created_at.'</td>';
                        echo '<td>'.$value->updated_at.'</td>';
                        echo '<td><button type="button" class="btn btn-default btn-sm">Pending</button></td>';
                      }else{
                        echo '<td style="text-decoration: line-through;">'.ucfirst(trans($value->title)).'</td>';
                        echo '<td style="text-decoration: line-through;">'.ucfirst(trans($value->contents)).'</td>';
                        echo '<td style="text-decoration: line-through;">'.$value->created_at.'</td>';
                        echo '<td style="text-decoration: line-through;">'.$value->updated_at.'</td>';
                        echo '<td><button type="button" class="btn btn-primary btn-sm">Done</button></td>';
                      }
                      ?>                               
                    <td>
                      <a href="#" class="btn btn-default btn-info btn-sm" data-toggle="modal" data-target="#show" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-status="{{$value->status}}">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                      </a>
                      <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-status="{{$value->status}}">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-status="{{$value->status}}">                  <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                      </a>
                    </td>
                  </tr>
                  @empty
                  <p class="pull-right">No Activities Available.</p>
                @endforelse 
                </thead> 
                <tbody> 
                  <tr> 
                  </tr> 
                </tbody> 
              </table> 
              </div>
              </div> 
              <div class="tab-pane fade" role="tabpanel" id="todo" aria-labelledby="todo-tab"> 
                <div class="table-responsive-sm">
                <table class="table table-hover"> 
                <thead> 
                  <tr> 
                    <th>#</th> 
                    <th>Title</th> 
                    <th>Contents</th> 
                    <th>Date created</th>
                    <th>Date updated</th>
                    <th>Status</th>
                    <th class="text-center" width="150px">
                      <a href="#" class="add-modal btn btn-success btn-sm" data-toggle="modal" data-target="#todoAdd ">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add 
                      </a>
                    </th>   
                  </tr>
                {{ csrf_field() }}
                <?php $no = 1; ?>
                @forelse ($data2 as $value)
                  <tr class="post{{$value->id}}">
                    <td>{{ $no++ }}</td>
                    <?php
                      if($value->status == 0){
                        echo '<td>'.ucfirst(trans($value->title)).'</td>';
                        echo '<td>'.ucfirst(trans($value->contents)).'</td>';
                        echo '<td>'.$value->created_at.'</td>';
                        echo '<td>'.$value->updated_at.'</td>';
                        echo '<td><button type="button" class="btn btn-default btn-sm">Pending</button></td>';
                      }else{
                        echo '<td style="text-decoration: line-through;">'.ucfirst(trans($value->title)).'</td>';
                        echo '<td style="text-decoration: line-through;">'.ucfirst(trans($value->contents)).'</td>';
                        echo '<td style="text-decoration: line-through;">'.$value->created_at.'</td>';
                        echo '<td style="text-decoration: line-through;">'.$value->updated_at.'</td>';
                        echo '<td><button type="button" class="btn btn-primary btn-sm">Done</button></td>';
                      }
                      ?>                               
                    <td>
                      <a href="#" class="btn btn-default btn-info btn-sm" data-toggle="modal" data-target="#show-todo" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-status="{{$value->status}}">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                      </a>
                      <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-todo" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-status="{{$value->status}}">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-todo" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-status="{{$value->status}}">                  <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                      </a>
                    </td>
                  </tr>
                  @empty
                  <p class="pull-right">No Activities Available.</p>
                @endforelse 
                </thead> 
                <tbody> 
                  <tr> 
                  </tr> 
                </tbody> 
              </table> 
              </div>
              </div>  
            </div> 
          </div>
       
        
        {!! $data->render() !!}
      </div>
    </div>
</div>

@include('layouts.note')
@include('layouts.todo')
@endsection

