@extends('portal.master')

@section('content')

<section class="single_page">
    <div class="container">


        <h1 class="cat_title">{{ __($image->img_desc) }}</h1>


        <div class="row mt-3">
            @foreach ($image->img as $imgUrl)
            <div class="col-md-3 mb-4">
                <a href="{{ asset($imgUrl) }}" data-lightbox="image-gallery">
                    <img src="{{ asset($imgUrl) }}" class="gallery_image">
                </a>
            </div>
            @endforeach



        </div>



    </div>
</section>



@endsection
