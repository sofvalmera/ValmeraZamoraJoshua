@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">    
                <form action="" method="post" name="registerf" id="registerf">
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" id="password" name="password">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                        <p></p>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                </form>			
                <div class="text-center small">Already have an account? <a href="login.php">Login Now</a></div>
            </div>
        </div>
    </section>



@endsection
@section('customJs')
<script>

$("#registerf").submit(function(event){
		event.preventDefault();

        // var formArray = $(this).serializeArray();

        // $("button[type='submit']").prop('disabled',true);
		$.ajax({
			url: '{{route("account.registernatokmol")}}',
			type: 'get',
			data:$(this),serializeArray(),
			dataType:'json',
			success:function(response){
                var errors = response['errors'];


                if(errors.name){
					$("#name").siblings('p').addClass('invalid-feedback').html(errors.name);
					$("#name").addClass('is-invalid');
				} else{
					$("#name").siblings('p').removeClass('invalid-feedback').html("");
					$("#name").removeClass('is-invalid');
			
				}
                if(errors.name){
					$("#name").siblings('p').addClass('invalid-feedback').html(errors.name);
					$("#name").addClass('is-invalid');
				} else{
					$("#name").siblings('p').removeClass('invalid-feedback').html("");
					$("#name").removeClass('is-invalid');
			
				}
                if(errors.name){
					$("#name").siblings('p').addClass('invalid-feedback').html(errors.name);
					$("#name").addClass('is-invalid');
				} else{
					$("#name").siblings('p').removeClass('invalid-feedback').html("");
					$("#name").removeClass('is-invalid');
			
				}
                
				
				

			}, error: function(jqXHR, exception){
				console.log("Something Went Wrong");
			}
		})
	});

</script>
@endsection