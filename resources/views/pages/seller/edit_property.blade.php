@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
    {{-- header --}}
    <x-buyer.header />

    <section class="container mx-auto py-10 px-3 lg:px-0">
        <h1 class="text-text font-serif font-bold">- EDIT PROPERTY</h1>
        {{-- alert section --}}
        <x-alert/>
        {{-- update propery form --}}
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
                        <input type="text" onclick="toggleMap()" id="address" name="address"
                            class="border-b outline-none border-text  bg-transparent w-full pt-3 peer focus:border-b-2"
                            placeholder=" " value="{{ $property->address }}">
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">Google
                            map address</label>
                    </div>
                </div>
                <div id="maps" class=" grid  md:gap-x-6 pt-2">
                    <div id="map" class="" style="height: 400px;width:100%"></div>
                    <input type="hidden" name="longitude" value="{{ $property->longitude }}" id="longitude">
                    <input type="hidden" name="latitude" value="{{ $property->latitude }}" id="latitude">
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
                <div>
                    <div class="relative mt-10">

                        <select value="" name="area_situation"
                            class="border-b outline-none border-text  bg-transparent w-full pt-3 pb-1.5 peer focus:border-b-2">
                            <option value="" selected>Choose...</option>
                            <option value="none"  {{ $property->area_situation == 'none' ? 'selected' : '' }}>None</option>
                            <option value="flood_prone_area"  {{ $property->area_situation == 'flood_prone_area' ? 'selected' : '' }}>Flood-proof Area</option>
                            <option value="landslide"  {{ $property->area_situation == 'landslide' ? 'selected' : '' }}>Low Landslide Risk</option>
                            <option value="earthquake"  {{ $property->area_situation == 'earthquake' ? 'selected' : '' }}>Earthquake Safe Zone</option>

                        </select>
                        <label for=""
                            class="absolute -top-4 left-0 -z-10 text-sm text-text peer-placeholder-shown:top-3 peer-placeholder-shown:text-text/60 peer-focus:-top-4 peer-focus:text-text transition-all ease-in-out">House
                            Type</label>
                        @error('area_situation')
                            <small class="text-red-500 font-medium">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="relative mt-10">
                    <h1 class="text-paragraph">Description</h1>
                    <textarea id="ckeditor" name="description">{{ $property->description }}</textarea>
                </div>

                <div class="mt-10 relative ">
                    <h1 class="text-xl">Amenities</h1>

                    <div class="p-4">
                        <h2 class="text-sm">Outdoor Amenities:</h2>
                        @error('outdoor')
                        <small class="text-red-500 font-medium">{{ $message }}</small>
                    @enderror
                        <div class="p-3 grid grid-cols-3">
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Garden/landscaped yard',$odoor) ? 'checked' : '' }} value="Garden/landscaped yard" id="">
                                <small>Garden/landscaped yard</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Patio/deck',$odoor) ? 'checked' : '' }} value="Patio/deck" id="">
                                <small>Patio/deck</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Swimming pool',$odoor) ? 'checked' : '' }} value="Swimming pool" id="">
                                <small>Swimming pool</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Outdoor kitchen/BBQ area',$odoor) ? 'checked' : '' }} value="Outdoor kitchen/BBQ area" id="">
                                <small>Outdoor kitchen/BBQ area</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Playground area',$odoor) ? 'checked' : '' }}  value="Playground area" id="">
                                <small>Playground area</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Tennis/basketball court',$odoor) ? 'checked' : '' }}  value="Tennis/basketball court" id="">
                                <small>Tennis/basketball court</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Fenced yard',$odoor) ? 'checked' : '' }} value="Fenced yard" id="">
                                <small>Fenced yard</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="outdoor[]" {{ in_array('Outdoor lighting',$odoor) ? 'checked' : '' }} value="Outdoor lighting" id="">
                                <small>Outdoor lighting</small>
                            </div>
                        </div>
                        <h2 class="text-sm">Indoor Amenities:</h2>
                        @error('indoor')
                        <small class="text-red-500 font-medium">{{ $message }}</small>
                    @enderror
                        <div class="p-3 grid grid-cols-3">

                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Fireplace',$idoor) ? 'checked' : '' }}  value="Fireplace"  id="">
                                <small>Fireplace</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Home office/study room',$idoor) ? 'checked' : '' }}  value="Home office/study room" id="">
                                <small>Home office/study room</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Laundry room',$idoor) ? 'checked' : '' }} value="Laundry room" id="">
                                <small>Laundry room</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Walk-in closets',$idoor) ? 'checked' : '' }}  value="Walk-in closets" id="">
                                <small>Walk-in closets</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Home theater/media room',$idoor) ? 'checked' : '' }} value="Home theater/media room" id="">
                                <small>Home theater/media room</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Gym/fitness room',$idoor) ? 'checked' : '' }} value="Gym/fitness room" id="">
                                <small>Gym/fitness room</small>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Wine cellar',$idoor) ? 'checked' : '' }} value="Wine cellar" id="">
                                <small>Wine cellar</small>
                            </div>
                            <div class="flex items-center gap-x-2 col-span-2">
                                <input type="checkbox" name="indoor[]" {{ in_array('Air conditioning/heating system',$idoor) ? 'checked' : '' }} value="Air conditioning/heating system"
                                    id="">
                                <small>Air conditioning/heating system</small>
                            </div>
                        </div>
                    </div>
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

    {{-- text editor cdn --}}
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
    {{-- map script --}}
    <script>
        const latitude = document.querySelector('#latitude').value;
        const longitude = document.querySelector('#longitude').value;

        // Initialize the map
        const map = L.map('map').setView([latitude, longitude], 16);

        // Add a tile layer to the map (you can choose a different tile provider)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
         map.on('click',async function(e) {
            const latitude = e.latlng.lat;
            const longitude = e.latlng.lng;
            document.querySelector('#latitude').value = latitude;
            document.querySelector('#longitude').value = longitude;
            const reverseGeocodeUrl =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;
           await fetch(reverseGeocodeUrl)
                .then(response => response.json())
                .then(data => {
                    // Extract and display the address
                    const address = data.display_name;
                    document.querySelector('#address').value = address;
                })
                .catch(error => console.error('Error fetching reverse geocoding data:', error));

            marker.setLatLng([latitude, longitude]);

            // Update the popup content if needed
            marker.getPopup().setContent(`<b>${document.querySelector('#address').value}</b>`).update();

            // Open the popup
            marker.openPopup();
        })
        const marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup("<b>Location Rizal</b>").openPopup();

        const maps = document.querySelector('#maps');

        function toggleMap() {

            maps.classList.toggle('hidden')


        }


    </script>
@endsection
