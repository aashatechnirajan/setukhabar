
<?php
use Carbon\Carbon;
    use App\Models\Post;
    $posts = Post::all();
    $appName = env('APP_NAME');
    $uniqueTags = [];

    foreach ($posts as $post) {
    $tags = explode(',', $post->tags);
    $uniqueTags = array_merge($uniqueTags, $tags);
    }

    $uniqueTags = array_unique($uniqueTags);
    $currentDate = Carbon::now()->isoFormat('Do MMMM YYYY');
    $currentYear= Carbon::now()->year;


?>

<!DOCTYPE html>
<html style="font-size: 16px" lang="en">

@include('portal.includes.head')

<body onload=updateClock(); class="u-body u-xl-mode" data-lang="en">


{{--
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0" nonce="YkVf3Cqn"></script> --}}





    <!-- ========================= NAV SECTION ======================================

    ================================================================================= -->

    @include('portal.includes.topnav')
    @include('portal.includes.navbar')

    {{-- @include('portal.includes.coverimage') --}}


        <!-- ========================= CONTENT SECTION ======================================

    ================================================================================= -->


    @yield('content')


    <!-- ======================== FOOTER SECTION ===================================

    ================================================================================ -->

    @include('portal.includes.footer')

    @yield('script')



</body>

</html>









