@extends('admin.admin_dashboard')
@section('admin')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    .form-check-label{
        text-transform: capitalize;
    }
</style>

    <div class="page-content">

        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title text-center"><strong>Edit Roles in Permissions</strong></h4>

                            <form id="myForm" class="forms-sample" method="POST" action="{{ route('admin.role.update',$roles->id) }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <h3>{{$roles->name}}</h3>
                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                        <label class="form-check-label" for="checkDefaultmain">All Permissions</label>
                                </div>

                                <hr>
                                
                                @foreach ($permission_groups as $group)
                                <div class="row">
                                    <div class="col-3">
                                        
                                        @php
                                            $permissions = App\Models\User::getPermissionByGroupName($group->group_name)
                                        @endphp

                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="checkDefault" {{App\Models\User::hasRolePermissions($roles,$permissions) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="checkDefault">{{$group->group_name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-9">

                                        
                                        @foreach ($permissions as $permission)
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="permission[]" id="checkDefault{{$permission->id}}" value="{{$permission->id}}" {{$roles->hasPermissionTo($permission->name) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="checkDefault{{$permission->id}}">{{$permission->name}}</label>
                                        </div>
                                        @endforeach
                                        <br>
                                    </div>
                                </div>
                                @endforeach
                               
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        $('#checkDefaultmain').click(function(){
            if($(this).is(':checked'))
            {
                $('input[type = checkbox]').prop('checked',true);
            }
            else
            {
                $('input[type = checkbox]').prop('checked',false);
            }
        });
    </script> --}}

@endsection
