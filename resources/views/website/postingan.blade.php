<x-app-layout>
    <script>
        window.onbeforeunload = function() {
            return "Gambar postignan tidak akan tersimpan";
        }
    </script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists | image | link',
            toolbar: 'undo redo | formatselect |fontfamily fontsize blocks bold italic alignleft aligncenter alignright alignjustify indent outdent | bullist numlist | image link |table| code ',
            promotion: false,
            branding: false,
            automatic_uploads: true,
            file_picker_types: 'image',
            skin: 'oxide-dark',
            content_css: "dark",
            image_class_list: [{
                title: 'Responsive',
                value: 'img-fluid'
            }],

            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');


                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {

                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
        });
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah postingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Tambah Kategori') }}
                    </h2>


                    {{-- form untuk kategori  --}}
                    <form action="{{ route('kategori.store') }}" method="post" class="mt-6 space-y-6 text-white"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="nama" />

                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Tambah</button>
                    </form>
<br>
<div style="color: white">
                    <details class="dropdown w-60">
                        <summary class="m-1 btn" style="font-size: larger">Edit Kategori</summary>
                        <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                        
                                <th>Nama kategori</th>
                                <th>Aksi</th>
                            </tr>
                    </thead>
                      
                            @foreach ($kategori as $item)
                            <tr>
                                <td>
                                <div class="flex flex-row  space-x-3">
                                        {{ $item->nama }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-row  space-x-3">
                                <form action="{{ route('kategori.destroy', $item) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>
                                <form action="{{ route('kategori.edit', $item) }}" method="get">
                                    @csrf
                                    <button class="bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </button>
                                </form>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </table>

                      
                        <div class="relative overflow-x-auto">
                    </details>
                </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Tambah postingan') }}
                        </h2>
                        {{-- form untuk postingan  --}}
                        <form action="{{ route('post.store') }}" method="post" class="mt-12 space-y-12 text-white"
                            enctype="multipart/form-data">
                            @csrf
                            <p>Petunjuk:
                                <br>
                                -Heading 1 pertama akan menjadi judul dari postingan
                                <br>
                                -gambar pertama akan menjadi thumbnail
                                <br>
                                -Refresh page akan menyebabkan gambar ERROR!!!
                            </p>




                            <label for="kategori_id">Pilih kategori postingan</label>

                            <details class="dropdown w-60">
                                <summary class="m-1 btn">Pilih Kategori</summary>
                                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                                    @foreach ($kategori as $item)
                                        <div class="flex flex-row  space-x-3">
                                            <li><input type="radio" name="kategori_id" value="{{ $item->id }}">
                                                {{ $item->nama }}</li>
                                        </div>
                                    @endforeach

                                </ul>
                            </details>

                    </div>
                    <div>
                    </div>
                    <textarea id="myeditorinstance" name="postingan" rows="35"> 
                    </textarea>
                    <br>
                    <br>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Tambah</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- buat nampilin gambar yang baru diupload --}}
    <script type="text/javascript">
        thumbnail.onchange = evt => {
            const [file] = thumbnail.files
            if (file) {
                load.src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>
