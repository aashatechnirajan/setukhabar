

<head>

{{-- 


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>NepalSandharbha</title>


    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>



    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0"
        nonce="X095jhWB"></script>
 
  <?php
  use App\Models\Favicon;
  $favicon = Favicon::first();
  ?>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . $favicon->apple_touch_icon) }}">
  <link rel="icon" type="image/png" sizes="32x32"
      href="{{ asset('uploads/favicon/' . $favicon->favicon_thirtyTwo) }}">
  <link rel="icon" type="image/png" sizes="16x16"
      href="{{ asset('uploads/favicon/' . $favicon->favicon_sixteen) }}">
  <link rel="manifest" href="{{ asset('uploads/favicon/file' . $favicon->file) }}">






    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


 


      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">




      @if(isset($ogTitle) && isset($ogDescription) && isset($ogImage) && isset($ogUrl))
      <meta property="og:title" content="{{ $ogTitle }}" />
      <meta property="og:description" content="{{ $ogDescription }}" />
      <meta property="og:image" content="{{ $ogImage }}" />
      <meta property="og:url" content="{{ $ogUrl }}" />
      <meta property="og:type" content="article" />
  @endif


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   


    <script src="https://kit.fontawesome.com/060a077e75.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="screen" />


 --}}



 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">


 <title>{{ $appName }}</title>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
 integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


{{--favicon  --}}
 <?php
 use App\Models\Favicon;
     $favicon = Favicon::first();
 ?>

 <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . $favicon->apple_touch_icon) }}">
 <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/' .$favicon->favicon_thirtyTwo) }}">
 <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/' .$favicon->favicon_sixteen) }}">
 {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/assets/img/favicons/favicon.ico') }}"> --}}
 <link rel="manifest" href="{{ asset('uploads/favicon/file'.$favicon->file) }}">

{{-- favicon --}}




@if(isset($ogTitle) && isset($ogDescription) && isset($ogImage) && isset($ogUrl))
<meta property="og:title" content="{{ $ogTitle }}" />
<meta property="og:description" content="{{ $ogDescription }}" />
<meta property="og:image" content="{{ $ogImage }}" />
<meta property="og:url" content="{{ $ogUrl }}" />
<meta property="og:type" content="article" />
@endif


<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>



<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0"
    nonce="X095jhWB"></script>




<script src="https://kit.fontawesome.com/060a077e75.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ asset('css/style.css') }}" media="screen" />

</head>

