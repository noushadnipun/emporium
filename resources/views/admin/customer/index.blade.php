@extends('admin.layouts.master')
@section('site-title')
Customer
@endsection

@section('page-content')
    @include('admin.layouts.message')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ (!empty($editUser)) ? route('admin_customer_update') : route('admin_customer_store') }}" method="POST">
                @csrf
                @if(!empty($editUser))
                    <input type="hidden" name="id" value="{{$editUser->id}}">
                @endif
                <div class="card card-purple card-outline">
                    <div class="card-header {{ (!empty($editUser)) ? 'bg-purple text-white' : '' }}">
                        <h3 class="card-title">{{ (!empty($editUser)) ? 'Edit ' : 'Add' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" id="" placeholder="Enter Name" value="{{ (!empty($editUser)) ? $editUser->name : old('name') }}" required>
                        </div>
                     
                        <div class="form-group">
                            <label for="Phone">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-sm" id="" placeholder="Enter Phone Number" value="{{ (!empty($editUser)) ? $editUser->phone : old('phone') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" name="address" class="form-control form-control-sm" id="" placeholder="Enter Address" value="{{ (!empty($editUser)) ? $editUser->address : old('address') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="fb_url">Facebook Url</label>
                            <input type="text" name="fb_url" class="form-control form-control-sm" id="" placeholder="Enter Facebook Url" value="{{ (!empty($editUser)) ? $editUser->fb_url : old('postcode') }}">
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-purple">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- End Col  4 -->
        <div class="col-md-8">
            <div class="card card-primary card-outline">
            <div class="card-header">
            <h3 class="card-title">All Customer Records </h3> <a href="{{ route('admin_customer_index') }}" class=" ml-1 btn-xs btn-success" title="Add New">  <i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customDataTable" class="table table-bordered table-hover table-head-fixed">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Fb Url</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getUser as $key => $data)  {?>
                <tr>
                    <td>{{ $data->id  }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->address}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->fb_url}}</td>
                    <td>
                        <a href="{{route('admin_customer_edit', $data->id)}}" class="badge alert-success" title="Edit"><i class="fa fa-pen"></i></a>  
                        <a href="{{route('admin_customer_delete', $data->id)}}" class="badge alert-danger" onclick="return confirm('Are you sure want to Delete?')" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>


@endsection