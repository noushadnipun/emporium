@extends('admin.layouts.master')

@section('site-title')
Manage Purchase
@endsection

@section('page-content')


  <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Purchase</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Product Name</th>
                  <th>Qty</th>
                  <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchase as $data)
                <tr>
                  <td>{{$data->date}}</td>
                  <td>
                      {{\App\Models\Product::where('id', $data->product_id)->first()->title ?? NULL}}
                  </td>
                  <td>{{$data->qty}}</td>
                  <td> {{$data->price}}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

@endsection

@section('cusjs')
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- DataTables -->
    <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script> 

    <script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
@endsection