@extends('layouts.app')

@section('title')
    Добавить статью
@endsection

@section('content')
    <div class="container">
    @include('inc.messages')

    <h1>Добавить статью</h1>
    <form action="{{ route('createPost') }}" method="post">
        @csrf
        <input type="text" name="title" id="title" placeholder="Введите заголовок" class="form-control" /> <br>
        <input type="text" name="description" id="description" placeholder="Введите описание" class="form-control" /> <br>
        <textarea rows="12" name="textPost" id="textPost" class="form-control" placeholder="Введите текст статьи"></textarea><br>
        <a class="btn btn-primary" href="{{ route('getPostList')}}" >К списку статей</a>
        <button type="submit" class="btn btn-success"> Добавить статью</button>
    </form>
    </div>
    <br>
@endsection
