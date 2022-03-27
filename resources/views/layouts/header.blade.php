@php
    use Illuminate\Support\Str;
@endphp
<div class="container">
    <div class="header-main">
        <header>
            <div class="container">
                <div class="content">
                    <div class="logo">
                        <a href="/">
                            <img src="{{asset('frontend')}}/images/FPT_Polytechnic.png" alt="">
                        </a>
                    </div>
                    <div class="search">
                        <form action="{{route("search-client")}}">
                            <button class="icon__search"><i class="fas fa-search"></i></button>
                            <input type="text" class="search__input" name="key" id="search_header" placeholder="Tìm kiếm...">
                            <input type="hidden" id="route_ajax_search" value="{{route('ajax-search-product')}}">
                            <div class="box__search">
                                <ul>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="btn-account">
                        @if (Auth::check())
                            <div class="dropdown">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar">
                                        <img alt="avatar" src="{{Auth::user()->avatar}}" class="rounded-circle">
                                    </div>
                                </a>
                                <div class="dropdown-menu pb-2" aria-labelledby="dropdownUser">
                                    <div class="user">
                                        <div class="avatar">
                                            <img alt="avatar" src="{{Auth::user()->avatar}}"
                                                class="rounded-circle">
                                        </div>
                                        <div class="name-user">
                                            <h5>{{Auth::user()->name}}</h5>
                                            <p>{{Auth::user()->email}}</p>
                                        </div>
                                    </div>
                                    <div class="btn-logout">
                                        <a href="/logout">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Sign Out
                                        </a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="sign-in">
                                <a href="/login">Đăng nhập</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <div class="navbar">
            <div class="container">
                <nav>
                    <ul class="navbar-wrap">
                        <li class="nav-item-group">
                            <a href="/" class="link_nav">Trang chủ</a>
                        </li>
                        @foreach ($menus as $item)
                            @if (count($item->navSubMajors)>0)
                                <li class="nav-item-group dropdown-menu">
                                    <a href="javascript:void(0)">{{$item->name}}</a>
                                    <ul class="dropdown-menu-item">
                                        @foreach ($item->navSubMajors as $navSubMajorsItem)
                                            <li>
                                                <a href="{{route("list-product-by-major.product", ['slug' => Str::slug($navSubMajorsItem->name . "-m" . $navSubMajorsItem->id)])}}">{{$navSubMajorsItem->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <i class="fas fa-chevron-down"></i>
                                </li>
                            @else
                                <li class="nav-item-group">
                                    <a href="javascript:void(0)" class="link_nav">{{$item->name}}</a>
                                </li>
                            @endif
                            
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="container">
            <div class="nav-mobile">
                <div class="logo">
                    <a href="/">
                        <img src="{{asset('frontend')}}/images/FPT_Polytechnic.png" alt="">
                    </a>
                </div>
                <div class="group-btn">
                    @if (Auth::check())
                        <div class="dropdown">
                            <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar">
                                    <img alt="avatar" src="{{Auth::user()->avatar}}" class="rounded-circle">
                                </div>
                            </a>
                            <div class="dropdown-menu pb-2" aria-labelledby="dropdownUser">
                                <div class="user">
                                    <div class="avatar">
                                        <img alt="avatar" src="{{Auth::user()->avatar}}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="name-user">
                                        <h5>{{Auth::user()->name}}</h5>
                                        <p>{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                                <div class="btn-logout">
                                    <a href="/logout">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Sign Out
                                    </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <label for="check" class="navbar-main">
                        <i class="fas fa-bars"></i>
                    </label>
                </div>

                <div class="overlay"></div>
                <div class="navbar-mobile">
                    <span class="close-mobile">
                        <i class="fas fa-times"></i>
                    </span>
                    <form action="{{route("search-client")}}">
                        <div class="search-mobile">
                            <button><i class="fas fa-search"></i></button>
                            <input type="text" name="key" id="" placeholder="Tìm kiếm theo tên...">
                        </div>
                    </form>
                    <ul class="navbar-mobile-warp">
                        <li>
                            <div class="link-menu">
                                <a href="/">Trang chủ</a>
                            </div>
                        </li>
                        @foreach ($menus as $item)
                            @if (count($item->navSubMajors)>0)
                                <li class="dropdown-menu">
                                    <div class="link-menu btn-dropdown">
                                        <a  href="javascript:void(0)">{{$item->name}}</a>
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <ul class="dropdown-menu-item">
                                        @foreach ($item->navSubMajors as $navSubMajorsItem)
                                            <li>
                                                <a href="{{route("list-product-by-major.product", ['slug' => Str::slug($navSubMajorsItem->name . "-m" . $navSubMajorsItem->id)])}}">{{$navSubMajorsItem->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <div class="link-menu">
                                        <a  href="javascript:void(0)">{{$item->name}}</a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        @if (!Auth::check())
                            <li class="bd-top">
                                <div class="link-menu">
                                    <a href="/login">
                                        Đăng nhập
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if (Auth::check())
                            <li class="bd-top">
                                <div class="link-menu">
                                    <a href="/logout">
                                        Đăng xuất
                                    </a>
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>

            </div>
        </div>
    </div>
  </div>
