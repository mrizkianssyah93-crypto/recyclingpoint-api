import 'package:flutter/material.dart';

import '../models/pickup_history.dart';
import '../services/history_service.dart';

class HistoryProvider extends ChangeNotifier {
  final HistoryService _service = HistoryService();

  bool _loading = false;

  List<PickupHistory> _history = [];

  bool get loading => _loading;

  List<PickupHistory> get history => _history;

  Future<void> loadHistory() async {
    _loading = true;
    notifyListeners();

    try {
      _history = await _service.getHistory();
    } catch (e) {
      debugPrint(e.toString());
    }

    _loading = false;
    notifyListeners();
  }

  Future<void> refresh() async {
    await loadHistory();
  }
}