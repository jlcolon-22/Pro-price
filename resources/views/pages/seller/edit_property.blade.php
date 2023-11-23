@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10">
        <h1 class="text-text font-serif font-bold">- EDIT PROPERTY</h1>
        <x-alert/>
        <form novalidate action="{{ route('seller_update_property',['id'=>$property->id]) }}" method="post" enctype="multipart/form-data"
            class="grid md:grid-cols-2 gap-10 pt-10 z-0">
            @csrf

            {{-- left  --}}
            <div>
                <div class="relative">
                    <input type="text" name="title"
                        class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                        placeholder=" " value="{{ $property->title }}">
                    <label for=""
                        class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Title</label>
                </div>
                <div class="grid md:grid-cols-2 md:gap-x-6">
                    <div class="relative mt-10">
                        <input type="number" name="price"
                            class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->price }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Price</label>
                    </div>

                    <div class="relative mt-10">
                        <input type="text" name="address"
                            class="border-b outline-none border-text  bg-transparent w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->address }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Google
                            map address</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-x-6">
                    <div class="relative mt-10">
                        <input type="number" name="land_size"
                            class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->land_size }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Land
                            Size</label>
                    </div>

                    <div class="relative mt-10">
                        <input type="text" name="floor_area"
                            class="border-b outline-none border-text  bg-transparent w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->floor_area }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Floor
                            Area</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-x-6">
                    <div class="relative mt-10">
                        <input type="number" name="bed_room"
                            class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{$property->bed_room }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">BedRooms</label>
                    </div>

                    <div class="relative mt-10">
                        <input type="text" name="bath_room"
                            class="border-b outline-none border-text  bg-transparent w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->bath_room }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Bathrooms</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-x-6">
                    <div class="relative mt-10">
                        <input type="number" name="floor_number"
                            class="border-b outline-none bg-transparent border-text w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->floor_number}}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Floor
                            Number</label>
                    </div>

                    <div class="relative mt-10">
                        <select value="" required autocomplete="off"  name="type" class="border-b outline-none border-text  bg-transparent w-full pt-3 pb-1.5 peer focus:border-b-2">
                            <option value="" >Choose...</option>
                            <option value="Bungalow"  {{ $property->type == 'Bungalow' ? 'selected' : '' }}>Bungalow</option>
                            <option value="Townhouse"  {{ $property->type == 'Townhouse' ? 'selected' : '' }}>Townhouse</option>
                            <option value="Duplex"  {{ $property->type == 'Duplex' ? 'selected' : '' }}>Duplex</option>
                            <option value="Single Attached"  {{ $property->type == 'Single Attached' ? 'selected' : '' }}>Single Attached</option>
                        </select>
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Type</label>


                    </div>
                </div>
                <div class="relative mt-10">
                    <h1 class="text-paragraph">Description</h1>
                    <textarea id="ckeditor" name="description">{{ $property->description }}</textarea>
                </div>
            </div>
            {{-- right --}}
            <div>
                <h1>Upload Photo <span class="text-gray-500"> (max 5 photo)</span></h1>
                <div class="relative grid grid-cols-3 gap-2" id="photoContainer">
                    <button id="buttonAdd" type="button" onclick="addPhoto()" class="relative buttonAdd floa">
                        <label   class="w-fit z-0">
                            <div class="relative overflow-hidden border-2 border-gray-600 flex justify-center items-center h-[8rem] ">

                            <img src="{{ asset('icons/plus.svg') }}" class="-z-10 object-cover absolute opacity-40" alt="">

                            </div>
                        </label>


                    </button>
                    @foreach ($property->photos as $photo)
                    {{-- @if ($loop->first)
                    <div class="relative">
                        <label for="photo1"  class="w-fit z-0">
                            <div class="relative overflow-hidden border-2 border-gray-600 flex justify-center items-center h-[8rem] ">
                                <svg class="w-8 h-8 mb-4 text-gray-600  aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>

                            <img src="{{ asset($photo->photo) }}" class="-z-10 object-cover absolute opacity-40" alt="">

                            </div>
                        </label>
                        <input type="file" id="photo1" name="photo[]"  onchange="previewImageProperty(this)"
                        class="border hidden px-2 outline-none border-text w-full py-3 peer focus:border-b-2"
                        placeholder=" ">

                    </div>
                  --}}
                    <div class="relative img-{{ $loop->index }}}">
                        <label   class="w-fit z-0">
                            <div class="relative overflow-hidden border-2 border-gray-600 flex justify-center items-center h-[8rem] ">
                                <svg class="w-8 h-8 mb-4 text-gray-600  aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <img src="{{ asset($photo->photo) }}" class="-z-10 object-cover absolute opacity-40" alt="">

                            </div>
                        </label>
                        <input type="file" id="photo{{ $loop->index }}" name="photo[]" required onchange="previewImageProperty(this)"
                        class="border hidden px-2 outline-none border-text w-full py-3 peer focus:border-b-2"
                        placeholder=" ">
                        <a href="{{ route('seller_delete_property_photo',['id'=>$photo->id]) }}"><img src="{{ asset('icons/x.svg') }}"  class="absolute top-3 right-2 bg-red-500  rounded-full" alt=""></a>
                    </div>


                    @endforeach

                </div>

                <h1 class="mt-10">Upload Copy of Title of land</h1>
                <div class="grid md:grid-cols-3">
                    <div class="relative">
                        <label for="copyTitle"  class="w-fit z-0">
                            <div class="relative overflow-hidden border-2 border-gray-600 flex justify-center items-center h-[8rem] ">
                                <svg class="w-8 h-8 mb-4 text-gray-600  aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>

                            <img src="{{ asset($property->title_copy) }}" class="-z-10 object-cover absolute opacity-40" alt="">

                            </div>
                        </label>
                        <input type="file" id="copyTitle" name="title_copy"  onchange="previewImageProperty(this)"
                        class="border hidden px-2 outline-none border-text w-full py-3 peer focus:border-b-2"
                        placeholder=" ">
                        @error('title_copy')
                        <small class="text-red-500 font-medium">{{ $message }}</small>
                    @enderror
                    </div>

                </div>
            </div>
            <button type="submit" class="bg-green-600 text-white hover:bg-green-500 px-3 py-2">UPDATE PROPERTY</button>
        </form>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },

                {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "insert",
                    "groups": ["insert"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                },

            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord,Image,Source'
        });


        const photoContainer = document.querySelector('#photoContainer');

        var i = 1;

        async function addPhoto() {

            i++;


            photoContainer.insertAdjacentHTML('beforeend', ` <div class="relative img-${i+2}">
                        <label for="photo${i+2}"  class="w-fit z-0">
                            <div class="relative overflow-hidden border-2 border-gray-600 flex justify-center items-center h-[8rem] ">
                                <svg class="w-8 h-8 mb-4 text-gray-600  aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <img src="" class="-z-10 object-cover absolute opacity-40" alt="">

                            </div>
                        </label>
                        <input type="file" id="photo${i+2}" name="photo[]" required onchange="previewImageProperty(this)"
                        class="border hidden px-2 outline-none border-text w-full py-3 peer focus:border-b-2"
                        placeholder=" ">
                        <img src="{{ asset('icons/x.svg') }}" onclick="removePhoto('${'img-'+(i+2)}')" class="absolute top-3 right-2 bg-red-500  rounded-full" alt="">
                    </div>


                    `)


            if (photoContainer.children.length == 6) {
                buttonAdd.disabled = true
                buttonAdd.classList.add('opacity-50')
            }

        }

        function removePhoto(id) {

            const element = document.querySelector('.' + id);
            element.remove();
            if (photoContainer.children.length < 5) {
                buttonAdd.disabled = false
                buttonAdd.classList.remove('opacity-50')
            }
        }
    </script>
@endsection
