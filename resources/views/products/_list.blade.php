<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('product.showing-all-products') !!}
                            </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">
                                        {!! trans('product.products-menu-alt') !!}
                                    </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/products/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('product.buttons.create-new') !!}
                                </a>
                                <a class="dropdown-item" href="/products/deleted">
                                    <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                    {!! trans('product.show-deleted-products') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if(config('product.enableSearchUsers'))
                        @include('partials.search-users-form')
                    @endif

                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="product_count">
                                {{ trans_choice('product.table.caption', 1, ['productscount' => $products->count()]) }}
                            </caption>
                            <thead class="thead">
                            <tr>
                                <th>{!! trans('product.table.id') !!}</th>
                                <th>{!! trans('product.table.name') !!}</th>
                                <th class="hidden-xs">{!! trans('product.table.description') !!}</th>
                                <th class="hidden-sm hidden-xs hidden-md">{!! trans('product.table.created') !!}</th>
                                @role('admin', true)
                                <th class="hidden-sm hidden-xs hidden-md">{!! trans('product.table.updated') !!}</th>
                                @endrole
                                <th class="no-search no-sort"></th>
                                @role('admin', true)
                                <th class="no-search no-sort"></th>
                                @endrole

                            </tr>
                            </thead>
                            <tbody id="product_table">
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td class="hidden-xs">{{$product->description}}</td>
                                    <td class="hidden-sm hidden-xs hidden-md">{{$product->created_at}}</td>
                                    @role('admin', true)
                                    <td class="hidden-sm hidden-xs hidden-md">{{$product->updated_at}}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'products/' . $product->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button(trans('product.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete product', 'data-message' => 'Are you sure you want to delete this product ?')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    @endrole
                                    <td>
                                        <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('products/show/' . $product->id) }}" data-toggle="tooltip" title="Show">
                                            {!! trans('product.buttons.show') !!}
                                        </a>
                                    </td>
                                    @role('admin', true)
                                    <td>
                                        <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('products/' . $product->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                            {!! trans('product.buttons.edit') !!}
                                        </a>
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                            </tbody>
                            <tbody id="search_results"></tbody>
                            @if(config('product.enableSearchUsers'))
                                <tbody id="search_results"></tbody>
                            @endif

                        </table>

                        @if(config('product.enablePagination'))
                            {{ $products->links() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
