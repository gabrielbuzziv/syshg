@if ($errors->any())
    <ul class="alert alert-danger alert-block fade in">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif