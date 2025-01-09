@extends('admin.layuots')
@section('title','client')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">client</h3>
          <a href="{{route('clients.create')}}"
          class="btn btn-success float-right">new clients</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (session()->has('massage'))
            <div class="alert alert-success alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h5><i class="icon fas fa-check"></i> Scsses</h5>
               <h2>{{ session()->get('massage')}}</h2>
            </div>
           @endif
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">id</th>
                <th>name</th>
                <th>covre</th>
                <th>jop</th>
                <th >Create Data</th>
               <th >Update Data</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $clients)
                <tr>
                <td>{{$clients->id}}</td>
                <td>{{$clients->name}}</td>
                <td><img style="height:60px; width:60px;"
                     src="{{Storage::url('clients/'.$clients->covre)}}"></td>
                <td>{{$clients->jop}}</td>
                <td>{{$clients->created_at}}</td>
                <td>{{$clients->updated_at}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('clients.edit',$clients->id)}}" class="btn btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                                <form action="{{route('clients.destroy',$clients->id)}}" method="POST">
                                     @csrf @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                               </form>
                        </div>
                </td>
              </tr>
                @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div>
</div>
@endsection
