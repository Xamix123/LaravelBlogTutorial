<div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
        <h3 class="mb-0 text-center">Коментарии</h3>
        @if(empty($comments))
            <br>
            <div class="container">
                <p class="text-center">На данный момент ни одного комментария не было добавлено к данной статье</p>
            </div>
            <br>
        @else
            <br>
            <div class="container">
                <p class="text-right"> Общее количество комментариев({{ $countComments }})</p>
            </div>
            <br>
            @foreach($comments as $comment)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <section class=" bg-primary border border-dark post-heading">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class=" media">
                                        <div class="media-body">
                                            <strong class=" text-white media-heading">{{$comment->userName}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="bg-light border border-dark post-body">
                            <p>{{$comment->text_comment}}</p>
                            <p class="text-right">{{$comment->created_at}}</p>
                        </section>

                    </div>
                    <br>
            @endforeach
        @endif
        @if(! Auth::guest())
            @include('inc.commentAddForm')
        @endif
            </div>
    </div>
</div>
