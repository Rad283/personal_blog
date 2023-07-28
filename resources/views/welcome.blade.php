@extends('layouts.template')
@section('content')
    <header class="headerimg" style="background-image: url({{ asset('storage' . $website->header_image) }});">
        <img src="{{ asset('storage' . $website->header_image) }}" class="responsive" />
    </header>
    <p style="background-color: rgb(30,30,30);width: auto;height: auto;">
        ㅤ
    </p>
    <div class="container">
        <center>
            <h2>welcome to my website</h2>
        </center>
        <br>
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">

            @foreach ($post as $item)
                @inject('post', 'Illuminate\Support\Str')
                <div class="col">
                    <div class="card h-100" style="background-color: #2d2d30;">
                        <a href="{{ route('post.show', $item->id) }}" style="color: white" class="text-decoration-none">
                            <div>
                                <img class="card-img-top w-100 d-block fit-cover" style="height: 200px;"
                                    src="{{ asset('storage' . $item->thumbnail) }}">
                            </div>
                            <div class="card-body p-4">
                                <h4 class="card-title">
                                    @php
                                        $postingan = strip_tags($item->judul);
                                        echo Str::limit($postingan, 50);
                                    @endphp</p>
                                </h4>


                                <p class="card-text">@php
                                    $postingan = strip_tags($item->postingan);
                                    echo Str::limit($postingan, 100);
                                @endphp</p>
                            </div>
                            <br>
                            <br>
                            <div class="card-footer"
                                style=" position: absolute;
                            bottom: 0;
                            width: 100%;
                            ">
                                <center>
                                    <p class="text-primary">{{ $item->nama }}</p>
                                </center>
                            </div>



                        </a>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
    </div>
    <br>
    <br>
@endsection
