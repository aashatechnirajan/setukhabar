<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <div class="container">
        <div class="top_ad">
            @if ($afterNavAd)
            <div class="top_ad">
                <a target="_blank" href="{{ $afterNavAd->url ?? '#' }}">
                    <img src="{{ asset('uploads/images/ads/' . ($afterNavAd->image ?? 'default.jpg')) }}"
                        alt="">
                </a>
            </div>
            @else
            <!-- Handle the case when no ad is found -->
            <p>No ad available.</p>
            @endif

        </div>
    </div>
</body>
</html>
