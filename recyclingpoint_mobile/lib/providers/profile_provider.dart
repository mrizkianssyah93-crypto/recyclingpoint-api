import 'dart:io';

import 'package:flutter/material.dart';

import '../models/profile.dart';
import '../services/profile_service.dart';

class ProfileProvider extends ChangeNotifier {
  final ProfileService _service = ProfileService();

  bool loading = false;

  UserProfile? profile;

  Future<void> loadProfile() async {
    loading = true;
    notifyListeners();

    profile = await _service.getProfile();

    loading = false;
    notifyListeners();
  }

  Future<bool> updateProfile({
    required String nama,
    required String username,
    required String email,
  }) async {
    final success = await _service.updateProfile(
      nama: nama,
      username: username,
      email: email,
    );

    if (success) {
      await loadProfile();
    }

    return success;
  }

  Future<bool> uploadPhoto(File file) async {
    final success = await _service.uploadPhoto(file);

    if (success) {
      await loadProfile();
    }

    return success;
  }
}