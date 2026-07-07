class WasteCategory {
  final int id;
  final String namaKategori;
  final String mainCategory;
  final int poinPerKg;
  final int hargaPerKg;

  WasteCategory({
    required this.id,
    required this.namaKategori,
    required this.mainCategory,
    required this.poinPerKg,
    required this.hargaPerKg,
  });

  factory WasteCategory.fromJson(Map<String, dynamic> json) {
    return WasteCategory(
      id: json["id"],
      namaKategori: json["nama_kategori"] ?? "",
      mainCategory: json["main_category"] ?? "",
      poinPerKg: json["poin_per_kg"] ?? 0,
      hargaPerKg: json["harga_per_kg"] ?? 0,
    );
  }
}