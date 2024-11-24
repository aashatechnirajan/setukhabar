 {{-- old footer --}}
 <footer class="footer-section">
    <div class="footer-section-top">
        <div class="container">
            <div class="top-half">
                <ul class="footer-list">
                    <li>  {{ __($sitesetting->title) }} </li>
                    <li><i class="fas fa-map-marker-alt"></i> {{ $sitesetting->location }}</li>
                    <li><i class="far fa-registered"></i>  {{ __("Information Department Registration No")  }}: २०२८/8789 </li>
                    <li><i class="fas fa-phone"></i>  {{ $sitesetting->phone }}</li>
                    <li><i class="fas fa-envelope"></i>  {{ $sitesetting->email }}</li>

                </ul>
            </div>


        <div class="footer-mid-section">
            <div class="container">
                <ul class="mid-items">
                    <li><a href="{{ $sitesetting->facebook }}" target="_blank"><i class="fab fa-facebook-square fb"></i></a></li>
                    <li><a href="{{ $sitesetting->linkedin }}" target="_blank"><i class="fab fa-linkedin linkedin"></i></a></li>
                    <li><a href="{{ $sitesetting->twitter }}" target="_blank"><i class="fab fa-twitter-square tw"></i></a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="footer-section-down">

        <div class="container buttom-section">
            {{-- <div class="container"> --}}

                <p class="footer-copyright"> COPYRIGHT © {{ $appName }} {{ $currentYear }}. ALL RIGHTS RESERVED.</p>

                {{-- <div class="mid-buttom-section"> --}}
                    <p class="email"><i class="fas fa-ad"></i>


                    {{ $sitesetting->email }}</p>

      
                {{-- </div> --}}

                <div class="powered-by">
                    POWERED BY <img src="{{ asset('img/whitelogo.png') }}" alt="" style="height:40px; width:auto;">
                </div>
            {{-- </div> --}}

        </div>
    </div>



    <script src="{{ asset('js/nepali.js') }}" type="text/javascript"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>


    
 </footer>
{{-- old footer end --}}
