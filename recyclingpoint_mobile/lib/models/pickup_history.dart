class PickupHistory {
  final int id;

  final String status;

  final String wasteCategory;

  final String wasteBankName;

  final double weight;

  final String pickupDate;

  final String pickupTime;

  final double distanceKm;

  final int pickupFee;
  final int estimatedValue;

final int netValue;

  PickupHistory({
    required this.id,
    required this.status,
    required this.wasteCategory,
    required this.wasteBankName,
    required this.weight,
    required this.pickupDate,
    required this.pickupTime,
    required this.distanceKm,
    required this.pickupFee,
    required this.estimatedValue,
required this.netValue,
  });

  factory PickupHistory.fromJson(
    Map<String, dynamic> json,
  ) {
    return PickupHistory(
      id: json["id"],

      status: json["status"] ?? "-",

      wasteCategory:
          json["category"]?["nama_kategori"] ??
              "-",

      wasteBankName:
          json["waste_bank_name"] ?? "-",

      weight:
          (json["estimasi_berat"] ?? 0)
              .toDouble(),

      pickupDate:
          json["tanggal_pickup"] ?? "-",

      pickupTime:
          json["pickup_time"] ?? "-",

      distanceKm:
          (json["distance_km"] ?? 0)
              .toDouble(),

      pickupFee:
          json["ongkir"] ?? 0,
          estimatedValue:
    json["estimated_value"] ?? 0,

netValue:
    json["net_value"] ?? 0,
          
    );
  }
}