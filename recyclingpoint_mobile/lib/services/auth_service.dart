import 'package:dio/dio.dart';
import 'package:google_sign_in/google_sign_in.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../config/api.dart';
import '../models/user.dart';


class AuthService {
  final Dio dio = Dio(
    BaseOptions(
      baseUrl: ApiConfig.baseUrl,
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
    ),
  );

final GoogleSignIn googleSignIn = GoogleSignIn(
  scopes: const [
    'email',
  ],
  serverClientId:
      '32537794239-bh52tsgg1skkfghepisem4uf6m7kmkrp.apps.googleusercontent.com',
);

  /// ==========================
  /// LOGIN USERNAME
  /// ==========================
  Future<Map<String, dynamic>> login({
    required String username,
    required String password,
  }) async {
    try {
      final response = await dio.post(
        "/login",
        data: {
          "username": username,
          "password": password,
        },
      );

      final data = response.data["data"];

      final prefs = await SharedPreferences.getInstance();

      await prefs.setString(
        "token",
        data["token"],
      );

      return {
        "success": true,
        "user": UserModel.fromJson(
          data["user"],
        ),
      };
    } on DioException catch (e) {
      print("LOGIN ERROR");
      print(e.response?.statusCode);
      print(e.response?.data);

      return {
        "success": false,
        "message":
            e.response?.data["message"] ??
                "Username atau Password salah",
      };
    } catch (e) {
      print(e);

      return {
        "success": false,
        "message": e.toString(),
      };
    }
  }

  /// ==========================
  /// LOGIN GOOGLE
  /// ==========================
  Future<Map<String, dynamic>> loginWithGoogle() async {
  try {
    print("STEP 1");

    await googleSignIn.signOut();

    print("STEP 2");

    final GoogleSignInAccount? account =
        await googleSignIn.signIn();

    print("STEP 3");
    print(account);

    if (account == null) {
      print("ACCOUNT NULL");

      return {
        "success": false,
        "message": "Login dibatalkan",
      };
    }

    final GoogleSignInAuthentication auth =
        await account.authentication;

    print("STEP 4");
    print(auth.idToken);

    final String? idToken = auth.idToken;

    if (idToken == null) {
      print("ID TOKEN NULL");

      return {
        "success": false,
        "message": "ID Token tidak ditemukan",
      };
    }

    print("STEP 5");

    final response = await dio.post(
      "/google-login",
      data: {
        "id_token": idToken,
      },
    );

    print("STEP 6");
    print(response.data);

    final data = response.data["data"];

    final prefs = await SharedPreferences.getInstance();

    await prefs.setString(
      "token",
      data["token"],
    );

    return {
      "success": true,
      "user": UserModel.fromJson(
        data["user"],
      ),
    };
  } on DioException catch (e) {
    print("========== GOOGLE LOGIN ERROR ==========");
    print("STATUS : ${e.response?.statusCode}");
    print("DATA   : ${e.response?.data}");
    print("ERROR  : ${e.message}");
    print("========================================");

    return {
      "success": false,
      "message": e.response?.data["message"] ??
          "Google Login gagal",
    };
  } catch (e, s) {
    print("========== GOOGLE LOGIN EXCEPTION ==========");
    print(e);
    print(s);
    print("============================================");

    return {
      "success": false,
      "message": e.toString(),
    };
  }
}
/// ==========================
/// GET PROFILE (AUTO LOGIN)
/// ==========================
Future<UserModel> getProfile() async {
  final token = await getToken();

  final response = await dio.get(
    "/profile",
    options: Options(
      headers: {
        "Authorization": "Bearer $token",
      },
    ),
  );

  return UserModel.fromJson(
    response.data["data"],
  );
}
  /// ==========================
  /// GET TOKEN
  /// ==========================
  Future<String?> getToken() async {
    final prefs = await SharedPreferences.getInstance();

    return prefs.getString("token");
  }

  /// ==========================
  /// LOGOUT
  /// ==========================
  Future<void> logout() async {
    try {
      final token = await getToken();

      if (token != null) {
        await dio.post(
          "/logout",
          options: Options(
            headers: {
              "Authorization": "Bearer $token",
            },
          ),
        );
      }
    } catch (e) {
      print("LOGOUT ERROR");
      print(e);
    }

    try {
      await googleSignIn.signOut();
    } catch (_) {}

    final prefs = await SharedPreferences.getInstance();

    await prefs.remove("token");
  }
}