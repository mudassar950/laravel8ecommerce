@extends('admin.admin_dashboard')
@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title text-center"><strong>Add Amentie</strong></h4>

                            <form id="myForm" class="forms-sample" method="POST" action="{{ route('store.amenitie') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="amenitis_name" class="form-label">Amenitie Name</label>
                                    <input type="text" class="form-control" name="amenitis_name"
                                    placeholder="Enter Amenitie Name">
                                </div>
                               
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{route('all.amenitie')}}" class="btn btn-secondary">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    amenitis_name: {
                        required : true,
                    }, 
                    
                },
                messages :{
                    amenitis_name: {
                        required : 'Please Enter Amentities Name',
                    }, 
                     
    
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>
    
@endsection
