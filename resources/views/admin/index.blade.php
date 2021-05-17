@extends('admin.layouts.master')

@section('page-content')
@php
    
@endphp
<?php
$totalProduct = count(\App\Models\Product::get());
$totalProductCat = count(\App\Models\ProductCategory::get());
$totalProductBrand = count(\App\Models\ProductBrand::get());
$totalOrder = count(\App\Models\ProductOrder::get());
$totalPaymentPendingOrder = count(\App\Models\ProductOrder::where('payment_status', 'Pending')->get());


?> 
    <div class="row">

        <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="{{route('admin_product_index')}}">
                <div class="small-box alert-success">
                    <div class="inner">
                        <h3>{{$totalProduct}}</h3>

                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="{{route('admin_product_category_index')}}">
                <div class="small-box alert-secondary">
                    <div class="inner">
                        <h3>{{$totalProductCat}}</h3>

                        <p>Categories Stored</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-info"></i>
                    </div>    
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="{{route('admin_product_brand_index')}}">
                <div class="small-box alert-dark">
                    <div class="inner">
                        <h3>{{$totalProductBrand}}</h3>

                        <p>Brand Stored</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-info"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->

         <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="{{route('admin_product_order_index')}}" class="small-box-footer">
                <div class="small-box alert-primary">
                    <div class="inner">
                        <h3>{{$totalOrder}}</h3>

                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bag"></i>
                    </div>
                </div>
             </a>
        </div>
        <!-- ./col -->


         <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box alert-warning">
                <form method="get" action="{{route('admin_product_order_filter')}}" class="">
                    @csrf
                    <input type="hidden" name="payment_status" value="Pending" />
                    <button type="submit" class="btn btn-sm text-left">
                        <div class="inner">
                            <h3>{{$totalPaymentPendingOrder}}</h3>

                            <p>Total Pending Payment Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bag"></i>
                        </div>
                    </button>
                </form>
            </div>
        </div>
        <!-- ./col -->
    </div>
    
@endsection