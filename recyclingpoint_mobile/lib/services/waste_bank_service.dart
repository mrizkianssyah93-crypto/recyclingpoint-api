import 'package:dio/dio.dart';

import '../config/api.dart';
import '../models/waste_bank.dart';

class WasteBankService {
  final Dio dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      headers: const {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
    ),
  );

  Future<List<WasteBank>> getWasteBanks({
    required String token,
  }) async {
    try {
      final response = await dio.get(
        "/waste-banks",
        options: Options(
          headers: {
            "Authorization": "Bearer $token",
          },
        ),
      );

      final List data = response.data["data"];

      return data
          .map(
            (e) => WasteBank.fromJson(e),
          )
          .toList();
    } on DioException catch (e) {
      print("========== WASTE BANK ERROR ==========");
      print(e.response?.statusCode);
      print(e.response?.data);
      print("======================================");

      rethrow;
    } catch (e) {
      print(e);
      rethrow;
    }
  }
}