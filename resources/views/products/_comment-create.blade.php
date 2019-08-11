<div class="col-12 col-sm-8 col-md-9">
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active edit-profile-tab" role="tabpanel" aria-labelledby="edit-profile-tab">
            {!! Form::open(array('route' => ['comments.user.create', $product->id], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('content') ? ' has-error ' : '' }}">
                {!! Form::label('location', trans('comment.label-content') , array('class' => 'col-12 control-label')); !!}
                <div class="col-12">
                    {!! Form::text('content', old('content'), array('id' => 'content', 'class' => 'form-control', 'placeholder' => trans('profile.ph-location'))) !!}
                    <span class="glyphicon {{ $errors->has('location') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group margin-bottom-2">
                <div class="col-12">
                    {!! Form::button(
                        '<i class="fa fa-fw fa-save" ></i> ' . trans('forms.comment_button_text'),
                         array(
                            'id'                => 'confirmFormSave',
                            'class'             => 'btn btn-success',
                            'type'              => 'submit'
                    )) !!}

                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
