import 'package:dio/dio.dart';

import '../config/api.dart';
import '../models/voucher.dart';
import '../models/voucher_history.dart';
import 'auth_service.dart';

class VoucherService {
  final Dio dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      headers: {
        "Accept": "application/json",
      },
    ),
  );

  /// ==========================================
  /// GET VOUCHERS
  /// ==========================================
  Future<List<Voucher>> getVouchers() async {
    final token = await AuthService().getToken();

    final response = await dio.get(
      "/vouchers",
      options: Options(
        headers: {
          "Authorization": "Bearer $token",
        },
      ),
    );

    final List list = response.data["data"];

    return list
        .map((e) => Voucher.fromJson(e))
        .toList();
  }

  /// ==========================================
  /// GET HISTORY
  /// ==========================================
  Future<List<VoucherHistory>> getHistory() async {
    final token = await AuthService().getToken();

    final response = await dio.get(
      "/vouchers/history",
      options: Options(
        headers: {
          "Authorization": "Bearer $token",
        },
      ),
    );

    final List list = response.data["data"];

    return list
        .map((e) => VoucherHistory.fromJson(e))
        .toList();
  }

  /// ==========================================
  /// REDEEM VOUCHER
  /// ==========================================
  Future<bool> redeemVoucher({
    required int voucherId,
  }) async {
    try {
      final token = await AuthService().getToken();

      await dio.post(
        "/vouchers/redeem",
        data: {
          "voucher_id": voucherId,
        },
        options: Options(
          headers: {
            "Authorization": "Bearer $token",
          },
        ),
      );

      return true;
    } catch (_) {
      return false;
    }
  }
}