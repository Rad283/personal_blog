@extends('layouts.template')
@section('content')
    <div class="container">
        <center>
            <br>
        
         <h2>{{$namakategori->nama}}</h2>
        
          
           
            
        </center>
        <br>
        @if ($bol == FALSE)
       
           
      
            
        <div  style="font-size: xx-large;text-align:center;margin-top:30vh;">Kosong ¯\_(ツ)_/¯</div>
                
            @else
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
                                preg_match('/<h1[.]?[style="]?(.*?)]@endphp(.*?)?<\/h1>/s', $htmlContent, $match);
                              if (empty($match)) {
                                  $judul = 'Tidak ada judul';
                                    } else {
                                        $raw = $match[2];
                                        $judul = html_entity_decode(strip_tags($raw));
                                    }
                                    ?>
                                {{ Str::limit($judul, 65) }}
                            </h4>

                            {{-- preview isi postingan dan hapus tag h1 pertama dari preview --}}
                            <p class="card-text">@php
                                
                                $postingan = strip_tags($item->postingan);
                                $preview = trim($postingan, $judul);
                                echo Str::limit($preview, 110);
                            @endphp
                            </p>
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
        @endif
        
           
        </div>


    </div>
    </div>
    <br>
    <br>
@endsection
