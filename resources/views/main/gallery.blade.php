@extends('template.layout-main')
@section('title_web', 'Galeri | Hema.Indonesia')
@section('content-main')
    <div class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <div class="block">
                <nav aria-label="breadcrumb" class="w-full">
                    <ol class="flex w-full flex-wrap items-center mb-2">
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/') }}">Beranda</a>
                            <span class="pointer-events-none mx-2 text-slate-800">
                                /
                            </span>
                        </li>
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/gallery') }}">Galeri</a>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-[20px] md:text-2xl font-bold">
                    Galeri | <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, id?</p>
            </div>
        </div>
    </div>

    <section class="gallery container py-24">

        <main id="content_gallery" class="content_gallery w-full flex md:gap-[1rem]">
            @if ($count_gallery > 0)
                @foreach ($data as $gallery)
                    <div
                        class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                        <div class="">
                            <a href="{{ asset('uploads/gallery/' . $gallery->image) }}" class="image-popup">
                                <img class="img-fluid w-full h-auto" src="{{ asset('uploads/gallery/' . $gallery->image) }}"
                                    alt="{{ $gallery->title }}">
                            </a>
                            <div class="text-justify">
                                <p class="text-gray-800 pt-1.5">{{ $gallery->title }}</p>
                                <span class="text-sm text-gray-500">{{ $gallery->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div
                    class="border shadow-sm text-center flex justify-center items-center w-full lg:w-full border-slate-200 p-5">
                    <p>Data Gallery tidak dapat ditemukan!</p>
                </div>
            @endif

        </main>
    </section>
@endsection
