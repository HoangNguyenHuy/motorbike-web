<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 10/01/2018
 * Time: 12:54
 */
?>
<header class='header'>
    <div class="container">
        <div class='row'>
            <div class='col-md-3'>
                <a class='header-logo' href='{{ route('home') }}'>
                    <img src='{{ asset('/images/logo.png') }}' width="100" height="100" alt="logo"/>
                </a>
            </div>
            <div class='col-md-6 align-self-center'>
                <div class='header-search'>
                    <form action='/' id='header-search' method='get'>
                        <input id='header-search-input' name='q' placeholder='Tìm kiếm' type='text' value=''/>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <span class="fa fa-search"></span>
                        </button>
                    </form>
                </div>
            </div>
            @if(Auth::user())
                {{--TODO move this in tagbar--}}
                <div class="col-md-3 align-self-top">
                    <p class="d-inline float-right"> {{ Auth::user()->name }} | </p>
                    <a class="float-right" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            @endif
        </div>
    </div>
</header>
@include('navigate')
@if($is_show_slide)
    @include('slide-show')
@endif
