@extends('portal.master')
@section('content')
    <h3 style="text-align: center; margin-top: 4rem; " data-animation-name="customAnimationIn">Information Technology News</h3>
    <div class="container news-container">

        @foreach ($itnews as $post)
            <div class="news-card" style="">
                <a href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
                <div class="news-image-container">
                    <img src="{{ url('uploads/images/post/' . $post->image) ?? '' }}" class="card-img-top" alt="...">
                </div>

                <div class="news-card-body">
                    <p class="card-text">{{ $post->title ?? '' }}</p>
                </div>
            </a>
            </div>
        @endforeach

    </div>
@endsection

