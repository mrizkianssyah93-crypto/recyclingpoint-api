import 'package:dio/dio.dart';

import '../config/api.dart';
import '../models/waste_category.dart';

class PickupService {
  final Dio dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      headers: {
        "Accept": "application/json",
      },
    ),
  );

Future<List<WasteCategory>> getCategories(
  String token,
) async {
  final response = await dio.get(
    "/waste-categories",
    options: Options(
      headers: {
        "Authorization": "Bearer $token",
      },
    ),
  );

  final List data = response.data["data"];

  return data
      .map((e) => WasteCategory.fromJson(e))
      .toList();
}

 Future<bool> createPickup({
  required String token,
  required int categoryId,
  required String wasteBank,
  required String alamat,
  required String noHp,
  required String tanggal,
  required String jam,
  required double berat,
  required double distance,
}) async {
  try {
    await dio.post(
      "/pickups",
      data: {
        "waste_category_id": categoryId,
        "waste_bank_name": wasteBank,
        "alamat_lengkap": alamat,
        "nomor_hp": noHp,
        "tanggal_pickup": tanggal,
        "pickup_time": jam,
        "estimasi_berat": berat,
        "distance_km": distance,
      },
      options: Options(
        headers: {
          "Authorization": "Bearer $token",
        },
      ),
    );

    return true;
  } on DioException catch (e) {
    print(e.response?.data);
    return false;
  } catch (e) {
    print(e);
    return false;
  }
}
}