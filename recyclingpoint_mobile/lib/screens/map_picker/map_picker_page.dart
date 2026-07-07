import 'package:flutter/material.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:geolocator/geolocator.dart';

class MapPickerPage extends StatefulWidget {
  const MapPickerPage({super.key});

  @override
  State<MapPickerPage> createState() => _MapPickerPageState();
}

class _MapPickerPageState extends State<MapPickerPage> {
  GoogleMapController? mapController;

  LatLng? selectedLocation;

  bool loading = true;

  @override
  void initState() {
    super.initState();
    loadCurrentLocation();
  }

  Future<void> loadCurrentLocation() async {
    bool enabled =
        await Geolocator.isLocationServiceEnabled();

    if (!enabled) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text("GPS belum aktif"),
        ),
      );
      return;
    }

    LocationPermission permission =
        await Geolocator.checkPermission();

    if (permission == LocationPermission.denied) {
      permission =
          await Geolocator.requestPermission();
    }

    if (permission ==
            LocationPermission.deniedForever ||
        permission == LocationPermission.denied) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text("Permission lokasi ditolak"),
        ),
      );
      return;
    }

    final Position position =
        await Geolocator.getCurrentPosition();

    selectedLocation = LatLng(
      position.latitude,
      position.longitude,
    );

    setState(() {
      loading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    if (loading) {
      return const Scaffold(
        body: Center(
          child: CircularProgressIndicator(),
        ),
      );
    }

    return Scaffold(
      appBar: AppBar(
        title: const Text(
          "Pilih Lokasi Pickup",
        ),
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,
      ),

      body: GoogleMap(
        initialCameraPosition: CameraPosition(
          target: selectedLocation!,
          zoom: 16,
        ),

        myLocationEnabled: true,

        myLocationButtonEnabled: true,

        zoomControlsEnabled: false,

        onMapCreated: (controller) {
          mapController = controller;
        },

        onTap: (LatLng latLng) {
          setState(() {
            selectedLocation = latLng;
          });
        },

        markers: {
          Marker(
            markerId: const MarkerId("pickup"),

            position: selectedLocation!,
          ),
        },
      ),

      floatingActionButton: FloatingActionButton.extended(
  backgroundColor: Colors.green,

  onPressed: () async {
    if (selectedLocation == null) return;

    Navigator.pop(
      context,
      {
        "latitude": selectedLocation!.latitude,
        "longitude": selectedLocation!.longitude,
      },
    );
  },

  icon: const Icon(Icons.check),

  label: const Text(
    "Gunakan Lokasi Ini",
  ),
),   );
  }
}