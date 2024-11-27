    {{-- For Navbar --}}


    <style>
        .cmptitle {
   font-size: 60px;
  font-family: var(--firstfont);
  font-weight: bold;
  color: var(--first);          
  text-align: center;
  letter-spacing: 2px;        
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
.sub {
  font-size: 34px; /* Adjust the font size */
  font-weight:500;
  font-family: var(--firstfont);
  letter-spacing:1px;  
  color: var(--fourth); /* Lighter color for the subtitle */
  margin-top: 18px; /* Add space between title and subtitle */
}


  </style>
  <section class="topheader">
      <div class="container">


          <div class="row d-flex justify-content-between">


              <div class="col-md-3 top_left">
                  <p class="date_time">
                      {{-- <span id="TIME_IN_NEPALI"></span><br> --}}
                      <span id="DATE_IN_NEPALI"></span>
                      <br>
                  <span class="eng-date">{{ $currentDate }}, {{ $currentDayOfWeek = date('l')}}</span>


                  </p>
              </div>


              <div class="col-md-6 top_mid d-flex align-items-center justify-content-center py-1">
                  <img src="{{ asset('uploads/sitesetting/' .$sitesetting->main_logo) }}" alt="" class="p-0 m-0 ">
              <p class=" cmptitle p-0 m-0">सेतु</p><span class="sub">खबर </span>
              </div>


              <div class="col-md-3  d-flex align-items-center  justify-content-center">
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



