@foreach ($relatedPosts as $post)
<div class="news-card">
    <a href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
        <div class="news-image-container">
            <img src="{{ url('uploads/images/post/' . $post->image) ?? '' }}" class="card-img-top" alt="{{ $post->title ?? 'Post Image' }}">
        </div>

        <div class="news-card-body">
            <p class="card-text">{{ $post->title ?? '' }}</p>
        </div>
    </a>
</div>
@endforeach
