import 'package:dio/dio.dart';

import '../config/api.dart';
import '../models/pickup_history.dart';
import 'auth_service.dart';

class HistoryService {
  final Dio dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      headers: {
        "Accept": "application/json",
      },
    ),
  );

  Future<List<PickupHistory>> getHistory() async {
    final token = await AuthService().getToken();

    final response = await dio.get(
      "/history/pickups",
      options: Options(
        headers: {
          "Authorization": "Bearer $token",
        },
      ),
    );

    final List list = response.data["data"];

    return list
        .map(
          (e) => PickupHistory.fromJson(e),
        )
        .toList();
  }
}