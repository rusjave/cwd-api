<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CWD</title>

   <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-glyphicons.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
</head>
  <body>
      <div id="app">
          <nav class="navbar navbar-default navbar-static-top">
              <div class="container">
                  <div class="navbar-header">`

                      <!-- Collapsed Hamburger -->
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                          <span class="sr-only">Toggle Navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>

                      <!-- Branding Image -->
                      <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="cwd">CWD</span> 
                      </a>
                  </div>

                  <div class="collapse navbar-collapse" id="app-navbar-collapse">
                      <!-- Left Side Of Navbar -->
                      <ul class="nav navbar-nav">
                          &nbsp;
                      </ul>

                      <!-- Right Side Of Navbar -->
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="">Abouts Us</a></li>
                        <li><a href="">Contact Us</a></li>
                      </ul>
                  </div>
              </div>
          </nav>

          @yield('content')
          
      </div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted">CWD @2019.</p>
      </div>
    </footer>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-2.2.4.js') }}"></script>
  
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
      
      $(document).ready(function(){ 

        // Add activity
      $('body').on('click', '#submitForm', function(){
          var registerForm = $("#AddActivity");
          var formData = registerForm.serialize();
          $( '#title-error' ).html( "" );
          $( '#contents-error' ).html( "" );

          $.ajax({
              url:'api/addNote',
              type:'POST',
              data:formData,
              success:function(data) {
                console.log(data);
                if(data.errors) {
                  if(data.errors.title){
                    $( '#title-error' ).html( data.errors.title[0] );
                  }
                  if(data.errors.contents){
                    $( '#contents-error' ).html( data.errors.contents[0] );
                  }
                  if(data.errors.status){
                    $( '#status-error' ).html( data.errors.status[0] );
                  }
                }
  
                var json = data;
                  if(json.status == 200) {
                    alert(json.message);
                    setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                } else {
                  alert("Added Failed!");
                }
              },
          });
          return false;
      });
      // Show activity 
      $('#show').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var title = button.data('title');
        var contents = button.data('contents');
        var status = button.data('status');      
        var modal = $(this);
        
        modal.find('.modal-body #id_show').val(id);
        modal.find('.modal-body #title_show').val(title);
        modal.find('.modal-body #contents_show').val(contents);
        modal.find('.modal-body #status_show').val(status);
      })
      // Edit activity  
      $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var title = button.data('title');
        var contents = button.data('contents');
        var activity_type = button.data('activity-type');
        var status = button.data('status');      
        var modal = $(this);
        
        modal.find('.modal-body #id_edit').val(id);
        modal.find('.modal-body #title_edit').val(title);
        modal.find('.modal-body #contents_edit').val(contents);
        modal.find('.modal-body #activity_type_edit').val(activity_type);
        modal.find('.modal-body #status_edit').val(status);
      })
      // Update activity
        $('.modal-footer').on('click', '#updateActivity', function(){         
          $.ajax({
              url:'api/updateNote',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_edit').val(),
                'title' : $('#title_edit').val(),
                'contents' : $('#contents_edit').val(),
                'status' : $('#status_edit').val()  
              },
              success:function(data) {

                  if(data.errors) {
                    if(data.errors.title){
                      $( '#title-edit-error' ).html( data.errors.title[0] );
                    }
                    if(data.errors.contents){
                      $( '#contents-edit-error' ).html( data.errors.contents[0] );
                    }
                    if(data.errors.status){
                      $( '#status-edit-error' ).html( data.errors.status[0] );
                    }
                  }
                  //console.log(data);
                  var json = data;
                  if(json.status == 200) {
                     alert(json.message);
                     setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                  }else {
                    alert('Update Failed!');
                  }                             
              },
          });
          return false;
      });
      // Delete activity
        $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
  
        modal.find('.modal-body #id_delete').val(id);
      })
  
        $('.modal-footer').on('click', '#deleteProduct', function(){         
          $.ajax({
              url:'api/deleteNote',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_delete').val(),
              },
              success:function(data) {
                //console.log(data);
                var json = data;
                if (json.status == 200) {
                  alert("Deleted Success!");
                  setTimeout(function() {
                    window.location.reload();
                  }, 2000);
                } else {
                  alert("Deleted Failed!");
                }
              },
            });
          });
      });
     
       // Add Todo
      $('body').on('click', '#submitTodo', function(){
          var registerForm = $("#AddTodo");
          var formData = registerForm.serialize();
          $( '#title-todo-error' ).html( "" );
          $( '#contents-todo-error' ).html( "" );

          $.ajax({
              url:'api/addTodo',
              type:'POST',
              data:formData,
              success:function(data) {
                console.log(data);
                if(data.errors) {
                  if(data.errors.title){
                    $( '#title-todo-error' ).html( data.errors.title[0] );
                  }
                  if(data.errors.contents){
                    $( '#contents-todo-error' ).html( data.errors.contents[0] );
                  }
                  if(data.errors.status){
                    $( '#status-todo-error' ).html( data.errors.status[0] );
                  }
                }
  
                var json = data;
                  if(json.status == 200) {
                    alert(json.message);
                    setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                } else {
                  alert("Added Failed!");
                }
              },
          });
          return false;
      });
       // Show activity 
      $('#show-todo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var title = button.data('title');
        var contents = button.data('contents');
        var status = button.data('status');      
        var modal = $(this);
        
        modal.find('.modal-body #id_show').val(id);
        modal.find('.modal-body #title_show').val(title);
        modal.find('.modal-body #contents_show').val(contents);
        modal.find('.modal-body #status_show').val(status);
      });

       // Edit todo  
      $('#edit-todo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var title = button.data('title');
        var contents = button.data('contents');
        var activity_type = button.data('activity-type');
        var status = button.data('status');      
        var modal = $(this);
        
        modal.find('.modal-body #id_edit_todo').val(id);
        modal.find('.modal-body #title_edit_todo').val(title);
        modal.find('.modal-body #contents_edit_todo').val(contents);
        modal.find('.modal-body #activity_type_edit_todo').val(activity_type);
        modal.find('.modal-body #status_edit_todo').val(status);
      });

      // Update todo
        $('.modal-footer').on('click', '#updateTodo', function(){         
          $.ajax({
              url:'api/updateTodo',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_edit_todo').val(),
                'title' : $('#title_edit_todo').val(),
                'contents' : $('#contents_edit_todo').val(),
                'status' : $('#status_edit_todo').val()  
              },
              success:function(data) {

                  if(data.errors) {
                    if(data.errors.title){
                      $( '#title-t-error' ).html( data.errors.title[0] );
                    }
                    if(data.errors.contents){
                      $( '#contents-t-error' ).html( data.errors.contents[0] );
                    }
                    if(data.errors.status){
                      $( '#status-t-error' ).html( data.errors.status[0] );
                    }
                  }
                  //console.log(data);
                  var json = data;
                  if(json.status == 200) {
                     alert(json.message);
                     setTimeout(function() {
                      window.location.reload();
                    }, 2000);
                  }else {
                    alert('Update Failed!');
                  }                             
              },
          });
          return false;
      });

      // Delete todo
        $('#delete-todo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
  
        modal.find('.modal-body #id_del_todo').val(id);
      })
  
      $('.modal-footer').on('click', '#deleteTodo', function(){         
        $.ajax({
            url:'api/deleteTodo',
            type:'POST',
            data:{
              '_token' : $('input[name=_token]').val(),
              'id' : $('#id_del_todo').val(),
            },
            success:function(data) {
              //console.log(data);
              var json = data;
              if (json.status == 200) {
                alert("Deleted Success!");
                setTimeout(function() {
                  window.location.reload();
                }, 2000);
              } else {
                alert("Deleted Failed!");
              }
            },
          });
      });
   
    </script>
  </body>
</html>
