@extends('admin.layouts.master')

@section('site-title')
Product Purchase
@endsection

@section('page-content')

   <form id="productForm" role="form" method="POST" action ="{{ (!empty($purchase)) ? route('admin_purchase_product_update') : route('admin_purchase_product_store') }}" senctype="multipart/form-data">
    @csrf
    @if(!empty($product))
        <input type="hidden" name="id" value="{{$purchase->id}}" />
    @endif
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header card-info">
                    <h3 class="card-title panel-title float-left">Purchase Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="text" class="form-control form-control-sm" name="date" autocomplete="off" value="{{!empty($purchase->id) ? $purchase->date : date('Y-m-d') }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Product</label>
                                <select name="product_id" id="select2Product" class="form-control form-sontrol-sm" data-placeholder="Select a product" data-dropdown-css-class="select2-dark" required>
                                    <option value=""></option>
                                    @php 
                                        $products = \App\Models\Product::orderBy('id', 'desc')->get();
                                    @endphp
                                    @foreach($products as $data)
                                        <option value="{{$data->id}}">{{$data->title}} - {{$data->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="">Qty</label>
                            <input type="number" name="qty" class="form-control form-control-sm" value="{{!empty($purchase->id) ? $purchase->qty : '' }}" required>
                        </div>

                         <div class="col-md-3">
                            <label for="">Purchase Price</label>
                            <input type="number" name="price" class="form-control form-control-sm" value="{{!empty($purchase->id) ? $purchase->price : '' }}" required>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
 
    </div>        
</form> 


@endsection

@section('cusjs')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<!-- Latest compiled and minified JavaScript -->  
<link href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>

<script>
    /**
     *Brand Select 2 Script 
     * 
     */
    //Select 2
    function selectRefresh() {
        $('select#select2Product').select2({
            allowclear : true,
        });
    } 
    selectRefresh();


</script>


@endsection