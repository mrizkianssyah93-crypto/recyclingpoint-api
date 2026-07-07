class WasteBank {
  final int id;

  final String nama;

  final String alamat;

  final double latitude;

  final double longitude;

  const WasteBank({
    required this.id,
    required this.nama,
    required this.alamat,
    required this.latitude,
    required this.longitude,
  });

  factory WasteBank.fromJson(
    Map<String, dynamic> json,
  ) {
    return WasteBank(
      id: json["id"],
      nama: json["nama"] ?? "",
      alamat: json["alamat"] ?? "",
      latitude:
          double.tryParse(
                json["latitude"].toString(),
              ) ??
              0,
      longitude:
          double.tryParse(
                json["longitude"].toString(),
              ) ??
              0,
    );
  }
}