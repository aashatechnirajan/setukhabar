@extends('portal.master')


@section('content')
@include('portal.includes.breakingnews')
@include('portal.includes.coverimage')


{{-- Popup Ad Section - Only renders if homeads exists --}}
@if (!empty($homeads))
    <div id="popup-overlay" style="display: none;">
        <div id="popup">
            <img src="{{ asset('uploads/images/ads/' . $homeads->image) }}" alt="Pop-up Image">
            <button id="close-btn">Close</button>
        </div>
    </div>
    <div id="overlay" style="display: none;"></div>


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


@include('portal.includes.first')
@include('portal.includes.second')
@include('portal.includes.third')
@include('portal.includes.ninth')
@include('portal.includes.fourth')
@include('portal.includes.fifth')
@include('portal.includes.sixth')
@include('portal.includes.seventh')
@include('portal.includes.eighth')
@include('portal.includes.tenth')
@endsection

