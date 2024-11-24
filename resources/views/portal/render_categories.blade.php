@extends('portal.master')

@section('content')
    <div class="container">

   


    @include('portal.includes.breakingnews')


    <hr>

    @if (!empty($postads))
    <div id="popup-overlay" style="display: none;">
        <div id="popup">
            <img src="{{ asset('uploads/images/ads/' . $postads->image) }}" alt="Pop-up Image">
            <button id="close-btn">Close</button>
        </div>
    </div>
    <div id="overlay" style="display: none;"></div>


    <script>
        window.onload = function() {
            const popupAd = document.getElementById('popup-overlay');
            const overlay = document.getElementById('overlay');
            const body = document.body;
            const closeButton = document.getElementById('close-btn');


            // Function to show the pop-up ad and overlay
            function showPopup() {
                window.scrollTo(0, 0);
                popupAd.style.display = 'block';
                overlay.style.display = 'block';
                overlay.classList.add('active');
                body.style.overflow = 'hidden';
            }


            // Function to hide the pop-up ad and overlay
            function hidePopup() {
                popupAd.style.display = 'none';
                overlay.style.display = 'none';
                overlay.classList.remove('active');
                body.style.overflow = 'auto';
            }


            // Initialize popup
            showPopup();


            // Event listener for close button
            closeButton.addEventListener('click', hidePopup);


            // Listen for messages from the ad
            window.addEventListener('message', (event) => {
                if (event.data === 'closeAd') {
                    hidePopup();
                }
            });


            // Call any additional initialization functions
            if (typeof updateClock === 'function') {
                updateClock();
            }
        };
    </script>
@endif


            <section>

                <div class="container">
                    <div class="row">
                        @foreach ($titlePosts as $post)
                        <div class="col-md-12 text-center">
                            <a
                                href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">

                                <p class="post_centerpage_title">
                                    {{ $post->title }}
                                </p>


                                <img class="whole_image" src="{{ $post->firstImagePath }}">


                            </a>
                        </div>
                        <hr class="sing_line">
                        @endforeach

                        {{-- Ads section --}}

                        <div class="top_ad">
                            @if ($afterMainNewstitleAd)
                            <div class="top_ad">
                                <a target="_blank" href="{{ $afterMainNewstitleAd->url ?? '#' }}">
                                    <img src="{{ asset('uploads/images/ads/' . ($afterMainNewstitleAd->image ?? 'default.jpg')) }}"
                                        alt="">
                                </a>
                            </div>
                            @else
                            <!-- Handle the case when no ad is found -->
                            <p>No ad available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            @foreach ($mainPosts as $columnTwo)
                            @php
                            $strippedContent = strip_tags($columnTwo->content);
                            $limitedContent = Str::limit($strippedContent, $limit = 200, $end = '...');
                            @endphp


                            <a
                                href="{{ route('post.render', ['slug' => $columnTwo->slug ?? '', 'id' => $columnTwo->id ?? '']) }}">


                                        <div class="post_maincontainer row">


                                    <div class="col-md-5">
                                        {{-- <img class="page_bigimage" src="{{ asset($columnTwo->image) }}">
                                        --}}
                                        <img class="page_bigimage" src="{{ $columnTwo->firstImagePath }}">


                                    </div>
                                    <div class="col-md-7 mid_flex">
                                        <p class="mt-2">
                                            <span class="post_page_title">
                                                {{ Str::substr($columnTwo->title, 0, 600) }}
                                            </span>
                                            <br>


                                                    <span class="post_description">
                                                        {{ $limitedContent }}

                                                    </span>
                                                </p>

                                    </div>
                                </div>
                                <hr class="sing_line">
                            </a>
                            @endforeach


                        </div>
                        
                        <div class="col-md-4">
                            @foreach ($posts as $columnTwo)
                            <a
                                href="{{ route('post.render', ['slug' => $columnTwo->slug ?? '', 'id' => $columnTwo->id ?? '']) }}">
                                <div class="post_container">
                                    {{-- <img class="rect_image" src="{{ asset($columnTwo->image) }}"> --}}
                                    <img class="rect_image" src="{{ $columnTwo->firstImagePath }}">

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



                    <div class="row">
                        @foreach ($postsOne as $columnOne)
                        <div class="col-md-4">

                            <a
                                href="{{ route('post.render', ['slug' => $columnOne->slug ?? '', 'id' => $columnOne->id ?? '']) }}">

                                <div class="post_container">
                                    {{-- <img class="square_image" src="{{ asset($columnOne->image) }}"> --}}
                                    <img class="square_image" src="{{ $columnOne->firstImagePath }}">



                                    <p><span class="post_title">
                                            {{ Str::substr($columnOne->title, 0, 200) }}

                                        </span>
                                        <br>

                                    </p>

                                </div>
                            </a>

                        </div>

                        @endforeach

                        <ul class="pagination pagination ms-auto">
                            <li class="page-item">{{ $postsOne->links() }}</li>
                        </ul>

                    </div>


                </div>

                <hr class="dob_line">
        </div>
        </section>

      
    </div>

</div>


</div>

    <div class="container">
        <div class="top_ad">


            @if ($beforeWorldNewsAd)
                <div class="top_ad">
                    <a target="_blank" href="{{ $beforeWorldNewsAd->url ?? '#' }}">
                        <img src="{{ asset('uploads/images/ads/' . ($beforeWorldNewsAd->image ?? 'default.jpg')) }}"
                            alt="">
                    </a>
                </div>
            @else
                <!-- Handle the case when no ad is found -->
                <p>No ad available.</p>
            @endif


        </div>
    </div>




    @include('portal.includes.seventh')
    @include('portal.includes.eighth')
    @include('portal.includes.tenth')
    {{-- @include('portal.includes.last-section') --}}

@endsection
