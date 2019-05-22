@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive-sm">
          <table class="table table-hover"> 
          <thead> 
            <tr> 
              <th>#</th> 
              <th>Title</th> 
              <th>Contents</th> 
              <th>Activity type</th>
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
                  echo '<td>'.$value->activity_type.'</td>';
                  echo '<td>'.$value->created_at.'</td>';
                  echo '<td>'.$value->updated_at.'</td>';
                  echo '<td><button type="button" class="btn btn-default btn-sm">Pending</button></td>';
                }else{
                  echo '<td style="text-decoration: line-through;">'.ucfirst(trans($value->title)).'</td>';
                  echo '<td style="text-decoration: line-through;">'.ucfirst(trans($value->contents)).'</td>';
                  echo '<td style="text-decoration: line-through;">'.$value->activity_type.'</td>';
                  echo '<td style="text-decoration: line-through;">'.$value->created_at.'</td>';
                  echo '<td style="text-decoration: line-through;">'.$value->updated_at.'</td>';
                  echo '<td><button type="button" class="btn btn-primary btn-sm">Done</button></td>';
                }
                ?>                               
              <td>
                <a href="#" class="btn btn-default btn-info btn-sm" data-toggle="modal" data-target="#show" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-activity-type="{{$value->activity_type}}" data-status="{{$value->status}}">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-activity-type="{{$value->activity_type}}" data-status="{{$value->status}}">
                  <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" data-id="{{$value->id}}" data-title="{{$value->title}}" data-contents="{{$value->contents}}" data-activity-type="{{$value->activity_type}}" data-status="{{$value->status}}">
                  <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
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
        
        {!! $data->render() !!}
      </div>
    </div>
</div>

<!-- Modal form to add activity -->
<div id="AddModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">New activity</h4>
            </div>
            <div class="modal-body" style="overflow: hidden;">
                <div id="success-msg" class="hide">
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <strong><span>Added Success!</span></strong>
                    </div>
                </div>
                <div>
                    <form class="form-horizontal" method="POST" id="AddActivity">
                        {{ csrf_field() }}
                         <input type="hidden" name="id" id="id">
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">title:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="title" name="title" placeholder="Product title here" required="">
                           <span class="text-danger">
                                <strong id="title-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">Contents:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control text-capitalize" rows="3" id="contents" name="contents" placeholder="Product Contents here" required=""></textarea>
                           <span class="text-danger">
                                <strong id="contents-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="type">Activity type:</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="activity_type">
                                <option value="">Please choose one</option>
                                <option value="NOTE">NOTE</option>
                                <option value="TODO">TODO</option>
                            </select>
                             <span class="text-danger">
                                <strong id="activity_type-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="type">Status:</label>
                          <div class="col-sm-10">
                            <div class="checkbox"> 
                              <label>
                                <input type="checkbox" name="status" value="0"> Pending
                              </label>
                              <label>
                                <input type="checkbox" name="status" value="1"> Done
                              </label>
                             </div>
                              <span class="text-danger">
                                <strong id="status-error"></strong>
                            </span>
                          </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">
                      <span class="glyphicon glyphicon-save"></span>
                    Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
                      <span class="glyphicon glyphicon-remove"></span>
                    Close
                      </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to show activity  -->
<div class="modal fade" role="dialog" id="show" tabindex="1" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View acitivity</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group row">
            <label class="control-label col-sm-2" for="id">ID:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_show" name="name" disabled>
            </div>   
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2" for="title">title:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title_show" name="title" placeholder="Product name here" 
              disabled> 
            </div>   
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="contents">Contents:</label>
            <div class="col-sm-10">
               <textarea class="form-control text-capitalize" rows="3" id="contents_show" name="contents" placeholder="Product contents here" disabled></textarea>
            </div>
          </div>
          <div class="form-group has-feedback">
            <label class="control-label col-sm-2" for="activity type">Activity type:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="activity_type_show" name="activity_type"
              disabled> 
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="status">Status:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="status_show" name="status" placeholder="Product status here" 
              disabled>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
          <span class="glyphicon glyphicon-remove"></span>
        Close
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal form to edit activity  -->
<div class="modal fade" role="dialog" id="edit" tabindex="1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update activity</h4>
            </div>
            <div class="modal-body" style="overflow: hidden;">
                <div id="success-msg-update" class="hide">
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <strong>Updated Success!</strong>
                    </div>
                </div>
                <div>
                    <form class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                          <label class="control-label col-sm-2" for="name">ID:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_edit" name="id" disabled="">
                          </div>   
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">title:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="title_edit" name="title" placeholder="Product title here" required="">
                           <span class="text-danger">
                                <strong id="title-edit-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">Contents:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control text-capitalize" rows="3" id="contents_edit" name="contents" placeholder="Product Contents here" required=""></textarea>
                           <span class="text-danger">
                                <strong id="contents-edit-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="type">Activity type:</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="activity_type_edit" id="activity_type_edit">
                                <option value="">Please choose one</option>
                                <option value="NOTE">NOTE</option>
                                <option value="TODO">TODO</option>
                            </select>
                             <span class="text-danger">
                                <strong id="activity_type-edit-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="type">Status:</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="tstarus" id="status_edit">
                                <option value="">Please choose one</option>
                                <option value="0">Pending</option>
                                <option value="1">Done</option>
                            </select>
                             <span class="text-danger">
                                <strong id="status-edit-error"></strong>
                            </span>
                          </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" id="updateActivity" class="btn btn-primary btn-prime white btn-flat">
                      <span class="glyphicon glyphicon-save"></span>
                    Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
                      <span class="glyphicon glyphicon-remove"></span>
                    Close
                      </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to delete activity -->
<div class="modal fade" role="dialog" id="delete" tabindex="1" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Delete Confirmation</h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
          <div id="success-msg-delete" class="hide">
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <strong>Delete Success!</strong>
              </div>
          </div>
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
        <input type="hidden" class="form-control" id="id_delete" name="id" disabled="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel
        </button>
        <button type="submit" class="btn btn-warning " id="deleteProduct">Yes, Delete
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

