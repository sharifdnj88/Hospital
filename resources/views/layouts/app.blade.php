<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/  30 Nov 2019 04:11:34 GMT -->
<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Doccure</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="{{asset('assets/img/favicon.png')}}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

	</head>
	<body>


        @include('layouts/header')
        @section('main')            
        @show

        @include('layouts/footer')












        		<!-- jQuery -->
                <script src="{{asset('assets/js/jquery.min.js')}}"></script>
		
                <!-- Bootstrap Core JS -->
                <script src="{{asset('assets/js/popper.min.js')}}"></script>
                <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
                
                <!-- Slick JS -->
                <script src="{{asset('assets/js/slick.js')}}"></script>
        
                <!-- Sticky Sidebar JS -->
                <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"></script>
                <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"></script>
                
                <!-- Circle Progress JS -->
                <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>
                
                <!-- Custom JS -->
                <script src="{{asset('assets/js/script.js')}}"></script>


                {{-- Password Change --}}

                <script>
                    $('#show_pass').change(function(){
                        let said = $('#new_pass').attr('type');
        
                        if( said == 'password' ){
                            $('#new_pass').attr('type', 'text');
                        }else{
                            $('#new_pass').attr('type', 'password');
                        }
                        
                    });
                    
                </script>

</body>
</html>