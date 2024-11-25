@extends('portal.master')
@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <p class="cat_title text_center">
                    {{ $tag }}
                </p>
            </div>
         @include('portal.includes.topAds')
            @foreach ($posts as $post)
                <div class="col-md-4 mb-3" style="">
                    <a href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
                        <div class="tag_image">
                            <img src="{{ $post->image}}" class="card-img-top"
                                alt="...">



                        <p class="tag_p">{{ $post->title ?? '' }}</p>
                    </div>



                    </a>
                </div>
            @endforeach
        </div>
        <ul class="pagination pagination m-1 float-right">
            <li class="page-item">{{ $posts->links() ?? '' }}</li>
        </ul>
    </div>


    @include('portal.includes.tenth')
    <div class="container">
        <div class="top_ad">
            @if ($afterNavAd)
            <div class="top_ad">
                <a target="_blank" href="{{ $afterNavAd->url ?? '#' }}">
                    <img src="{{ asset('uploads/images/ads/' . ($afterNavAd->image ?? 'default.jpg')) }}"
                        alt="">
                </a>
            </div>
            @else
            <!-- Handle the case when no ad is found -->
            <p>No ad available.</p>
            @endif
        </div>
    </div>
@endsection
