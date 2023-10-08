<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- card  --}}

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                thumbnail
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Judul
                            </th>
                            <th scope="col" class="px-6 py-3">
                                kategori
                            </th>
                            <th scope="col" class="px-6 py-3">
                                action
                            </th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($post as $item)
                            @inject('post', 'Illuminate\Support\Str')
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('post.show', $item->id) }}" style="color: white"
                                        class="text-decoration-none">
                                        {{ $item->id }}
                                    </a>
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('post.show', $item->id) }}" class="text-decoration-none">

                                        @php
                                            $htmlContent = $item->postingan;
                                            preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $htmlContent, $match);
                                            if (empty($match)) {
                                                $gambar_src = 'no-image.png';
                                            } else {
                                                $gambar_src = $match[1];
                                            }
                                            
                                        @endphp
                                        <img src="{{ $gambar_src }}" alt="" width="100px" height="100px">
                                    </a>
                                </th>
                                <td class="px-6 py-4">
                                    <a href="{{ route('post.show', $item->id) }}" class="text-decoration-none">

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
                                        <p style="font-size: large">{{ $judul }}</p>
                                    </a>
                                </td>
                                <td class="px-6 py-4">

                                    @if ($item->kategori == null) 
                                    <button style="color: white" class="bg-red-700 py-2 px-4">Kosong</button>  
                                 
                                    
                                    @else 
                                       {{$item->kategori->nama}} 
                                    
@endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-row  space-x-3">
                                        <form action="{{ route('post.edit', $item) }}" method="get">
                                            @csrf
                                            <button class="bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                                Edit
                                            </button>
                                        </form>
                                        <form action="{{ route('post.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
    </div>
</x-app-layout>
