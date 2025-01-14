@if (Session::has('flash_message'))
    <div class="alert alert-block fade in {{ Session::has('flash_type') ? session('flash_type') : 'alert-success'  }} {{ Session::has('flash_message_important') ? 'alert-important' : ''  }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
        <p>{{ session('flash_message')  }}</p>
    </div>
@endif