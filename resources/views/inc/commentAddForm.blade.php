<form action="{{ route('addComment',$data->id) }}" method="post">
    @csrf
    <textarea minlength="2" maxlength="300" name="textComment" id="textComment" class="form-control" placeholder="Введите коментарий"></textarea><br>
    <button type="submit" class="btn btn-success"> Отправить</button>
</form>
