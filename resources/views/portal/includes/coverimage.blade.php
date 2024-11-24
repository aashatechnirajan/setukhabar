{{-- For Cover News and Head News --}}

<section class="cover">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($coverimages as $key => $coverimage)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                            class="" aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">

                        {{-- <div class="carousel-item active">

                            <img src="{{ asset('img/coverimage.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">

                                <h5> पद भार ग्रहण गर्नु हुँदै </h5>

                            </div>
                        </div> --}}
                        @foreach ($coverimages as $key => $coverimage)
                        <div class="carousel-item">

                            {{-- {{ route('post.render', ['slug' => $news->slug ?? '', 'id' => $news->id ?? '']) }} --}}
                            <a
                                href="{{ route('post.render', ['slug' => $coverimage->slug ?? '', 'id' => $coverimage->id ?? '']) }}">
                                {{-- @php
                                $images = json_decode($coverimage->image);
                                @endphp
                                @if (is_array($images) && count($images) > 0)
                                @php
                                $firstImagePath = asset('uploads/posts/' . $images[0]);
                                @endphp
                                <img class="d-block w-100 carousel-top-image"
                                alt="..."  src="{{ $firstImagePath }}">
                                @endif --}}
                                <img class="d-block w-100 carousel-top-image" src="{{ $coverimage->firstImagePath }}">

                                {{-- <img src="{{ asset($coverimage->image) }}" class="d-block w-100 carousel-top-image"
                                    alt="..."> --}}
                                <div class="carousel-caption d-none d-md-block">
                                    <p>{{ $coverimage->title }}</p>

                                </div>
                            </a>

                        </div>
                        @endforeach

                    </div>


                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>




            <div class="col-md-5">
                <div class="main_news">

                    <p class="cat_title text_center">
                        मुख्य समाचार
                    </p>
                    <ul>
                        @foreach ($mukhyaNews as $mukhyaPost)
                        <a
                            href="{{ route('post.render', ['slug' => $mukhyaPost->slug ?? '', 'id' => $mukhyaPost->id ?? '']) }}">
                            <li class="main_news_title mb-2">

                                {{ $mukhyaPost->title }}
                            </li>
                            
                        </a>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    @if ($afterMainAd)
    <div class="top_ad">
        <a target="_blank" href="{{ $afterMainAd->url ?? '#' }}">
            <img src="{{ asset('uploads/images/ads/' . ($afterMainAd->image ?? 'default.jpg')) }}" alt="">
        </a>
    </div>
    @else
    <!-- Handle the case when no ad is found -->
    <p>No ad available.</p>
    @endif
</div>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselIndicators = document.querySelectorAll("#carouselExampleIndicators .carousel-indicators button");
        var carouselItems = document.querySelectorAll("#carouselExampleIndicators .carousel-inner .carousel-item");

        carouselIndicators[0].classList.add("active");
        carouselItems[0].classList.add("active");
    });

</script>
