<section>

    <div class="container">
        <a href="{{ route('category.render', [$categories[7]->slug, $categories[7]]) }}">
            <p class="cat_title">
                {{ $categories[7]->title }}
            </p>
        </a>
        <div class="row">
            <div class="col-md-8">

                <div id="carouselExampleIndicatorsOne" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-indicators">
                        @foreach($seventhRowOne as $key => $eightrow)
                        <button type="button" data-bs-target="#carouselExampleIndicatorsOne"
                            data-bs-slide-to="{{ $key }}" class="active" aria-current="true"
                            aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach

                    </div>

                    <div class="carousel-inner">
                        @foreach ($seventhRowOne as $key => $eightrow)
                        <div class="carousel-item">


                            <a
                                href="{{ route('post.render', ['slug' => $eightrow->slug ?? '', 'id' => $eightrow->id ?? '']) }}">

                                <img class="d-block w-100 carousel-top-image" src="{{ $eightrow->firstImagePath }}">


                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $eightrow->title }}</h5>

                                </div>
                            </a>

                        </div>
                        @endforeach

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsOne"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsOne"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>




            </div>



            <div class="col-md-4">
                <div class="rect_ad">
                    <div class="entertainment">
                        @if ($sportsAd)
                        <div class="top_ad">
                            <a target="_blank" href="{{ $sportsAd->url ?? '#' }}">
                                <img src="{{ asset('uploads/images/ads/' . ($sportsAd->image ?? 'default.jpg')) }}"
                                    alt="">
                            </a>
                        </div>
                        @else
                        <!-- Handle the case when no ad is found -->
                        <p>No ad available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 row">


                @foreach($ninthColumnOne as $key => $columnThree)
                <div class="col-md-4">

                    <a
                        href="{{ route('post.render', ['slug' => $columnThree->slug ?? '', 'id' => $columnThree->id ?? '']) }}">
                        <div class="post_container">

                            <img class="round_image" src="{{ $columnThree->firstImagePath }}">

                            <p><span class="post_title">
                                    {{ Str::substr($columnThree->title, 0, 200) }}
                                </span>
                                <br>
                                {{-- <span class="nep_date"><i class="fa fa-calendar" aria-hidden="true"></i>{{
                                    $columnThree->getTimeDifference() }}</span> --}}
                            </p>

                        </div>
                    </a>


                </div>
                @endforeach

            </div>



        </div>

        <hr class="dob_line">
    </div>




</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselIndicators = document.querySelectorAll("#carouselExampleIndicatorsOne .carousel-indicators button");
        var carouselItems = document.querySelectorAll("#carouselExampleIndicatorsOne .carousel-inner .carousel-item");

        carouselIndicators[0].classList.add("active");
        carouselItems[0].classList.add("active");
    });

</script>
