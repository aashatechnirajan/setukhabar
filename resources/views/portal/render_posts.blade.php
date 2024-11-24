@extends('portal.master')





@section('content')



    <style>
        div#social-links {
            /* margin: 0 auto; */
            /* max-width: 500px; */
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding-right: 10px;
            /* border: 1px solid #ccc; */
            margin: 1px;
            font-size: 25px;
            color: var(--first);
            /* background-color: #ccc; */
        }
        .no_button_style{
            border: none
        }
    </style>

    <div class="container">



        @include('portal.includes.topAds')


        {{-- @if ($postads && $postads->section !== 'Post Front')
    <div id="popup-overlay">
        <div id="popup">
            <img src="{{ asset('uploads/images/ads/' . $postads->image) }}" alt="Pop-up Image">
            <button id="close-btn">Close</button>
        </div>
    </div>
@endif

        <div id="overlay"></div> --}}



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






        <div class="row">
            <div class="col-md-9 post_view">


                <span class="tag_share">
                    {{ $post->tags }}
                </span>


                <h3 class="sin_post_title">{{ $post->title }}</h3>
            @section('title')
                | {{ $post->title }}
            @endsection



            <span class="nep_date">{{ $post->getTimeDifference() }}</span>
<br>
            @if (!empty($post->reporter_name))
            <p class="reporter_name"> <span class="small_font"> News by:</span> {{ $post->reporter_name }}</p>
            
            @else

            <p class="reporter_name"> <span class="small_font"> News by:</span> {{ $sitesetting->title }}</p>
            @endif
          
            


            {{-- <span class="nep_date"><i class="fa fa-calendar" aria-hidden="true"></i>{{ $post->getNepaliDate() }}</span> --}}



            <span class="social_share">
                <span>Shares: <span id="shares">{{ $post->shares }}</span>
                        <button id="shareButton" data-id="{{ $post->id }}" class="no_button_style"> 
                            {!! $shareComponent !!}
                            
                        </button>
              
                    
             
                    
                    
                </span>
                    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
                   
                

            </span>




            <img class="post_view_img col-md-12 my-3" src="{{ $post->firstImagePath }}" alt="Post Image">

            <div style="font-size:22px;">




                {{-- {{ $strippedContent }} --}}

                @php
                    
                    // $wordChunks = array_chunk(str_word_count($strippedContent, 1), 100);
                    $wordChunks = array_chunk(mb_split('\s+', $strippedContent), 200);
                    $images = json_decode($post->image);
                    $remainingImages = array_slice($images, 1);
                    $imageDisplayed = false;
                    
                @endphp




                @foreach ($wordChunks as $index => $wordChunk)
                    {!! implode(' ', $wordChunk) !!}

                    @if (!$imageDisplayed && $index < count($remainingImages))
                        <div class="post-images my-3">
                            <img class="whole_image" src="{{ asset('uploads/posts/' . $remainingImages[$index]) }}"
                                alt="Post Image">
                        </div>
                        @php $imageDisplayed = true; @endphp
                    @endif
                @endforeach

                @foreach (array_slice($remainingImages, $imageDisplayed ? 1 : 0) as $image)
                    <div class="post-images my-3">
                        <img class="whole_image" src="{{ asset('uploads/posts/' . $image) }}" alt="Post Image">
                    </div>
                @endforeach







            </div>



            {{-- 

            <div class="post"> --}}




            {{-- @if (!empty($post->image) && count(json_decode($post->image)) > 0)
                    <div class="post-images">
                        @foreach (json_decode($post->image) as $index => $image)
                            @if ($index > 0)
                                <img class="square_image" src="{{ asset('uploads/posts/' . $image) }}"
                                    alt="Post Image">
                            @endif
                        @endforeach
                    </div>
                @endif --}}



            {{-- 
            </div> --}}


            <hr>

            <div id="fb-root">
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="600" data-numposts="100">
                </div>

            </div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0"
                nonce="PhQ7TiiA"></script>



        </div>


        <div id="" class="col-md-3">
            <div class=" main_news">
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
            {{-- Right section Ads --}}

            <div class="single_page_side">
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


            <div class=" main_news">

                <p class="cat_title">
                    सम्बन्धित खबर
                </p>

                <ul>

                    @foreach ($similarPosts as $post)
                        <a style="text-decoration: none;"
                            href="{{ route('post.render', ['slug' => $post->slug ?? '', 'id' => $post->id ?? '']) }}">
                            {{-- <p class="main_news_titles"> {{ Str::substr($post->title, 0, 200) ?? '' }}
                        </p> --}}
                            <li class="main_news_title mb-2">
                                {{ Str::substr($post->title, 0, 200) ?? '' }}

                            </li>

                        </a>
                    @endforeach


                </ul>


            </div>


            <div class=" main_news">
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





            {{-- <div style="marin-top:20px;">
                @foreach ($sidebarAds as $ad)
                <a href="#" target="_blank"><img class="sidebar_ads_img"
                        src="{{ url('storage/' . $ad->image) ?? '' }}"></a>
                @endforeach
            </div> --}}


        </div>

    </div>

</div>

<hr>


<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0"
    nonce="PhQ7TiiA"></script>


@include('portal.includes.bottomAds')



@include('portal.includes.tenth')


{{-- @section('script') --}}
<script>
$(document).ready(function() {
    var executingAjax = false;
    var eventName = 'customEvent';
   

    var clickedLink = $(this); // The clicked <a> tag
//             var href = $(this).attr('href');
//             // console.log(href);


    var postId = $('#shareButton').data('id');
    eventHandler(postId, clickedLink);
//  var parentElement = $(this).closest('.parent');

//  var postId = parentElement.data('id'); // Get the post id  value
//  console.log(parentElement);
    
    function eventHandler(postId, clickedLink) {
        console.log(executingAjax);
        if (!executingAjax) {
            executingAjax = true;
            console.log('Event triggered'+ postId);

            $.ajax({
            url: '/post/increment/share/'+postId, // Replace with your actual URL
            type: 'GET',
            success: function(response){
                console.log(clickedLink);
                // alert("hello successs");
              //  e.stopPropagation();
                clickedLink.trigger('click');
                executingAjax = false; // Reset the flag
            },
            error: function() {
                // alert("failed");
                // Handle error if needed
            }
        });
         
        }
    }
    
    $(document).on(eventName, eventHandler);
});



</script>

@endsection
