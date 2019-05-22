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
          $( '#activity_type-error' ).html( "" );

          $.ajax({
              url:'/addActivity',
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
                    if(data.errors.activity_type){
                      $( '#activity_type-error' ).html( data.errors.activity_type[0] );
                    }
                    if(data.errors.status){
                      $( '#status-error' ).html( data.errors.status[0] );
                    }
                  }
                  if(data.success) {
                    $('#success-msg').removeClass('hide');
                    setInterval(function(){ 
                        $('#AddModal').modal('hide');
                         window.location.reload();
                        $('#success-msg').addClass('hide');
                    }, 3000);
                  }
              },
          });
      });
      // Show activity 
      $('#show').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var title = button.data('title');
        var contents = button.data('contents');
        var activity_type = button.data('activity-type');
        var status = button.data('status');      
        var modal = $(this);
        
        modal.find('.modal-body #id_show').val(id);
        modal.find('.modal-body #title_show').val(title);
        modal.find('.modal-body #contents_show').val(contents);
        modal.find('.modal-body #activity_type_show').val(activity_type);
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
              url:'/updateActivity',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_edit').val(),
                'title' : $('#title_edit').val(),
                'contents' : $('#contents_edit').val(),
                'activity_type' : $('#activity_type_edit').val(),
                'status' : $('#status_edit').val()  
              },
              success:function(data) {
                  console.log(data);
                  if(data.errors) {
                    if(data.errors.title){
                      $( '#title-edit-error' ).html( data.errors.title[0] );
                    }
                    if(data.errors.contents){
                      $( '#contents-edit-error' ).html( data.errors.contents[0] );
                    }
                    if(data.errors.activity_type){
                      $( '#activity_type-edit-error' ).html( data.errors.activity_type[0] );
                    }
                    if(data.errors.status){
                      $( '#status-edit-error' ).html( data.errors.status[0] );
                    }
                  }
                  if(data.success) {
                    $('#success-msg-update').removeClass('hide');
                    setInterval(function(){ 
                      $('#edit').modal('hide');
                       window.location.reload();
                      $('#success-msg-update').addClass('hide');
                    }, 3000);
                  }
              },
          });
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
              url:'/deleteActivity',
              type:'POST',
              data:{
                '_token' : $('input[name=_token]').val(),
                'id' : $('#id_delete').val(),
              },
              success:function(data) {
                console.log(data);
                  $('#success-msg-delete').removeClass('hide');
                  setInterval(function(){ 
                    $('#delete').modal('hide');
                     window.location.reload();
                    $('#success-msg-delete').addClass('hide');
                  }, 3000);
                },
            });
          });
      });
     
    </script>
  </body>
</html>
