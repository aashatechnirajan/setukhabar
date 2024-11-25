    {{-- For Navbar --}}

    <section class="topheader">
        <div class="container">

            <div class="row">

                <div class="col-md-3 top_left">
                    <p class="date_time">
                        {{-- <span id="TIME_IN_NEPALI"></span><br> --}}
                        <span id="DATE_IN_NEPALI"></span>
                        <br>
                    <span class="eng-date">{{ $currentDate }}, {{ $currentDayOfWeek = date('l'); }}</span>

                    </p>
                </div>

                <div class="col-md-6 top_mid">
                    <a href="{{ route('index') }}">
                    <img src="{{ asset('uploads/sitesetting/' .$sitesetting->main_logo) }}" alt="">
                </a>
                </div>

                <div class="col-md-2 top_right">
                    <span class="social_icons">
                        <a href="{{ $sitesetting->facebook }}" target="_blank">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a href="{{ $sitesetting->linkedin }}" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="{{ $sitesetting->twitter }}" target="_blank">
                            <i class="fab fa-twitter-square"></i>
                        </a>

                    </span>


                </div>
            </div>
    </section>
