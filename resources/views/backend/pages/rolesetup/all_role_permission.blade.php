@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.role.permission')}}" class="btn btn-inverse-info">Add Roles in Permissions</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Roles in Permissions</h6>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">Sr#</th>
            <th class="text-center">Role Name</th>
            <th class="text-center">Permission</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $key => $item)
          <tr>
            <td class="text-center">{{$key+1}}</td>
            <td class="text-center">{{$item->name}}</td>
            <td class="text-center">
                @foreach ($item->permissions as $perm)
                    <span class="badge bg-danger">{{$perm->name}}</span>
                @endforeach    
            </td>
            <td class="text-center">
                <a href="{{route('admin.edit.role.permission',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                <a href="{{route('admin.delete.role',$item->id)}}" id="delete" class="btn btn-inverse-danger">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
        </div>
    </div>

</div>


@endsection