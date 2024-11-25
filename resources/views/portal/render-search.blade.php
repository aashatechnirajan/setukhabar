@extends('portal.master')

@section('content')
<div class="container">
    <p class="arrow"><a href="/"><i class="fa fa-arrow-left" aria-hidden="true"></i><strong> Back</strong></a></p>

    @include('portal.includes.topAds')

    @if (!empty($adspop))
    <div id="popup-overlay">
        <div id="popup">
            <img src="{{ asset('uploads/images/ads/' . $adspop->image) }}" alt="Pop-up Image">
            <button id="close-btn">Close</button>
        </div>
    </div>

    @endif

    <div id="overlay"></div>

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

    <div class="row">
        <div class="col-md-8 post_view">
            @foreach ($posts as $post)

            <h3>{{ $post->title }}</h3>
            @section('title')
            | {{ $post->title }}
            @endsection
            @section('description')

            <?php
        // $strippedcontent = preg_replace('/<(?!p\b)[^>]*>/','', $post->content)
        ?>


            @endsection
            <span class="nep_date">{{
                $post->getTimeDifference() }}</span><br>
            <span class="nep_date"><i class="fa fa-calendar" aria-hidden="true"></i>{{ $post->getNepaliDate() }}</span>



            <span class="social_share">
                <a class="share_facebook"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}&display=popup"
                    target="_blank" onclick="trackShare({{ $post->id }})">
                    <i class="fa fa-facebook-official icon-large" aria-hidden="true"></i>
                </a>
                <a class="share_twitter"
                    href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}"
                    target="_blank" onclick="trackShare({{ $post->id }})">
                    <i class="fa fa-twitter icon-large" aria-hidden="true"></i>
                </a>

                <a class="share_viber"
                    href="https://viber.com/intent/viber?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}"
                    target="_blank" onclick="trackShare({{ $post->id }})">
                    <i class="fab fa-viber icon-large" aria-hidden="true"></i>
                </a>

                <a class="share_whatsapp"
                    href="https://share_whatsapp.com/intent/share_whatsapp?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}"
                    target="_blank" onclick="trackShare({{ $post->id }})">
                    <i class="fab fa-whatsapp icon-large" aria-hidden="true"></i>
                </a>


            </span>

            <img class="post_view_img col-md-12" src="{{ $post->firstImagePath }}">





            <div style="font-size:25px;">


                <p class="post_view_desc">{!! $post->content !!}</p>


            </div>
            @endforeach

            <script>
                function trackShare(postId) {
            $.ajax({
                type: 'POST',
                url: '/post/{slug}/{id}',
                dataType: 'json',
                success: function(response) {

                },
                error: function(xhr, status, error) {

                }
            });
        }
            </script>

        </div>

        <div id="" class="col-md-4">
            <div class=" main_news p-4">
                <p class="cat_title">
                    मुख्य समाचार
                </p>

                <ul>
                    @foreach ($mukhyaNews as $mNews)


                    <a style="text-decoration: none;"
                        href="{{ route('post.render', ['slug' => $mNews->slug ?? '', 'id' => $mNews->id ?? '']) }}">
                        <li class="main_news_title mb-2">
                            {{ Str::substr($mNews->title, 0, 200) ?? '' }}
                        </li>

                    </a>
                    @endforeach

                </ul>

            </div>

            <div>
                <div class="single_page_side">
                    @if ($afterMainNewstitleAd)
                    <div class="top_ad">
                        <a target="_blank" href="{{ $afterMainNewstitleAd->url ?? '#' }}">
                            <img src="{{ asset('uploads/images/ads/' . ($afterMainNewstitleAd->image ?? 'default.jpg')) }}"
                                alt="">
                        </a>
                    </div>
                    @else

                    <p>No ad available.</p>
                    @endif
                </div>
            </div>




            <div class=" main_news p-4">
                <p class="cat_title">
                    सम्बन्धित खबर
                </p>


                <ul>
                    @foreach ($similarPosts as $post)

                    <a style="text-decoration: none;"
                        href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
                        <li class="main_news_title mb-2">
                            {{ Str::substr($post->title, 0, 200) ?? '' }}

                        </li>

                    </a>
                    @endforeach


                </ul>

            </div>

            <div class=" main_news p-4">
                <p class="cat_title">
                    अन्य खबर
                </p>

                <ul>
                    @foreach ($tagPosts as $post)

                    <a style="text-decoration: none;"
                        href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">

                        <li class="main_news_title mb-2">

                            {{ Str::substr($post->title, 0, 200) ?? '' }}
                        </li>
                    </a>

                    @endforeach
                </ul>
            </div>

        </div>

    </div>

</div>

<hr>
<div class="container">
    <div id="fb-root">
        <div class="fb-comments" data-href="{{ url()->current() }}" data-width="600" data-numposts="100"></div>
    </div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0"
        nonce="PhQ7TiiA"></script>
</div>

@include('portal.includes.bottomAds')


@include('portal.includes.tenth')


@endsection
