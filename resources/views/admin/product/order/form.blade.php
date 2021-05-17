@extends('admin.layouts.master')

@section('site-title')
Create Custom Order
@endsection

@section('page-content')

<div class="card card-purple card-outline">
        <div class="card-header">
            {{!empty($saleValue->id) ? 'Edit Service' : 'Add Service'}}
        </div>
        <form method="post" action="{{!empty($saleValue->id) ? route('admin_product_order_update') : route('admin_product_order_store') }}"  id="createOrderForm">
            @csrf
            @if(!empty($saleValue->id))
                <input type="hidden" name="id" value="{{$saleValue->id}}">
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Call No</label>
                            <input type="text" class="form-control" name="call_no" autocomplete="off" value="{{!empty($saleValue->id) ? $saleValue->call_no : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Call Date</label>
                            <input type="text" class="form-control" id="call_datepicker" name="call_date" value="{{!empty($saleValue->id) ? $saleValue->call_date : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Pull Date</label>
                            <input type="text" class="form-control" id="pull_datepicker" name="pull_date" value="{{!empty($saleValue->id) ? $saleValue->pull_date : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Delivery Date</label>
                            <input type="text" class="form-control" id="delivery_datepicker" name="delivery_date" value="{{!empty($saleValue->id) ? $saleValue->delivery_date : '' }}">
                        </div>
                    </div>
                </div>
                <div class="row" id="outletvalueEmpty">
                    <div class="col-md-3">
                        <label for="">Choose Visi ID</label> 
                        <span class="editoutlet"></span>
                        <a href="" class="addnewoutlet badge badge-warning float-right" data-toggle="modal" data-target="#exampleModal">Add New</a>

                        <select id="showOutletRecord" name="outlet_id" xdata-live-search="true" class="form-control showOutletInfo showAlert" xdata-size="10" required>
                            @if(!empty($saleValue->id))
                                @php
                                    $saleValueVisiID = App\Outlet::where('id', $saleValue->outlet_id)->first();
                                @endphp
                                @if(!empty($saleValueVisiID))
                                    <option value="{{$saleValueVisiID->id}}" class="text-white bg-success" selected>{{$saleValueVisiID->visi_id}}</option>
                                @endif
                            @else
                                
                            @endif
                        </select>

                        <div class="p-3 bg-white text-dark text-md" id="outletDataEmpty">

                                @if(!empty($saleValue))
                                    @php
                                        $getOutlet = App\Outlet::where('id', $saleValue->outlet_id)->first();
                                        if(!empty($getOutlet)){
                                            $getDistributor = App\Distributor::where('id', $getOutlet->distributor_id)->first();
                                        }
                                    @endphp
                                @endif

                                <div class="font-weight-bold"> 
                                    <span class="outlet-address">
                                        {{!empty($saleValue) && $getOutlet ? 'Address: '.$getOutlet->address : '' }}
                                    </span> 
                                </div>
                                <div class="font-weight-bold"> 
                                    <span class="outlet-mobile">
                                        {{!empty($saleValue) && $getOutlet ? 'Mobile: '.$getOutlet->mobile : '' }}
                                    </span> 
                                </div>
                                <div class="font-weight-bold"> 
                                    <span class="outlet-distributor">
                                        
                                    </span> 
                                </div>
                                <div class="outlet-previous-service"></div>
                        </div>
                    </div>

                </div>

                <table class="table" id="productTable">
                    <thead>
                        <tr>			  			
                            <th style="width:40%;">Product</th>
                            <th style="width:20%;">Rate</th>
                            <th style="width:15%;">Quantity</th>			  			
                            <th style="width:15%;">Total</th>			  			
                            <th style="width:10%;">
                                <button type="button" class="btn btn-default addRowBtn" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus text-success"></i> </button>

                                <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="fa fa-undo text-warning"></i></button>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(!empty($saleValue->id))
                            {{-- Update Form  --}}
                            @php
                                $getThisSaleItem = App\SaleItem::where('sales_id', $saleValue->id)->get();
                            @endphp
                            @foreach($getThisSaleItem as $data)
                            @if(!empty($saleValue->id))
                                <input type="hidden" name="item_id[]" value="{{$data->id}}">
                             @endif
                                <?php
                                    $arrayNumber = 0;
                                    //for($x = 1; $x < 2; $x++) { 
                                        $x = $data->id.'00';
                                    ?>
                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                            <td style="margin-left:20px;">
                                                <div class="form-group">
                                                    <select class="form-control" name="service_id[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" xdata-live-search="true" data-size="8" required>
                                                        <option value="">~~SELECT~~</option>
                                                        <?php
                                                            $productData = App\Service::orderBy('id', 'DESC')->get();

                                                            foreach($productData as $row) { ?>									 		
                                                                <option value="{{ $row['id'] }}" id="changeProduct{{$row['id']}}" {{ $row['id'] == $data->service_id ? 'selected' : '' }} >{{$row['name']}}</option>
                                                                }  

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="padding-left:20px;">	
                                                @php
                                                    $getSeviceRate = App\Service::where('id', $data->service_id)->first();
                                                @endphp		  					
                                                <input type="text" xname="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="{{$getSeviceRate->rate}}" />			  					
                                                <input type="hidden" xname="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                            </td>
                                            <td style="padding-left:20px;">
                                                <div class="form-group">
                                                <input type="number" name="service_qty[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" required value="{{$data->service_qty}}"/>
                                                </div>
                                            </td>
                                            <td style="padding-left:20px;">			  					
                                                <input type="text" xname="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="{{$data->service_qty * $getSeviceRate->rate}}" />			  					
                                                <input type="hidden" xname="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                            </td>
                                            <td>

                                                <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash text-danger"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                    $arrayNumber++;
                                    //} // /for
                                ?>
                            @endforeach
                            {{-- End Update Form  --}}
                        @else
                        <?php
                        //Craete Forrm
                        $arrayNumber = 0;
                        for($x = 1; $x < 2; $x++) { ?>
                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                <td style="margin-left:20px;">
                                    <div class="form-group">
                                        <select class="form-control xselectpicker" name="service_id[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" xdata-live-search="true" data-size="8" required>
                                            <option value="">~~SELECT~~</option>
                                            <?php
                                                $productData = App\Service::orderBy('id', 'DESC')->get();

                                                foreach($productData as $row) {									 		
                                                    echo "<option value='".$row['id']."' id='changeProduct".$row['id']."'>".$row['name']."</option>";
                                                    } // /while 

                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td style="padding-left:20px;">			  					
                                    <input type="text" xname="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
                                    <input type="hidden" xname="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>
                                <td style="padding-left:20px;">
                                    <div class="form-group">
                                    <input type="number" name="service_qty[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" required />
                                    </div>
                                </td>
                                <td style="padding-left:20px;">			  					
                                    <input type="text" xname="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
                                    <input type="hidden" xname="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>
                                <td>

                                    <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                        <?php
                        $arrayNumber++;
                        } // /for
                        //End Create Form
                        ?>
                        @endif  
                    </tbody>
                    
                </table>
                
                <div class="row clearfix float-right" style="margin-right: 10%;">
                    <div class="col-md-12">
                        <table class="table-bordered table-hover mt-3">
                            <tbody>               
                                <tr class="d-none">
                                    <th class="text-center p-3">Sub Total</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true"/>
                                        <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">VAT 13%</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                                        <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                                    </td>
                                </tr>

                                <tr class="d-none">
                                    <th class="text-center p-3">Total Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="{{!empty($saleValue->id) ? $saleValue->grand_total + $saleValue->discount : '' }}" />
                                        <input type="hidden" class="form-control" id="totalAmountValue" xname="totalAmountValue" value="{{!empty($saleValue->id) ? $saleValue->grand_total + $saleValue->discount : '' }}" />
                                    </td>
                                </tr>

                                <tr class="d-none">
                                    <th class="text-center p-3">Discount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="{{!empty($saleValue->id) ? $saleValue->discount : '' }}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center p-3">Grand Total</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="{{!empty($saleValue->id) ? $saleValue->grand_total : '' }}"/>
                                        <input type="hidden" class="form-control" id="grandTotalValue" name="grand_total" value="{{!empty($saleValue->id) ? $saleValue->grand_total : '' }}" />
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">Paid Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="paid" name="paid_amount" autocomplete="off" onkeyup="paidAmount()" autocomplete="off" value="{{!empty($saleValue->id) ? $saleValue->paid_amount : '' }}"/>
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">Due Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="due" name="due" disabled="true" value="{{!empty($saleValue->id) ? $saleValue->grand_total - $saleValue->paid_amount : '' }}" />
                                        <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="{{!empty($saleValue->id) ? $saleValue->grand_total - $saleValue->paid_amount : '' }}" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!--/col-md-6-->
                
                </div>
                

            </div>
            <div class="card-footer">
                <div class="row clearfix submitButtonFooter float-right mr-5">
                    <div class="col-md-10">
                        <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection