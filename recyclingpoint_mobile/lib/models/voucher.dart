class Voucher {
  final int id;

  final String nama;

  final String deskripsi;

  final int point;

  final int stok;

  final String gambar;

  Voucher({
    required this.id,
    required this.nama,
    required this.deskripsi,
    required this.point,
    required this.stok,
    required this.gambar,
  });

  factory Voucher.fromJson(
    Map<String, dynamic> json,
 ) {
  return Voucher(
    id: json["id"],

    nama: json["nama"] ?? "",

    deskripsi:
        json["deskripsi"] ?? "",

    point:
        json["poin"] ?? 0,

    stok:
        json["stok"] ?? 0,

    gambar:
        json["gambar"] ?? "",
  );
}
}