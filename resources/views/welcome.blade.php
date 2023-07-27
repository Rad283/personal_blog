<x-template>
    @include('layouts/navbar')
    <header class="headerimg">
        <img src="{{ asset('storage/' . $website->header_image) }}" class="responsive" />
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
                    <div class="card h-100" style="background-color: rgb(62,62,66);"><img
                            class="card-img-top w-100 d-block fit-cover" style="height: 200px;"
                            src="{{ asset('storage' . $item->thumbnail) }}">
                        <div class="card-body p-4">
                            <p class="text-primary card-text mb-0">{{ $item->kategori->nama }}</p>
                            <h4 class="card-title">{{ $item->judul }}</h4>
                            <p class="card-text">@php
                                $postingan = strip_tags($item->postingan);
                                echo Str::limit($postingan, 120);
                            @endphp</p>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <br>
    <br>

    @include('layouts/footer')
</x-template>
