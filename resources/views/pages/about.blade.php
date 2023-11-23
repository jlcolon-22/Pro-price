@extends('layouts.app')

@section('title', 'About Us')



@section('content')
    {{-- header --}}
    <x-buyer.header />
    <section class="container mx-auto py-10">
        <div class="p-4 min-h-screen">
            <div class="max-w-7xl mx-auto h-max px-6 md:px-12 xl:px-6">
                <div class="md:w-2/3 lg:w-1/2">


                    <h2 class="my-8 text-2xl font-bold text-text md:text-4xl">About Pro-Price</h2>
                    <p class="text-text"> Your Ideal Real Estate Companion</p>
                </div>

            </div>
        </div>
        <div id="map" style="height: 400px;"></div>
    </section>
@endsection


@section('scripts')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="https://npmcdn.com/leaflet-geometryutil"></script>


    <script>
  var llPolyline1 = [
    [51.51086, -0.13184],
    [51.51268, -0.11518],
    [51.51268, -0.07347],
  ],
  llPolyline2 = [
    [51.51033, -0.05287],
    [51.50093, -0.04137],
    [51.49206, -0.06866],
  ],
  llSegment = [
    [51.49024, -0.13184],
    [51.49024, -0.04137],
  ],
  llPolygon1 = [
    [
      [51.50349, -0.12892],
      [51.50958, -0.08926],
      [51.49933, -0.0758],
      [51.49612, -0.10557],
      [51.49024, -0.12257],
    ], // outer ring
    [
      [51.50189, -0.12531],
      [51.50758, -0.08926],
      [51.49933, -0.0858],
      [51.49812, -0.10557],
      [51.49224, -0.12157],
    ], // hole
  ],
  _map = L.map('map').setView([51.505, -0.09], 13),
  polygon1 = L.polygon(llPolygon1, {
    color: 'blue',
    className: 'polygon1',
  }).addTo(_map),
  polyline1 = L.polyline(llPolyline1, {
    color: 'blue',
    className: 'polyline1',
  }).addTo(_map),
  polyline2 = L.polyline(llPolyline2, {
    color: 'blue',
    className: 'polyline2',
  }).addTo(_map),
  segment = L.polyline(llSegment, { color: 'red', className: 'segment' }).addTo(
    _map
  ),
  marker = null,
  markerClosestPolygon1 = null,
  markerClosestPolyline1 = null,
  markerClosestPolyline2 = null,
  markerClosestSegment = null;

// console.log("latlngs of polygon1")
// console.log(polygon1.getLatLngs())
// console.log("latlngs of polyline1")
// console.log(polyline1.getLatLngs())
// console.log("latlngs of polyline2")
// console.log(polyline2.getLatLngs())

function init() {
  if (marker) _map.removeLayer(marker);
  if (markerClosestPolygon1) _map.removeLayer(markerClosestPolygon1);
  if (markerClosestPolyline1) _map.removeLayer(markerClosestPolyline1);
  if (markerClosestPolyline2) _map.removeLayer(markerClosestPolyline2);
  if (markerClosestSegment) _map.removeLayer(markerClosestSegment);

  polygon1.setStyle({ color: 'blue' });
  polyline1.setStyle({ color: 'blue' });
  polyline2.setStyle({ color: 'blue' });

  document.getElementById('closestLayer').innerHTML = '';
  document.getElementById('closestLayerSnap').innerHTML = '';
}

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
  attribution:
    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(_map);

_map.on('click', function (e) {
  init();

  marker = L.marker(e.latlng)
    .addTo(_map)
    .bindPopup(e.latlng + '<br/>' + e.layerPoint)
    .openPopup();

  var p_vertices = document.getElementById('p_vertices').checked,
    p_tolerance =
      document.getElementById('p_tolerance').value !== ''
        ? parseInt(document.getElementById('p_tolerance').value)
        : Infinity,
    p_withVertices = document.getElementById('p_withVertices').checked,
    closestPointToPolygon1 = L.GeometryUtil.closest(
      _map,
      polygon1,
      e.latlng,
      p_vertices
    ),
    closestPointToPolyline1 = L.GeometryUtil.closest(
      _map,
      polyline1,
      e.latlng,
      p_vertices
    ),
    closestPointToPolyline2 = L.GeometryUtil.closest(
      _map,
      polyline2,
      e.latlng,
      p_vertices
    ),
    closestLayer = L.GeometryUtil.closestLayer(
      _map,
      [polyline1, polyline2, polygon1],
      e.latlng
    ),
    closestLayerSnap = L.GeometryUtil.closestLayerSnap(
      _map,
      [polyline1, polygon1, polyline2],
      e.latlng,
      p_tolerance,
      p_withVertices
    ),
    closestOnSegment = L.GeometryUtil.closestOnSegment(
      _map,
      e.latlng,
      llSegment[0],
      llSegment[1]
    );

  // display the closest points
  markerClosestPolygon1 = L.marker(closestPointToPolygon1)
    .addTo(_map)
    .bindPopup('Closest point on polygon1');
  markerClosestPolyline1 = L.marker(closestPointToPolyline1)
    .addTo(_map)
    .bindPopup('Closest point on polyline1');
  markerClosestPolyline2 = L.marker(closestPointToPolyline2)
    .addTo(_map)
    .bindPopup('Closest point on polyline2');

  // change the color of closest layer
  closestLayer.layer.setStyle({ color: 'green' });
  document.getElementById('closestLayer').innerHTML =
    closestLayer.layer.options.className;

  // display the closest position for snap
  document.getElementById('closestLayerSnap').innerHTML = closestLayerSnap
    ? closestLayerSnap.layer.options.className
    : 'unknown';

  // display the closest point on red segment
  markerClosestSegment = L.marker(closestOnSegment)
    .addTo(_map)
    .bindPopup('Closest point on segment');

  console.log(polygon1.getLatLngs());
});


    </script>
@endsection
