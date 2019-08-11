@extends('layouts.app')

@section('template_title')
	{{ $product->name }}'s Product
@endsection

@section('template_fastload_css')

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="card">
					<div class="card-header">
						<div style="display: flex; justify-content: space-between; align-items: center;">
							{{ $product->name }}
							<div class="pull-right">
								@role('admin', true)
								<a href="{{ route('products') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('product.tooltips.back-products') }}">
									<i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
									{!! trans('product.buttons.back-to-products') !!}
								</a>
								@endrole
								@role('user', true)
								<a href="{{ route('public.home') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('product.tooltips.back-products') }}">
									<i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
									{!! trans('product.buttons.back-to-products') !!}
								</a>
								@endrole

							</div>
						</div>
					</div>
					<div class="card-body">

						<dl class="product-info">
							<dt>
								{{ trans('product.show-product.name') }}
							</dt>
							<dd>
								{{ $product->name }}
							</dd>
							<dt>
								{{ trans('product.show-product.description') }}
							</dt>
							<dd>
								{{ $product->description }}
							</dd>
							<dt>
								{{ trans('product.show-product.comments') }}
							</dt>
							<dd>
								@include('products._comment-list', ['comments' => $comments, 'product' => $product])
							</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')

@endsection
