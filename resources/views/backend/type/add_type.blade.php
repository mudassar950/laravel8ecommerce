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

                            <h4 class="card-title text-center"><strong>Add Property Type</strong></h4>

                            <form class="forms-sample" method="POST" action="{{ route('store.type') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="type_name" class="form-label">Type Name</label>
                                    <input type="text" class="form-control @error('type_name') is-invalid @enderror" id="type_name" name="type_name" autocomplete="off"
                                    placeholder="Enter Type Name">
                                        @error('type_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="type_icon" class="form-label">Type Icon</label>
                                    <input type="text" name="type_icon" class="form-control @error('type_icon') is-invalid @enderror" id="type_icon" autocomplete="off" placeholder="Enter Type Icon">
                                    @error('type_icon')
                                            <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                               
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{route('all.type')}}" class="btn btn-secondary">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
