@extends('layouts.app')

@section('title')
    Редактировать статью
@endsection

@section('content')

    @include('inc.messages')

    <h1>Редактировать статью</h1>

    <form action="{{ route('updatePost',$data->id) }}" method="post">
        @csrf
        <input type="text" name="title" id="title" value="{{ $data->title }}" placeholder="Введите заголовок" class="form-control" /> <br>
        <input type="text" name="description" id="description" value="{{ $data->description }}" placeholder="Введите описание" class="form-control" /> <br>
        <textarea rows="12" name="textPost" id="textPost" class="form-control" placeholder="Введите текст статьи">{{ $data->text_post }}</textarea><br>
        <a class="btn btn-primary" href="{{ route('getPostList')}}" >К списку статей</a>
        <button type="submit" class="btn btn-success"> Обновить статью</button>
    </form>
    <br>
@endsection
