<section>
    <div class="container">

        <div class="row">

            <div class="row col-md-8 ">
                <div class="col-md-12">
                    <a href="{{ route('category.render', [$categories[1]->slug, $categories[1]]) }}">
                        <p class="cat_title">
                            {{ $categories[1]->title }}
                        </p>
                    </a>
                </div>
                <div class="col-md-5">

                   
                    @foreach ($secondColumnOne as $columnOne )
                    @php
                    // $strippedContent = strip_tags($post->content);
                    $limitedContent = Str::limit($columnOne->description, $limit = 200, $end = '...');
                    @endphp

                    <a
                        href="{{ route('post.render', ['slug' => $columnOne->slug ?? '', 'id' => $columnOne->id ?? '']) }}">
                        <div class="post_maincontainer">
                            <img class="big_image" src="{{ $columnOne->firstImagePath }}">

                            <p class="mt-2">
                                <span class="post_title">{{ Str::substr($columnOne->title, 0, 200) }}
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


                <div class="col-md-7">
                    @foreach ($secondColumnTwo as $columnTwo )
                    <a
                        href="{{ route('post.render', ['slug' => $columnTwo->slug ?? '', 'id' => $columnTwo->id ?? '']) }}">
                        <div class="post_container">
                            <img class="round_image" src="{{ $columnTwo->firstImagePath }}">

                            <p><span class="post_title">
                                    {{ Str::substr($columnTwo->title, 0, 200) }}
                                </span>
                                <br>

                            </p>

                        </div>
                    </a>

                    @endforeach


                </div>

            </div>

            <div class="col-md-4">
                <a href="{{ route('category.render', [$categories[2]->slug, $categories[2]]) }}">
                    <p class="cat_title">
                        {{ $categories[2]->title }}
                    </p>
                </a>

                @foreach($secondColumnThree as $columnThree)
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

        <hr class="dob_line">

    </div>
</section>
