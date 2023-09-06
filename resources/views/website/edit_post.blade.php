<x-app-layout>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        window.onbeforeunload = function() {
            return "Gambar postignan tidak akan tersimpan";
        }
    </script>
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
            {{ __('Edit postingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit postingan') }}
                    </h2>
                    {{-- form untuk postingan  --}}
                    <form action="{{ route('post.update', $item) }}" method="post" class="mt-12 space-y-12 text-white"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <p>Petunjuk:
                            <br>
                            -Heading 1 pertama akan menjadi judul dari postingan
                            <br>
                            -gambar pertama akan menjadi thumbnail
                            <br>
                            -Refresh page akan menyebabkan gambar ERROR!!!
                        </p>
                        <div>
                            <br>
                            <label for="kategori_id">Pilih kategori postingan</label>
                            <select name="kategori_id" id="kategori_id" style="color:black">
                                <option value="
                                @if($item->kategori == null){
                                    null
                                }
                                @else{
                                    {{$item->kategori->id }}
                                }
                                @endif
                                " selected>
                                @if($item->kategori == null)
                                    null
                                
                                @else
                                    {{$item->kategori->nama }}
                                
                                @endif
                            </option>
                                <option value="
                                @if($item->kategori == null){
                                    null
                                }
                                @else{
                                    {{$item->kategori->nama }}
                                }
                                @endif
                                  
                                </option>
                                @foreach ($kategori as $kate)
                                @if($item->kategori == null){
                                    <option value="{{ $kate->id }}">{{ $kate->nama }}
                                        </option>
                                }
                                    @elseif ($kate->id !== $item->kategori->id)
                                        <option value="{{ $kate->id }}">{{ $kate->nama }}
                                        </option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                </div>
                <br>

                <div>
                </div>
                <textarea id="myeditorinstance" name="postingan" rows="35"> 
                        {{ $item->postingan }}
                    </textarea>
                <br>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Update</button>
                </form>

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
