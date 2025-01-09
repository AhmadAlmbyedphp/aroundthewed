@extends('admin.layuots')
@section('title','created portfolis')
@section('content')
  <div class="col-em-12">
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('portfolis.store')}}"  method="POST"
              enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                 <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">×</button>
                   <h5><i class="icon fas fa-ban"></i> Errors!</h5>
                    @foreach ( $errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                 </div>
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input   name="name" value="{{old('name')}}"
                    type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label
                    for="exampleInputPassword1">descrediten</label>
                    <input name="descrediten" value="{{old('descrediten')}}"
                     type="text" class="form-control" id="exampleInputPassword1" placeholder="descrediten">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile"></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="covre"
                         type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div  class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
  </div>
@endsection
