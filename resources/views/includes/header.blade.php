<header class="main-header">
    <h3 onclick="location.href='{{ route('homepage.index') }}'"><span class="green">Groene</span><span class="blue">Vingers</span></h3>

    <nav class="main-navigation">
        <a class="nav-item" href="{{route('homepage.index')}}">Home</a>
        <a class="nav-item" href="{{route('shop.index')}}">{{ GoogleTranslate::trans('Products', app()->getLocale()) }}</a>
        <a class="nav-item" href="{{route('contact.index')}}">{{ GoogleTranslate::trans('Contact', app()->getLocale()) }}</a>
        <a class="nav-item" href="{{route('dashboard')}}">{{ GoogleTranslate::trans('Dashboard', app()->getLocale()) }}</a>
    </nav>
</header>
