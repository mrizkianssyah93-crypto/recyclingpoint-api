import 'package:flutter/material.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:provider/provider.dart';

import '../../models/waste_bank.dart';
import '../../models/waste_category.dart';
import '../../providers/pickup_provider.dart';
import '../../services/google_map_service.dart';
import '../place_search/place_search_page.dart';

class PickupPage extends StatefulWidget {
  const PickupPage({super.key});

  @override
  State<PickupPage> createState() => _PickupPageState();
}

class _PickupPageState extends State<PickupPage> {
  final GoogleMapService mapService =
      GoogleMapService();

  final TextEditingController
      alamatController =
      TextEditingController();

  final TextEditingController
      noHpController =
      TextEditingController();

  final TextEditingController
      beratController =
      TextEditingController();

  WasteCategory? selectedCategory;

  WasteBank? selectedWasteBank;

  DateTime? selectedDate;
  double? pickupLatitude;
double? pickupLongitude;

  String? selectedTime;

  LatLng? pickupLocation;

  double distanceKm = 0;

  int estimatedValue = 0;

  int pickupFee = 0;

  int netValue = 0;

  final List<String> pickupTime = [
    "08:00 - 10:00",
    "15:00 - 17:00",
  ];

  @override
  void initState() {
    super.initState();

    Future.microtask(() {
      context.read<PickupProvider>().loadData();
    });

    beratController.addListener(() {
      calculateSummary();
    });
  }

  @override
  void dispose() {
    alamatController.dispose();
    noHpController.dispose();
    beratController.dispose();

    super.dispose();
  }

  Future<void> selectDate() async {
    final date = await showDatePicker(
      context: context,
      firstDate: DateTime.now(),
      lastDate: DateTime.now().add(
        const Duration(days: 30),
      ),
      initialDate: DateTime.now(),
    );

    if (date == null) return;

    setState(() {
      selectedDate = date;
    });
  }
  Future<void> selectAddress() async {
  final result = await Navigator.push(
    context,
    MaterialPageRoute(
      builder: (_) => const PlaceSearchPage(),
    ),
  );

  if (result == null) return;

  alamatController.text = result["address"];

  pickupLatitude = result["latitude"];

  pickupLongitude = result["longitude"];

  // TAMBAHKAN BAGIAN INI
  pickupLocation = LatLng(
    pickupLatitude!,
    pickupLongitude!,
  );

  await calculateDistance();

  calculateSummary();

  if (!mounted) return;

  setState(() {});
}

  Future<void> calculateDistance() async {
    if (pickupLocation == null) return;

    if (selectedWasteBank == null) return;

    final origin =
        "${pickupLocation!.latitude},${pickupLocation!.longitude}";

    final destination =
        "${selectedWasteBank!.latitude},${selectedWasteBank!.longitude}";

    distanceKm =
        await mapService.getDistanceKm(
      origin: origin,
      destination: destination,
    );

    calculateSummary();
  }

  void calculateSummary() {
    if (selectedCategory == null) return;

    final berat =
        double.tryParse(
              beratController.text,
            ) ??
            0;

    estimatedValue =
        mapService.calculateEstimatedValue(
      weight: berat,
      pricePerKg:
          selectedCategory!.hargaPerKg,
    );

    pickupFee =
        mapService.calculatePickupFee(
      distanceKm: distanceKm,
      weight: berat,
    );

    netValue =
        mapService.calculateNetValue(
      estimatedValue: estimatedValue,
      pickupFee: pickupFee,
    );

    if (mounted) {
      setState(() {});
    }
  }

  Future<void> submitPickup() async {
    if (selectedCategory == null ||
        selectedWasteBank == null ||
        selectedDate == null ||
        selectedTime == null ||
        pickupLocation == null) {
      ScaffoldMessenger.of(context)
          .showSnackBar(
        const SnackBar(
          content: Text(
            "Lengkapi seluruh data pickup.",
          ),
        ),
      );
      return;
    }

    final provider =
        context.read<PickupProvider>();

    final success =
        await provider.createPickup(
      categoryId: selectedCategory!.id,
      wasteBank:
          selectedWasteBank!.nama,
      alamat:
          alamatController.text,
      noHp: noHpController.text,
      tanggal:
          selectedDate!
              .toIso8601String()
              .substring(0, 10),
      jam: selectedTime!,
      berat: double.tryParse(
            beratController.text,
          ) ??
          0,
      distance: distanceKm,
    );

    if (!mounted) return;

    if (success) {
      ScaffoldMessenger.of(context)
          .showSnackBar(
        const SnackBar(
          backgroundColor: Colors.green,
          content: Text(
            "Pickup berhasil dibuat.",
          ),
        ),
      );

      alamatController.clear();
      noHpController.clear();
      beratController.clear();

      setState(() {
        selectedCategory = null;
        selectedWasteBank = null;
        selectedDate = null;
        selectedTime = null;
        pickupLocation = null;
        distanceKm = 0;
        estimatedValue = 0;
        pickupFee = 0;
        netValue = 0;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
  final provider = context.watch<PickupProvider>();

  return Scaffold(
    appBar: AppBar(
      title: const Text("Pickup"),
      backgroundColor: Colors.green,
      foregroundColor: Colors.white,
    ),
    body: provider.loading
        ? const Center(
            child: CircularProgressIndicator(),
          )
        : SingleChildScrollView(
            padding: const EdgeInsets.all(20),
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
              children: [

                const Text(
                  "Buat Pickup",
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                const SizedBox(height: 25),

                DropdownButtonFormField<WasteCategory>(
  isExpanded: true,
  initialValue: selectedCategory,
  decoration: const InputDecoration(
    labelText: "Kategori Sampah",
    border: OutlineInputBorder(),
  ),
                  items: provider.categories
                      .map(
                        (e) => DropdownMenuItem(
                          value: e,
                          child: Text(e.namaKategori),
                        ),
                      )
                      .toList(),
                  onChanged: (value) {
                    setState(() {
                      selectedCategory = value;
                    });

                    calculateSummary();
                  },
                ),

                const SizedBox(height: 15),

                DropdownButtonFormField<WasteBank>(
  isExpanded: true,
  initialValue: selectedWasteBank,
  decoration: const InputDecoration(
    labelText: "Bank Sampah",
    border: OutlineInputBorder(),
    prefixIcon: Icon(Icons.store),
  ),
                  items: provider.wasteBanks
                      .map(
                        (e) => DropdownMenuItem(
                          value: e,
                          child: Text(e.nama),
                        ),
                      )
                      .toList(),
                  onChanged: (value) async {
                    setState(() {
                      selectedWasteBank = value;
                    });

                    if (pickupLocation != null) {
                      await calculateDistance();
                    }
                  },
                ),

                const SizedBox(height: 15),

                TextField(
  controller: alamatController,
  readOnly: true,
  onTap: selectAddress,
  maxLines: 3,
  decoration: const InputDecoration(
    labelText: "Alamat Lengkap",
    border: OutlineInputBorder(),
    prefixIcon: Icon(Icons.location_on),
    suffixIcon: Icon(Icons.map),
  ),
),

                const SizedBox(height: 15),

                TextField(
                  controller: noHpController,
                  keyboardType:
                      TextInputType.phone,
                  decoration:
                      const InputDecoration(
                    labelText: "Nomor HP",
                    border:
                        OutlineInputBorder(),
                    prefixIcon:
                        Icon(Icons.phone),
                  ),
                ),

                const SizedBox(height: 15),

                TextField(
  controller: beratController,
  keyboardType:
      const TextInputType.numberWithOptions(
    decimal: true,
  ),

  onChanged: (_) {
    calculateSummary();
  },

  decoration: const InputDecoration(
    labelText: "Estimasi Berat (KG)",
    border: OutlineInputBorder(),
    prefixIcon: Icon(Icons.scale),
  ),
),

                const SizedBox(height: 15),

                InkWell(
                  onTap: selectDate,
                  child: InputDecorator(
                    decoration:
                        const InputDecoration(
                      labelText:
                          "Tanggal Pickup",
                      border:
                          OutlineInputBorder(),
                      prefixIcon: Icon(
                        Icons.calendar_month,
                      ),
                    ),
                    child: Text(
                      selectedDate == null
                          ? "Pilih Tanggal"
                          : "${selectedDate!.day}/${selectedDate!.month}/${selectedDate!.year}",
                    ),
                  ),
                ),

                const SizedBox(height: 15),

                DropdownButtonFormField<String>(
                  initialValue:
                      selectedTime,
                  decoration:
                      const InputDecoration(
                    labelText:
                        "Jam Pickup",
                    border:
                        OutlineInputBorder(),
                  ),
                  items: pickupTime
                      .map(
                        (e) =>
                            DropdownMenuItem(
                          value: e,
                          child: Text(e),
                        ),
                      )
                      .toList(),
                  onChanged: (value) {
                    setState(() {
                      selectedTime = value;
                    });
                  },
                ),

                const SizedBox(height: 25),
					Card(
  elevation: 2,
  shape: RoundedRectangleBorder(
    borderRadius: BorderRadius.circular(16),
  ),
  child: Padding(
    padding: const EdgeInsets.all(16),
    child: Column(
      children: [

        _summaryTile(
          "Estimated Value",
          mapService.rupiah(estimatedValue),
          Colors.green,
        ),

        const Divider(),

        _summaryTile(
          "Distance",
          "${distanceKm.toStringAsFixed(2)} KM",
          Colors.blue,
        ),

        const Divider(),

        _summaryTile(
          "Pickup Fee",
          mapService.rupiah(pickupFee),
          Colors.red,
        ),

        const Divider(),

        _summaryTile(
          "Net Value",
          mapService.rupiah(netValue),
          Colors.orange,
        ),
      ],
    ),
  ),
),

const SizedBox(height: 25),

SizedBox(
  width: double.infinity,
  height: 55,
  child: ElevatedButton.icon(
    onPressed:
        provider.loading
            ? null
            : submitPickup,
    icon: const Icon(Icons.send),
    label: Text(
      provider.loading
          ? "Loading..."
          : "Submit Pickup",
    ),
    style: ElevatedButton.styleFrom(
      backgroundColor: Colors.green,
      foregroundColor: Colors.white,
    ),
  ),
),

const SizedBox(height: 25),

Card(
  color: Colors.green.shade50,
  child: const Padding(
    padding: EdgeInsets.all(16),
    child: Row(
      crossAxisAlignment:
          CrossAxisAlignment.start,
      children: [

        Icon(
          Icons.info,
          color: Colors.green,
        ),

        SizedBox(width: 12),

        Expanded(
          child: Text(
            "Pastikan lokasi pickup dipilih melalui Google Maps agar jarak dan ongkir dihitung otomatis.",
          ),
        ),
      ],
    ),
  ),
),

              ],
            ),
          ),
  );
}

Widget _summaryTile(
  String title,
  String value,
  Color color,
) {
  return Row(
    mainAxisAlignment:
        MainAxisAlignment.spaceBetween,
    children: [

      Text(
        title,
        style: const TextStyle(
          fontWeight: FontWeight.w500,
        ),
      ),

      Text(
        value,
        style: TextStyle(
          color: color,
          fontWeight: FontWeight.bold,
          fontSize: 16,
        ),
      ),
    ],
  );
}
}