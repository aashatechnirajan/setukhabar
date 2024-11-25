<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p class="cat_title text_center">
                    पढ्नै पर्ने
                </p>
                @foreach ($trendingPosts as $post)
                <a href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">


                    <div class="post_container">

                        <img class="square_image" src="{{ $post->firstImagePath }}">
                        <p><span class="post_title">
                                {{ Str::substr($post->title, 0, 200) }}
                            </span>
                            <br>

                        </p>

                    </div>
                </a>
                @endforeach




            </div>

            <div class="col-md-4">
                <p class="cat_title text_center">
                    मस्ट सेयर्ड
                </p>
                @foreach($sharedPosts as $columnTwo)


                <a href="{{ route('post.render', ['slug' => $columnTwo->slug ?? '', 'id' => $columnTwo->id ?? '']) }}">
                    <div class="post_container">
                        <img class="square_image" src="{{ $columnTwo->firstImagePath }}">
                        <p><span class="post_title">
                                {{ Str::substr($columnTwo->title, 0, 200) }}
                            </span>
                            <br>

                        </p>

                    </div>
                </a>
                @endforeach

            </div>


            <div class="col-md-4">
                <p class="cat_title text_center">
                    राेचक
                </p>
                @foreach($relatedPosts as $columnThree)

                <a
                    href="{{ route('post.render', ['slug' => $columnThree->slug ?? '', 'id' => $columnThree->id ?? '']) }}">
                    <div class="post_container">


                        <img class="square_image" src="{{ $columnThree->firstImagePath }}">

                        <p><span class="post_title">
                                {{ Str::substr($columnThree->title, 0, 200) }}
                            </span>
                            <br>

                        </p>

                    </div>
                </a>
                @endforeach


            </div>
        </div>
    </div>
</section>
