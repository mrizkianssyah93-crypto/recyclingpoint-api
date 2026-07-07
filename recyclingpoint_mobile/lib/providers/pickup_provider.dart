import 'package:flutter/material.dart';

import '../models/waste_bank.dart';
import '../models/waste_category.dart';
import '../services/auth_service.dart';
import '../services/pickup_service.dart';
import '../services/waste_bank_service.dart';

class PickupProvider extends ChangeNotifier {
  final PickupService _pickupService = PickupService();

  final WasteBankService _wasteBankService =
      WasteBankService();

  final AuthService _authService =
      AuthService();

  bool _loading = false;

  bool get loading => _loading;

  List<WasteCategory> _categories = [];

  List<WasteCategory> get categories =>
      _categories;

  List<WasteBank> _wasteBanks = [];

  List<WasteBank> get wasteBanks =>
      _wasteBanks;

  /// ==========================
  /// LOAD DATA
  /// ==========================
  Future<void> loadData() async {
    _loading = true;
    notifyListeners();

    try {
      final token =
          await _authService.getToken();

      if (token == null) {
        throw Exception("Token tidak ditemukan");
      }

      _categories =
          await _pickupService.getCategories(
        token,
      );

      _wasteBanks =
          await _wasteBankService.getWasteBanks(
        token: token,
      );
    } catch (e) {
      print(e);
    }

    _loading = false;
    notifyListeners();
  }

  /// ==========================
  /// CREATE PICKUP
  /// ==========================
  Future<bool> createPickup({
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
      final token =
          await _authService.getToken();

      if (token == null) {
        return false;
      }

      return await _pickupService.createPickup(
        token: token,
        categoryId: categoryId,
        wasteBank: wasteBank,
        alamat: alamat,
        noHp: noHp,
        tanggal: tanggal,
        jam: jam,
        berat: berat,
        distance: distance,
      );
    } catch (e) {
      print(e);
      return false;
    }
  }
}