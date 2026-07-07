import 'package:flutter/material.dart';

import '../models/voucher.dart';
import '../models/voucher_history.dart';
import '../services/voucher_service.dart';

class VoucherProvider extends ChangeNotifier {
  final VoucherService _service =
      VoucherService();

  bool loading = false;

  List<Voucher> vouchers = [];

  List<VoucherHistory> history = [];

  Future<void> loadData() async {
    loading = true;
    notifyListeners();

    vouchers =
        await _service.getVouchers();

    history =
        await _service.getHistory();

    loading = false;
    notifyListeners();
  }

  Future<bool> redeemVoucher(
      int voucherId) async {
    final success =
        await _service.redeemVoucher(
      voucherId: voucherId,
    );

    if (success) {
      await loadData();
    }

    return success;
  }

  Future<void> refresh() async {
    await loadData();
  }
}