@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.type')}}" class="btn btn-inverse-info">Add Property Type</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Property Types</h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th class="text-center">Sr#</th>
            <th class="text-center">Type Name</th>
            <th class="text-center">Type Icon</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($types as $key => $item)
          <tr>
            <td class="text-center">{{$key+1}}</td>
            <td class="text-center">{{$item->type_name}}</td>
            <td class="text-center">{{$item->type_icon}}</td>
            <td class="text-center">
                <a href="{{route('edit.type',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                <a href="{{route('delete.type',$item->id)}}" id="delete" class="btn btn-inverse-danger">Delete</a>
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