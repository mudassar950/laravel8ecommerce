@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.permission')}}" class="btn btn-inverse-info">Add Permission</a>
            &nbsp;&nbsp;&nbsp;
            <a href="{{route('import.permission')}}" class="btn btn-inverse-warning">Import</a>
            &nbsp;&nbsp;&nbsp;
            <a href="{{route('export')}}" class="btn btn-inverse-danger">Export</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Permissions</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th class="text-center">Sr#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Group Name</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($permissions as $key => $item)
          <tr>
            <td class="text-center">{{$key+1}}</td>
            <td class="text-center">{{$item->name}}</td>
            <td class="text-center">{{$item->group_name}}</td>
            <td class="text-center">
                <a href="{{route('edit.permission',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                <a href="{{route('delete.permission',$item->id)}}" id="delete" class="btn btn-inverse-danger">Delete</a>
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