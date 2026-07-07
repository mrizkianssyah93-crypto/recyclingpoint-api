import 'package:flutter/material.dart';

import '../models/user.dart';
import '../services/auth_service.dart';

class AuthProvider extends ChangeNotifier {
  final AuthService _authService = AuthService();

  UserModel? _user;

  bool _loading = false;

  UserModel? get user => _user;

  bool get loading => _loading;

  // ==========================
  // SET USER (Auto Login)
  // ==========================

  void setUser(UserModel user) {
    _user = user;
    notifyListeners();
  }

  // ==========================
  // LOGIN USERNAME
  // ==========================

  Future<bool> login(
    String username,
    String password,
  ) async {
    _loading = true;
    notifyListeners();

    final result = await _authService.login(
      username: username,
      password: password,
    );

    _loading = false;

    if (result["success"] == true) {
      _user = result["user"];
      notifyListeners();
      return true;
    }

    notifyListeners();
    return false;
  }

  // ==========================
  // LOGIN GOOGLE
  // ==========================

  Future<bool> loginWithGoogle() async {
    _loading = true;
    notifyListeners();

    final result = await _authService.loginWithGoogle();

    _loading = false;

    if (result["success"] == true) {
      _user = result["user"];
      notifyListeners();
      return true;
    }

    notifyListeners();
    return false;
  }

  // ==========================
  // LOGOUT
  // ==========================

  Future<void> logout() async {
    _loading = true;
    notifyListeners();

    await _authService.logout();

    _user = null;

    _loading = false;

    notifyListeners();
  }
}