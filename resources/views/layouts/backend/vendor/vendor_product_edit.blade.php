@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    
                </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="card card-primary col-10 offset-1" style="padding-top: 8px;
                            border: 1px solid #ddd;
                            padding-bottom: 8px;
                        ">
                    <div class="card-header" style="background-color: #007bff;
                        color: #fff;">
                        <h3 class="card-title">Update Vendor Product Info</h3>
                        <button class="close" aria-label="Close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('vendor.product.update', $product->slug) }}" method="POST">
                            @csrf

                            <div class="card-body row col-12">
                                <div class="row col-12">
                                    @if ($product->get_vendor != null)
                                    <div class="form-group col-12">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Select Vendor</label>
                                        <select class="form-control" name="vendor_id" id="vendor_id" required>
                                            <option value="{{ $product->get_vendor->id }}" selected="selected" hidden>
                                                {{ $product->get_vendor->brand_name }}</option>
                                            @foreach ($vendors as $vendor)
                                                @if ($vendor->user_id == auth()->user()->id)
                                                <option value="{{ $vendor->id }}">
                                                    {{ $vendor->brand_name }}
                                                </option>
                                                    
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($product->get_single_vendor != null)
                                    <div class="form-group col-12">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Select Single Vendor</label>
                                        <select class="form-control" name="single_vendor_id" id="single_vendor_id" required>
                                            <option value="{{ $product->get_single_vendor->id }}" selected="selected"
                                                hidden>{{ $product->get_single_vendor->brand_name }}</option>
                                            @foreach ($single_vendors as $single)
                                                @if ($vendor->user_id == auth()->user()->id)
                                                <option value="{{ $single->id }}">
                                                    {{ $single->brand_name }}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                </div>
                                <div class="row col-12">
                                    <div class="form-group col-3">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Product Name</label>
                                        <input value="{{ $product->product_name }}" id="product_name" name="product_name"
                                            type="text" class="form-control" placeholder="Enter product name" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Product Code</label>
                                        <input value="{{ $product->product_code }}" id="product_code" name="product_code"
                                            type="text" class="form-control" placeholder="Enter product code" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Product Color</label>
                                        <input value="{{ $product->color }}" id="color" name="color" type="text"
                                            class="form-control" placeholder="Enter product color" />
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Admin Commission</label>
                                        <input value="{{ $product->admin_percent }}" id="admin_percent" name="admin_percent"
                                            type="number" step="any" class="form-control"
                                            placeholder="0.00%" />
                                    </div>
                                </div>
                                <div class="form-group row col-12">
                                    <div class="form-group col-6">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">
                                            Indoor Shipping Charege
                                        </label>
                                        <input
                                            value="{{$product->indoor_charge}}"
                                            id="indoor_charge"
                                            name="indoor_charge"
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="indoor charge"
                                        />
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">
                                            Outdoor Shipping Charege
                                        </label>
                                        <input
                                            value="{{$product->outdoor_charge}}"
                                            id="outdoor_charge"
                                            name="outdoor_charge"
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="outdoor charge"
                                        />
                                    </div>
                                    
                                    
                                </div>
                                <div class="form-group row col-12">
                                    <div class="col-12">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Product Description</label>
                                        <textarea id="description" class="textarea" name="description" type="text" class="form-control"
                                            placeholder="Enter product description">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button id="submit" type="submit" style="width: 100%" class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>

                </div>


            </div>
    </div>
@endsection

