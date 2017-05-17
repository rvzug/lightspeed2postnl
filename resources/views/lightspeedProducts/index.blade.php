@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>
                    <div class="panel-body">
                        @if($products->count() > 0)
                        <table>
                            <tr>
                                <td>Product</td>
                                <td>Description</td>
                                <td>&nbsp;</td>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->title  }}</td>
                                    <td>
                                        @if($product->visibility == 'hidden')
                                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true" style="color:red;"></span>
                                        @elseif($product->visibility == 'auto')
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color:orange;"></span>
                                        @else
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color:green;"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('lightspeedproducts.show', $product) }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                        <a href="{{ route('lightspeedproducts.edit', $product) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="{{ route('lightspeedproducts.packages.index', $product) }}"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></a>
                                        <a href="{{ route('lightspeedproducts.destroy', $product) }}" onclick="return confirm({{ __('Are you sure you want to delete this product?') }})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        @else
                        <p>{{ __('No products found') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection