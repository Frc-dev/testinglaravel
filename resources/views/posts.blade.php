@foreach($posts as $post)
    {{$post->title}}
    {{Str::limit($post->body)}}
    <a href="/post/{{ $post->id }}">View Post Details</a>
@endforeach
