<section>
    <div class="container">
        <a href="{{ route('category.render', [$categories[0]->slug, $categories[0]]) }}">
            <p class="cat_title">
                {{ $categories[0]->title }}
            </p>
        </a>
        <div class="row">

            <div class="col-md-4">
                @foreach ($firstColumnOne as $columnOne)
                <a href="{{ route('post.render', ['slug' => $columnOne->slug ?? '', 'id' => $columnOne->id ?? '']) }}">
                    <div class="post_container">
                        <img class="round_image" src="{{ $columnOne->firstImagePath }}">
                        <p>
                            <span class="post_title">
                                {{ $columnOne->truncatedTitle }}
                            </span>
                            <br>
                        </p>
                    </div>
                </a>
                @endforeach
            </div>




            <div class="col-md-4">
                @foreach ($firstColumnTwo as $post)
                @php
                // $strippedContent = strip_tags($post->content);
                $limitedContent = Str::limit($post->description, $limit = 200, $end = '...');
                @endphp
                <a href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
                    <div class="post_maincontainer">

                        <img class="big_image" src="{{ $post->firstImagePath }}">
                        <p class="mt-2">
                            <span class="post_title">{{ Str::substr($post->title, 0, 200) }}
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
                @foreach($firstColumnThree as $columnThree)


                <a
                    href="{{ route('post.render', ['slug' => $columnThree->slug ?? '', 'id' => $columnThree->id ?? '']) }}">
                    <div class="post_container">

                        <img class="round_image" src="{{ $columnThree->firstImagePath }}">




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

        <hr class="dob_line">
    </div>
</section>
