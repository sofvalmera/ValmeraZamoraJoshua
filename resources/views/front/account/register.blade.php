@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
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
		// var element =$(this);


		$("button[type=submit]").prop('disable',true);
		$.ajax({
			url: '{{ route("account.processRegister") }}',
			type: 'post',
			data: $(this).serializeArray(),
			dataType:'json',
			success:function(response){
				// $("button[type=submit]").prop('disable',false);

				

				// 	window.location.href="{{route('admin.showChangePasswordForm')}}";
					// $("#name").removeClass('is-invalid')
					// .siblings('p')
					// .removeClass('invalid-feedback')
					// .html("");

					// $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				// }
                // else {
                        // if(response['notFound'] == true){
                        //     window.location.href="{{route('categories.index')}}";

                        // }

					var errors = response.errors;
                            if(response["status"] == false){
                    if(errors.name){
                        $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                        $("#name").addClass('is-invalid-feedback');
                    }else {
                        $("#name").siblings("p").removeClass('invalid-feedback').html('');
                        $("#name").removeClass('is-invalid');
                    }
                    if(errors.email){
                        $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                        $("#email").addClass('is-invalid-feedback');
                    }else {
                        $("#email").siblings("p").removeClass('invalid-feedback').html('');
                        $("#email").removeClass('is-invalid');
                    }
                    if(errors.password){
                        $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
                        $("#password").addClass('is-invalid-feedback');
                    }else {
                        $("#password").siblings("p").removeClass('invalid-feedback').html('');
                        $("#password").removeClass('is-invalid');
                    }
                    


				// if(errors['old_password']){
				// 	$("#old_password").addClass('is-invalid')
				// 	.siblings('p')
				// 	.addClass('invalid-feedback').html(errors['old_password']);
				// } else{
				// 	$("#old_password").removeClass('is-invalid')
				// 	.siblings('p')
				// 	.removeClass('invalid-feedback')
				// 	.html("");
				// }
				// if(errors['new_password']){
				// 	$("#new_password").addClass('is-invalid')
				// 	.siblings('p')
				// 	.addClass('invalid-feedback')
				// 	.html(errors['new_password']);
				// }else{
				// 	$("#new_password").removeClass('is-invalid')
				// 	.siblings('p')
				// 	.removeClass('invalid-feedback')
				// 	.html("");
				// }
				// if(errors['confirm_password']){
				// 	$("#confirm_password").addClass('is-invalid')
				// 	.siblings('p')
				// 	.addClass('invalid-feedback')
				// 	.html(errors['confirm_password']);
				// }else{
				// 	$("#confirm_password").removeClass('is-invalid')
				// 	.siblings('p')
				// 	.removeClass('invalid-feedback')
				// 	.html("");
				// }


				}else{
                    $("#name").siblings("p").removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');

                    $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                        $("#email").addClass('is-invalid-feedback');
                        
                        $("#password").siblings("p").removeClass('invalid-feedback').html('');
                        $("#password").removeClass('is-invalid');
                }
				

			}, error: function(jqXHR, exception){
				console.log("Something Went Wrong");
			}
		})
	});

</script>
@endsection