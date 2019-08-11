
<div class="table-responsive users-table">
    <table class="table table-striped table-sm data-table">
        <caption id="comment_count">
            {{ trans_choice('comment.table.caption', 1, ['commentscount' => $comments->count()]) }}
        </caption>
        <thead class="thead">
            <tr>
                <th>{!! trans('comment.table.id') !!}</th>
                <th>{!! trans('comment.table.content') !!}</th>
                @role('admin', true)
                <th>{!! trans('comment.table.approved') !!}</th>
                <th class="hidden-sm hidden-xs hidden-md">{!! trans('comment.table.created') !!}</th>
                <th class="hidden-sm hidden-xs hidden-md">{!! trans('comment.table.updated') !!}</th>
                <th class="no-search no-sort"></th>
                <th class="no-search no-sort"></th>
                @endrole
            </tr>
        </thead>
        <tbody id="comment_table">
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->content}}</td>
                    @role('admin', true)
                    <td>
                            <div class="col-sm-7">
                                @if ($comment->seen == 1)
                                    <a class="btn btn-sm btn-block" href="{{ URL::to('comments/rejected/' . $comment->id.'?toProduct') }}" data-toggle="tooltip" title="rejected">
                                        <span class="badge badge-success">
                                            Approved
                                        </span>
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-block" href="{{ URL::to('comments/approved/' . $comment->id.'?toProduct') }}" data-toggle="tooltip" title="approved">
                                        <span class="badge badge-danger">
                                            Rejected
                                        </span>
                                    </a>
                                @endif
                            </div>
                    </td>
                    <td>
                        {!! Form::open(array('url' => 'comments/' . $comment->id.'?toProduct', 'class' => '', 'title' => 'Delete')) !!}
                            {!! Form::button(trans('comment.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'submit', 'style' =>'width: 100%;' , 'data-title' => 'Delete comment')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            @csrf
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('comments/' . $comment->id.'?toProduct') }}" data-toggle="tooltip" title="Show">
                            {!! trans('comment.buttons.show') !!}
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('comments/' . $comment->id . '/edit?toProduct') }}" data-toggle="tooltip" title="Edit">
                            {!! trans('comment.buttons.edit') !!}
                        </a>
                    </td>
                    @endrole
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@role('user', true)
    @include('products._comment-create', ['product' => $product])
@endrole
