@extends('layouts.app')

@section('template_title')
    {!! trans('comment.showing-all-comments') !!}
@endsection

@section('template_linked_css')
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('comment.showing-all-comments') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('comment.comments-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/comments/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        {!! trans('comment.buttons.create-new') !!}
                                    </a>
                                    <a class="dropdown-item" href="/comments/deleted">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        {!! trans('comment.show-deleted-comments') !!}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('comment.enableSearchUsers'))
                            @include('partials.search-users-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="comment_count">
                                    {{ trans_choice('comment.table.caption', 1, ['commentscount' => $comments->count()]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('comment.table.id') !!}</th>
                                    <th>{!! trans('comment.table.content') !!}</th>
                                    <th class="hidden-xs">{!! trans('comment.table.approved') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('comment.table.created') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('comment.table.updated') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="comment_table">
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>{{$comment->content}}</td>
                                        <td>
                                        <div class="col-sm-7">
                                            @if ($comment->seen == 1)
                                                <a class="btn btn-sm btn-block" href="{{ URL::to('comments/rejected/' . $comment->id) }}" data-toggle="tooltip" title="Show">
                                        <span class="badge badge-success">
                                            Approved
                                        </span>
                                                </a>
                                            @else
                                                <a class="btn btn-sm btn-block" href="{{ URL::to('comments/approved/' . $comment->id) }}" data-toggle="tooltip" title="Show">
                                        <span class="badge badge-danger">
                                            Rejected
                                        </span>
                                                </a>
                                            @endif
                                        </div>
                                        </td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$comment->created_at}}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$comment->updated_at}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'comments/' . $comment->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('comment.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete comment', 'data-message' => 'Are you sure you want to delete this comment ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('comments/' . $comment->id) }}" data-toggle="tooltip" title="Show">
                                                {!! trans('comment.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('comments/' . $comment->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                {!! trans('comment.buttons.edit') !!}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('comment.enableSearchUsers'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('comment.enablePagination'))
                                {{ $comments->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($comments) > config('comment.datatablesJsStartCount')) && config('comment.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('comment.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('comment.enableSearchUsers'))
        @include('scripts.search-users')
    @endif
@endsection
