

<nav class="navbar navbar-expand-lg navbar-expand-sm navbar-expand-md  navbar-light sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ route('index') }}">हाेमपेज</a>
                </li>

                @foreach($categories as $category)
                <li
                    class="nav-item @if(request()->is('category/' . $category->slug . '/' . $category->id)) active @endif">
                    <a class="nav-link"
                        href="{{ route('category.render',['slug' => $category->slug, 'id' => $category->id]) }}"
                        onclick="markNavItemActive(this)">{{ $category->title }}</a>
                </li>
                @endforeach
            </ul>
        </div>

{{-- Search bar --}}

        {{-- <div class="input-group rounded" style="width: 10%">
            <form action="{{ route('post.search') }}" method="GET">
                @csrf
                <input type="text" name="input" placeholder="Search..." />
                <button type="submit">Search</button>
            </form>

        </div> --}}

        <div class="search-container">
            <form action="{{ route('post.search') }}" method="GET">
                @csrf
                <input type="text" name="input" placeholder="Search..." />
                <button type="submit">Search</button>
            </form>
        </div>

    </div>

</nav>



<script>
    function markNavItemActive(element) {
        var navItems = document.getElementsByClassName('nav-item');
        for (var i = 0; i < navItems.length; i++) {
            navItems[i].classList.remove('active');
        }
        element.parentNode.classList.add('active');
    }


 </script>
