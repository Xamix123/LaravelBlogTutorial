@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" col row mb-2">
            <a class="btn btn-primary" href="{{ route('getFormAdd') }}">Создать статью</a>
        </div>
        @include('inc.messages')
        @if(empty($data))
            <p>Ни одна статья не была добавлена</p>
        @else
            @foreach($data as $element)
                <div class="row mb-2">
                    <div class="col">
                        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <h3 class="mb-0">{{$element->title}}</h3>
                                <div class="mb-1 text-muted">{{$element->created_at}}</div>
                                <p class="card-text mb-auto">{{ $element->description }}</p>
                                <p class="text-right card-text mb-auto">Комментарии({{ $element->count }})</p>
                                <a href="{{ route('getPost', $element->id)}}" class="stretched-link">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                {{--Pagination --}}
                <div class="d-flex justify-content-center">
                    {!! $data->links() !!}
                </div>
        @endif
    </div>
@endsection



