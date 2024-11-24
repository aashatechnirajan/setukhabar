{{-- <div class="col-md-4">
    <p class="cat_title text_center">
        पढ्नै पर्ने
    </p>
    @foreach ($relatedPosts as $post)

    <a href="">
        <div class="post_container">
            <img class="square_image" src="{{ asset('uploads/images/post/' . $post->image) }}">
            <p><span class="post_title">
                    {{ Str::substr($post->title, 0, 200) }}
                </span>
                <br>
                <span class="nep_date"><i class="fa fa-calendar" aria-hidden="true"></i>{{
                    $post->getTimeDifference() }}</span>
            </p>

        </div>
    </a>
    @endforeach








</div> --}}
