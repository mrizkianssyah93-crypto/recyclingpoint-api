import 'dart:io';

import 'package:dio/dio.dart';

import '../config/api.dart';
import '../models/profile.dart';
import 'auth_service.dart';

class ProfileService {
  final Dio dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      headers: {
        "Accept": "application/json",
      },
    ),
  );

  Future<UserProfile> getProfile() async {
    final token = await AuthService().getToken();

    final response = await dio.get(
      "/profile",
      options: Options(
        headers: {
          "Authorization": "Bearer $token",
        },
      ),
    );

    return UserProfile.fromJson(
      response.data["data"],
    );
  }

  Future<bool> updateProfile({
    required String nama,
    required String username,
    required String email,
  }) async {
    try {
      final token = await AuthService().getToken();

      await dio.put(
        "/profile",
        data: {
          "nama": nama,
          "username": username,
          "email": email,
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

  Future<bool> uploadPhoto(File file) async {
    try {
      final token = await AuthService().getToken();

      final formData = FormData.fromMap({
        "photo": await MultipartFile.fromFile(
          file.path,
          filename: file.path.split('/').last,
        ),
      });

      await dio.post(
        "/profile/photo",
        data: formData,
        options: Options(
          headers: {
            "Authorization": "Bearer $token",
            "Accept": "application/json",
            "Content-Type": "multipart/form-data",
          },
        ),
      );

      return true;
    } catch (_) {
      return false;
    }
  }
}