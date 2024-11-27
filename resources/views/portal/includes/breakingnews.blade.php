{{-- For Breaking News --}}
<style>
    .imgsize{
        height: 30vh;
        width: 100%;
        object-fit: cover;
    }
</style>


<section class="container-fluid">


<div class="container">
   <div class="row py-2">
   @foreach ($breakingNews->take(1) as $breakingPost)
       <div class="col-md-8">
           <h1 class="mt-3">{{$breakingPost->title}}</h1>
           <img class="imgsize rounded" src="{{ $breakingPost->firstImagePath }}">
           <div class="content">
            {!! $breakingPost->content !!}
        </div>
       </div>
       @endforeach
       <div class="col-md-4">
        @if ($afterNavAd)
    <div class=" m-0 p-0 ">
        <h1 class="mt-3">हाम्रो बिज्ञापन</h1>
        <a target="_blank" href="{{ $afterNavAd->url ?? '#' }}">
            <img src="{{ asset('uploads/images/ads/' . ($afterNavAd->image ?? 'default.jpg')) }}" alt="" class="imgsize rounded">
        </a>
    </div>
    @else
    <!-- Handle the case when no ad is found -->
    <p>No ad available.</p>
    @endif
       </div>
   </div>
</div>


</section>




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
    <div class="top_ad p-0 m-0 py-2">
        <a target="_blank" href="{{ $afterBreakingAd->url ?? '#' }}">
            <img src="{{ asset('uploads/images/ads/' . ($afterBreakingAd->image ?? 'default.jpg')) }}" alt="">
        </a>
    </div>
    @else
    <!-- Handle the case when no ad is found -->
    <p>No ad available.</p>
    @endif
</div>