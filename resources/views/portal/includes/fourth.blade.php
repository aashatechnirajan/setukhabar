<section>
    <div class="container">

        <div class="row">

            <div class="col-md-4 main_ad_container">
                {{-- upper ad section --}}
                <div class="container_one_ad ">
                    <div class="entertainment">
                        @if ($entertainmentAd)
                        <div class="top_ad_en">
                            <a target="_blank" href="{{ $entertainmentAd->url ?? '#' }}">
                                <img src="{{ asset('uploads/images/ads/' . ($entertainmentAd->image ?? 'default.jpg')) }}"
                                    alt="">
                            </a>
                        </div>
                        @else
                        <!-- Handle the case when no ad is found -->
                        <p>No ad available.</p>
                        @endif
                    </div>
                </div>

                {{-- lower ad section --}}
                <div class="container_two_ad ">
                    <div class="entertainment">
                        @if ($entertainmentAd)
                        <div class="top_ad_en">
                            <a target="_blank" href="{{ $entertainmentAd->url ?? '#' }}">
                                <img src="{{ asset('uploads/images/ads/' . ($entertainmentAd->image ?? 'default.jpg')) }}"
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


            <div class="col-md-8 row">
                <div class="col-md-12">
                    <a href="{{ route('category.render', [$categories[4]->slug, $categories[4]]) }}">
                        <p class="cat_title">
                            {{ $categories[4]->title }}
                        </p>
                    </a>
                </div>


                @foreach($fourthRow as $columnOne)
                <div class="col-md-6">



                    <a
                        href="{{ route('post.render', ['slug' => $columnOne->slug ?? '', 'id' => $columnOne->id ?? '']) }}">
                        <div class="post_container">
                            <img class="round_image" src="{{ $columnOne->firstImagePath }}">
                            <p><span class="post_title">

                                    <p><span class="post_title">
                                            {{ Str::substr($columnOne->title, 0, 200) }}
                                        </span>
                                        <br>

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
