@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        Sync!<br />
                        Try <a href="{{ route('sync') }}/reindex/deliverydates">Deliverydates</a><br />
                        Try <a href="{{ route('sync') }}/reindex/brands">Brands</a><br />
                        Try <a href="{{ route('sync') }}/reindex/suppliers">Suppliers</a><br />
                        Try <a href="{{ route('sync') }}/reindex/categories">Categories</a><br />
                        Try <a href="{{ route('sync') }}/reindex/types">Types</a><br />
                        Try <a href="{{ route('sync') }}/reindex/tags">Tags</a><br />
                        Try <a href="{{ route('sync') }}/reindex/reviews">Reviews</a><br />
                        Try <a href="{{ route('sync') }}/reindex/attributes">Attributes</a><br />
                        Try <a href="{{ route('sync') }}/reindex/typesattributes">TypesAttributes</a><br />
                        Try <a href="{{ route('sync') }}/reindex/categoriesproducts">CategoriesProducts</a><br />
                        Try <a href="{{ route('sync') }}/reindex/metafields">Metafields</a><br />
                        Try <a href="{{ route('sync') }}/reindex/variantsmovements">Movements</a><br />
                        <br />
                        Try <a href="{{ route('sync') }}/reindex/products">Products</a><br />
                        Try <a href="{{ route('sync') }}/reindex/variants">Variants</a><br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection