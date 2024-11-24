<section>
    <div class="container">
        <a href="{{ route('category.render', [$categories[6]->slug, $categories[6]]) }}">
            <p class="cat_title">
                {{ $categories[6]->title }}
            </p>
        </a>
        <div class="row">

            <div class="col-md-4">
                @foreach($sixthColumnOne as $columnOne)


                <a href="{{ route('post.render', ['slug' => $columnOne->slug ?? '', 'id' => $columnOne->id ?? '']) }}">
                    <div class="post_container">

                        <img class="round_image" src="{{ $columnOne->firstImagePath }}">

                        <p><span class="post_title">
                                {{ Str::substr($columnOne->title, 0, 200) }}
                            </span>
                            <br>

                        </p>

                    </div>
                </a>
                @endforeach





            </div>

            <div class="col-md-4">

                @foreach($sixthColumnTwo as $columnTwo)
                @php
                // $strippedContent = strip_tags($columnTwo->content);
                $limitedContent = Str::limit($post->description, $limit = 200, $end = '...');
                @endphp


                <a href="{{ route('post.render', ['slug' => $columnTwo->slug ?? '', 'id' => $columnTwo->id ?? '']) }}">
                    <div class="post_maincontainer">

                        <img class="big_image" src="{{ $columnTwo->firstImagePath }}">

                        <p class="mt-2">
                            <span class="post_title">
                                {{ Str::substr($columnTwo->title, 0, 200) }}
                            </span>
                            <br>

                            <br>

                            <span class="post_description">
                                {{ $limitedContent }}

                            </span>
                        </p>
                    </div>
                </a>
                @endforeach

            </div>
            <div class="col-md-4">
                <div class="rect_ad">
                    <div class="entertainment">
                        @if ($economicAd)
                        <div class="top_ad">
                            <a target="_blank" href="{{ $economicAd->url ?? '#' }}">
                                <img src="{{ asset('uploads/images/ads/' . ($economicAd->image ?? 'default.jpg')) }}"
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
        </div>
        <hr class="dob_line">
    </div>
</section>
