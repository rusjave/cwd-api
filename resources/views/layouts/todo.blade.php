<!-- Modal form to add activity -->
<div id="todoAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add todo</h4>
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
                    <form class="form-horizontal" method="POST" id="AddTodo">
                        {{ csrf_field() }}
                         <input type="hidden" name="id" id="id">
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">title:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="title" name="title" placeholder="Product title here" required="">
                           <span class="text-danger">
                                <strong id="title-todo-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">Contents:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control text-capitalize" rows="3" id="contents" name="contents" placeholder="Product Contents here" required=""></textarea>
                           <span class="text-danger">
                                <strong id="contents-todo-error"></strong>
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
                                <strong id="status-todo-error"></strong>
                            </span>
                          </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" id="submitTodo" class="btn btn-primary btn-prime white btn-flat">
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
<div class="modal fade" role="dialog" id="show-todo" tabindex="1" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View todo</h4>
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
              <input type="text" class="form-control text-capitalize" id="title_show" name="title" placeholder="Product name here" 
              disabled> 
            </div>   
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="contents">Contents:</label>
            <div class="col-sm-10">
               <textarea class="form-control text-capitalize" rows="3" id="contents_show" name="contents" placeholder="Product contents here" disabled></textarea>
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
<div class="modal fade" role="dialog" id="edit-todo" tabindex="1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update todo</h4>
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
                            <input type="text" class="form-control" id="id_edit_todo" name="id" disabled="">
                          </div>   
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">title:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="title_edit_todo" name="title" placeholder="Product title here" required="">
                           <span class="text-danger">
                                <strong id="title-t-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="name">Contents:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control text-capitalize" rows="3" id="contents_edit_todo" name="contents" placeholder="Product Contents here" required=""></textarea>
                           <span class="text-danger">
                                <strong id="contents-t-error"></strong>
                            </span>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="control-label col-sm-2" for="type">Status:</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="tstarus" id="status_edit_todo">
                                <option value="">Please choose one</option>
                                <option value="0">Pending</option>
                                <option value="1">Done</option>
                            </select>
                             <span class="text-danger">
                                <strong id="status-t-error"></strong>
                            </span>
                          </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" id="updateTodo" class="btn btn-primary btn-prime white btn-flat">
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
<div class="modal fade" role="dialog" id="delete-todo" tabindex="1" aria-labelledby="myModalLabel">
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
        <input type="hidden" class="form-control" id="id_del_todo" name="id" disabled="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel
        </button>
        <button type="submit" class="btn btn-warning " id="deleteTodo">Yes, Delete
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->