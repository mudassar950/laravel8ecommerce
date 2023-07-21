@extends('admin.admin_dashboard')
@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('export')}}" class="btn btn-inverse-danger">Download Xlsx</a>
            </ol>
        </nav>


        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title text-center"><strong>Import Permission</strong></h4>

                            <form id="myForm" class="forms-sample" method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="import_file" class="form-label">Import Xlsx File</label>
                                    <input type="file" class="form-control" name="import_file">
                                </div>
                               
                                <button type="submit" class="btn btn-warning me-2">Import</button>
                                <a href="{{route('all.permission')}}" class="btn btn-secondary">Cancel</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
