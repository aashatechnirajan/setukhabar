<section class="with_back">

    <div class="container">
        <a href="{{ route('category.render', [$categories[9]->slug, $categories[9]]) }}">
            <p class="cat_title white_cat">

                {{ $categories[9]->title }}
            </p>
        </a>
        <div class="carousel-container">
            <div class="inner-carousel">
                <div class="track">
                    @foreach($posts as $rowOne)

                    <div class="card-container">
                        <a
                            href="{{ route('post.render', ['slug' => $rowOne->slug ?? '', 'id' => $rowOne->id ?? '']) }}">
                            <div class="card card1">
                                <div class="image-container">
                                    {{-- <img class="card_image" src="{{ asset($rowOne->image) }}"> --}}
                                    <img class="card_image" src="{{ $rowOne->firstImagePath }}">
                                </div>
                                <div class="card_content">
                                    <p class="card_title">{{ Str::substr($rowOne->title, 0, 80) }}..</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="nav_car">
                    <button class="prev"><i class="fas fa-arrow-left fa-2x"></i></button>
                    <button class="next"><i class="fas fa-arrow-right fa-2x"></i></button>
                </div>
            </div>
        </div>
    </div>

</section>





<!-- Add this inside your HTML file, after the carousel container -->
<script>
    $(document).ready(function() {
      // Variables to store the carousel elements
      const carouselContainer = $('.carousel-container');
      const track = carouselContainer.find('.track');
      const cards = carouselContainer.find('.card-container');
      const cardWidth = cards.outerWidth();
      const prevBtn = carouselContainer.find('.prev');
      const nextBtn = carouselContainer.find('.next');

      let currentIndex = 0;

      // Function to update the carousel track position
      function setTrackPosition() {
        track.css('transform', `translateX(${-currentIndex * cardWidth}px)`);
      }

      // Previous button click event
      prevBtn.on('click', function() {
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        setTrackPosition();
      });

      // Next button click event
      nextBtn.on('click', function() {
        currentIndex = (currentIndex + 1) % cards.length;
        setTrackPosition();
      });
    });
</script>
