<form action="/store-post" method="post">
    {{ csrf_field() }}
    <input type="text" name="title">

    <textarea name="body"> </textarea>

    <button>Save Post</button>
</form>
