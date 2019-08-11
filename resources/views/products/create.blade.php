@extends('layouts.app')

@section('template_title')
    {{ trans('product.templateTitle') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span></span>
                        <div class="pull-right">
                            <a href="{{ route('products') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('product.tooltips.back-products') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('product.buttons.back-to-products') !!}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body p-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-3 profile-sidebar text-white rounded-left-sm-up">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" data-toggle="pill" href=".edit-profile-tab" role="tab" aria-controls="edit-profile-tab" aria-selected="true">
                                                {{ trans('product.createproduct') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active edit-profile-tab" role="tabpanel" aria-labelledby="edit-profile-tab">
                                                {!! Form::model($product, ['method' => 'POST', 'route' => ['products.store'], 'id' => 'product_form', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                                    {{ csrf_field() }}
                                                    <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error ' : '' }}">
                                                        {!! Form::label('location', trans('product.label-name') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('profile.ph-location'))) !!}
                                                            <span class="glyphicon {{ $errors->has('location') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="margin-bottom-2 form-group has-feedback {{ $errors->has('description') ? ' has-error ' : '' }}">
                                                        {!! Form::label('description', trans('product.label-description') , array('class' => 'col-12 control-label')); !!}
                                                        <div class="col-12">
                                                            {!! Form::text('description', old('description'), array('id' => 'description', 'class' => 'form-control', 'placeholder' => trans('product.ph-description'))) !!}
                                                            <span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
                                                            @if ($errors->has('description'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('description') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group margin-bottom-2">
                                                        <div class="col-12">
                                                            {!! Form::button(
                                                                '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('forms.product_button_text'),
                                                                 array(
                                                                    'id'                => 'confirmFormSave',
                                                                    'class'             => 'btn btn-success',
                                                                    'type'              => 'button',
                                                                    'data-target'       => '#confirmForm',
                                                                    'data-modalClass'   => 'modal-success',
                                                                    'data-toggle'       => 'modal',
                                                                    'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                                                    'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                                            )) !!}

                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-form')

@endsection

@section('footer_scripts')

    @include('scripts.form-modal-script')

    <script type="text/javascript">

        $('.dropdown-menu li a').click(function() {
            $('.dropdown-menu li').removeClass('active');
        });

        $('.profile-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-default');
        });

        $('.settings-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-info');
        });

        $('.admin-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
            $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
            $('#changepw')
                .addClass('active')
                .addClass('in');
            $('.change-pw').addClass('active');
        });

        $('.warning-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
        });

        $('.danger-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-danger');
        });

        $('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
            $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
        });

        $('#user_profile_form').on('keyup change', 'input, select, textarea', function(){
            $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
        });

        $('#checkConfirmDelete').change(function() {
            var submitDelete = $('#delete_account_trigger');
            var self = $(this);

            if (self.is(':checked')) {
                submitDelete.attr('disabled', false);
            }
            else {
                submitDelete.attr('disabled', true);
            }
        });

    </script>

@endsection
