{{-- For Breaking News --}}

<div class="container">
    @if ($afterNavAd)
    <div class="top_ad">
        <a target="_blank" href="{{ $afterNavAd->url ?? '#' }}">
            <img src="{{ asset('uploads/images/ads/' . ($afterNavAd->image ?? 'default.jpg')) }}" alt="">
        </a>
    </div>
    @else
    <!-- Handle the case when no ad is found -->
    <p>No ad available.</p>
    @endif
</div>


<div class="container mb-3">
    <div class="wrapper">

        <div class="photobanner">
            @foreach ($breakingNews as $breakingPost)
            <span class="sliding_image">

                <a
                    href="{{ route('post.render', ['slug' => $breakingPost->slug ?? '', 'id' => $breakingPost->id ?? '']) }}">
                    <img class="" src="{{ $breakingPost->firstImagePath }}">
                    <p class="sliding_p">{{ $breakingPost->title ?? '' }}</p>
                </a>
            </span>


            @endforeach
        </div>

    </div>
</div>

<div class="container">
    @if ($afterBreakingAd)
    <div class="top_ad">
        <a target="_blank" href="{{ $afterBreakingAd->url ?? '#' }}">
            <img src="{{ asset('uploads/images/ads/' . ($afterBreakingAd->image ?? 'default.jpg')) }}" alt="">
        </a>
    </div>
    @else
    <!-- Handle the case when no ad is found -->
    <p>No ad available.</p>
    @endif
</div>
