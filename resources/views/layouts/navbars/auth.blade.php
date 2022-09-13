<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="{{route('home')}}" class="simple-text logo-normal">
            {{ __('Avaliação') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'delivery' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'delivery') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Entregas') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
