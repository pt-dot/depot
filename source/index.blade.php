@extends('_layouts.master')

@section('body')
<section class="container max-w-6xl mx-auto px-6 py-10 md:py-12">
    <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8">
            <h1 id="intro-docs-template">{{ $page->siteName }}</h1>

            <h2 id="intro-powered-by-jigsaw" class="font-light mt-4">{{ $page->siteDescription }}</h2>

            <p class="text-lg">Tempat Sentimental Engineer DOT Indonesia dalam mencari panduan  <span class="line-through">hidup</span> <span class="italic font-semibold">"get sh*t done"</span>.</p>

            <div class="flex my-10">
                <a href="/docs/company/profile" title="{{ $page->siteName }} getting started" class="bg-brand-500 hover:bg-brand-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Mulai</a>

                <a href="https://dot.co.id" title="About DOT Indonesia" class="bg-gray-400 hover:bg-gray-600 text-blue-900 font-normal hover:text-white rounded py-2 px-6">Tentang DOT Indonesia</a>
            </div>
        </div>

        <img src="/assets/img/logo-large.svg" alt="{{ $page->siteName }} large logo" class="mx-auto mb-6 lg:mb-0 ">
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="md:flex -mx-2 -mx-4">
        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-window.svg" class="h-12 w-12" alt="window icon">

            <h3 id="intro-laravel" class="text-2xl text-blue-900 mb-0">Apa Itu DEPOT?</h3>

            <p>DEPOT atau DOT Engineering Portal merupakan sebuah portal yang berisi semua sumber daya dan panduan kerja departemen engineering DOT Indonesia.</p>
        </div>

        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-terminal.svg" class="h-12 w-12" alt="terminal icon">

            <h3 id="intro-markdown" class="text-2xl text-blue-900 mb-0">Semuanya Bisa Berkontribusi</h3>

            <p>Dengan semangat keterbukaan, kami menyarankan kepada DOT Indonesia ranger untuk berkontribusi untuk menjadikan panduan-panduan DEPOT lebih baik.</p>
        </div>

        <div class="mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-stack.svg" class="h-12 w-12" alt="stack icon">

            <h3 id="intro-mix" class="text-2xl text-blue-900 mb-0">Panduan Lengkap</h3>

            <p>Kami ingin menyediakan panduan yang lebih bernilai sehingga Ranger kami tidak kehilangan arah dan dapat dengan mudah menyesuaikan dengan visi perusahaan.</p>
        </div>
    </div>
</section>
@endsection
