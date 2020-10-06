@extends('layouts.app')

@section('title')
    Статья
@endsection

@section('content')
    <div class="container">
        @include('inc.messages')
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0 text-center">{{$data->title}}</h3>
                    <br>
                    <strong><p class="card-text mb-auto">{{ $data->description }}</p></strong> <br>
                    <p class="card-text mb-auto">{{ $data->text_post }}</p>
                    <small><div class="mb-1 text-muted">{{$data->created_at}} created by {{ $creatorName }} </div></small>
                    <br>
                    <div>
                        <a class="btn btn-primary" href="{{ route('getPostList')}}" >К списку статей</a>
                        @if((!Auth::guest())&&($data->user_id == Auth::user()->getAuthIdentifier()))
                            <a class="btn btn-primary" href="{{ route('getFormUpdate',$data->id) }}">Редактировать статью</a>
                            <a class="btn btn-danger" href="{{ route('deletePost',$data->id) }}">Удалить статью</a>
                        @endif
                    </div>

                </div>
            </div>
       @include('inc.commentList')
    </div>
@endsection



