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
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<span></span>
						<div class="pull-right">
							<a href="{{ $routeBackTo }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('product.tooltips.back-products') }}">
								<i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
								{!! trans($nameBackTo) !!}
							</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
					</div>
					<div class="card-body">

						<dl class="user-info">
							<dt>
								{{ trans('comment.show-comment.content') }}
							</dt>
							<dd>
								{{ $comment->content }}
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
