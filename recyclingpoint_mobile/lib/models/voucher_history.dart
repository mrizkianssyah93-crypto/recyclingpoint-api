class VoucherHistory {
  final int id;

  final String voucherName;

  final int point;

  final String status;

  final String redeemDate;

  VoucherHistory({
    required this.id,
    required this.voucherName,
    required this.point,
    required this.status,
    required this.redeemDate,
  });

 factory VoucherHistory.fromJson(
  Map<String, dynamic> json,
) {
  return VoucherHistory(
    id: json["id"],

    voucherName:
        json["voucher"]?["nama"] ??
        "-",

    point:
        json["poin_used"] ?? 0,

    status: "Redeemed",

    redeemDate:
        json["created_at"] ?? "-",
  );
}
}