<section>
    <div class="container">
        <a href="{{ route('category.render', [$categories[4]->slug, $categories[4]]) }}">
            <p class="cat_title">
                {{ $categories[3]->title }}
            </p>
        </a>
        <div class="row">


            @foreach($thirdRow as $post)
            <div class="col-md-4">



                <a href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
                    <div class="post_container">

                        <img class="round_image" src="{{ $post->firstImagePath }}">
                        <p><span class="post_title">
                                {{ Str::substr($post->title, 0, 200) }}
                            </span>
                            <br>

                        </p>

                    </div>
                </a>


            </div>
            @endforeach

        </div>

        <hr class="dob_line">
    </div>
</section>
