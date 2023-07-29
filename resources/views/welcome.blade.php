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
                                {{-- thumbnail diambil dari tag image  --}}
                                @php
                                    $htmlContent = $item->postingan;
                                    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $htmlContent, $match);
                                    if (empty($match)) {
                                        $gambar_src = 'no-image.png';
                                    } else {
                                        $gambar_src = $match[1];
                                    }
                                    
                                @endphp
                                <img class="card-img-top w-100 d-block fit-cover" style="height: 200px;"
                                    src="{{ $gambar_src }}">
                            </div>
                            <div class="card-body p-4">
                                <h4 class="card-title">
                                    {{-- judul postingan dengan h1 pertama dari isi postingan --}}
                                    @php
                                        $htmlContent = $item->postingan;
                                        preg_match('/<h1>(.*?)<\/h1>/s', $htmlContent, $match);
                                        if (empty($match)) {
                                            $judul = 'Tidak ada judul';
                                        } else {
                                            $raw = $match[1];
                                            $judul = html_entity_decode(strip_tags($raw));
                                        }
                                    @endphp
                                    {{ Str::limit($judul, 65) }}
                                </h4>

                                {{-- preview isi postingan dan hapus tag h1 pertama dari preview --}}
                                <p class="card-text">@php
                                    
                                    $postingan = strip_tags($item->postingan);
                                    $preview = trim($postingan, $judul);
                                    echo Str::limit($preview, 110);
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
