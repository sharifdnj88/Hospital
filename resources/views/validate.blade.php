@if( $errors -> any() )
<p class="alert alert-danger">{{ $errors -> first() }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif

@if( Session::has('success') )
<p class="alert alert-success">{{ Session::get('success') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif


@if( Session::has('warning') )
<p class="alert alert-warning">{{ Session::get('warning') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif


@if( Session::has('danger') )
<p class="alert alert-danger">{{ Session::get('danger') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif


@if( Session::has('info') )
<p class="alert alert-info">{{ Session::get('info') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif

@if( Session::has('primary') )
<p class="alert alert-primary">{{ Session::get('primary') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif