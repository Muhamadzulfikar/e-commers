@php use Illuminate\Support\Facades\Auth; @endphp
<div class="order-lg-last col-lg-5 col-sm-8 col-8">
    <div class="d-flex float-end">
        @if(Auth::id())
            @php
                $buttons = [
                    [
                        "buttonName" => "My Cart",
                        "url" => url('shopping-cart'),
                        "color" => "text-bg-primary",
                        'icon' => 'fa-shopping-cart'
                    ],
                    [
                        "buttonName" => request()->user()->name,
                        "url" => url('profile'),
                        "color" => "border-primary text-primary",
                        'icon' => 'fa-user-alt'
                    ],
                ];
            @endphp
        @else
            @php
                $buttons = [
                    [
                        "buttonName" => "Register",
                        "url" => url('register'),
                        "color" => "text-bg-primary"
                    ],
                    [
                        "buttonName" => "Login",
                        "url" => url('login'),
                        "color" => "border-primary text-primary"
                    ],
                ];
            @endphp
        @endif

        @foreach($buttons as $button)
            @include('components.button')
        @endforeach
    </div>
</div>
