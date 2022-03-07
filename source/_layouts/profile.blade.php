@extends('_layouts.master')

@section('nav-toggle')
    @include('_nav.menu-toggle')
@endsection

@section('body')
<div class="relative -mt-8 mb-8 w-full">
    <img src="/assets/images/banner.jpg" class="w-full" />
    <div class="absolute z-10 bottom-0 w-full">
        <div class="container max-w-8xl mx-auto px-6 md:px-8 py-5">
            <div class="text-3xl font-bold text-white">
                Profile
            </div>
        </div>
    </div>
</div>
<section class="container max-w-8xl mx-auto px-6 md:px-8 py-4">
    <div class="flex flex-col lg:flex-row">
        <nav id="js-nav-menu" class="nav-menu hidden lg:block">
            @include('_nav.menu', ['items' => $page->navigation])
        </nav>

        <div class="DocSearch-content w-full lg:w-3/5 break-words pb-16 lg:pl-4" v-pre>
            <article class="prose prose-sm max-w-none">
                @yield('content')
            </article>
        </div>
    </div>
</section>
@endsection
