import 'dart:convert';

import 'package:http/http.dart' as http;

class GoogleMapService {
  static const String apiKey =
      "AIzaSyD03VCP_sP_ggbKR6Tb38EcWeiBXQoerqQ";

  /// ==========================================
  /// DISTANCE MATRIX
  /// ==========================================
  Future<double> getDistanceKm({
    required String origin,
    required String destination,
  }) async {
    final url = Uri.parse(
      "https://maps.googleapis.com/maps/api/distancematrix/json"
      "?origins=${Uri.encodeComponent(origin)}"
      "&destinations=${Uri.encodeComponent(destination)}"
      "&mode=driving"
      "&units=metric"
      "&key=$apiKey",
    );

    final response = await http.get(url);

    if (response.statusCode != 200) {
      throw Exception("Google Maps API Error");
    }

    final json = jsonDecode(response.body);

    if (json["status"] != "OK") {
      throw Exception(json["status"]);
    }

    final element =
        json["rows"][0]["elements"][0];

    if (element["status"] != "OK") {
      throw Exception(element["status"]);
    }

    final meter =
        element["distance"]["value"];

    return meter / 1000;
  }
/// ==========================================
/// GET ADDRESS FROM LAT LNG
/// ==========================================
Future<String> getAddress({
  required double latitude,
  required double longitude,
}) async {
  final url = Uri.parse(
    "https://maps.googleapis.com/maps/api/geocode/json"
    "?latlng=$latitude,$longitude"
    "&key=$apiKey",
  );

  final response = await http.get(url);

  if (response.statusCode != 200) {
    throw Exception("Google Geocoding API Error");
  }

  final json = jsonDecode(response.body);

  if (json["status"] != "OK") {
    throw Exception(json["status"]);
  }

  return json["results"][0]["formatted_address"];
}
  /// ==========================================
  /// PICKUP FEE
  /// WEBSITE LOGIC
  /// ==========================================
  int calculatePickupFee({
    required double distanceKm,
    required double weight,
  }) {
    if (weight <= 20) {
      return 0;
    }

    return (distanceKm * 3000).round();
  }

  /// ==========================================
  /// ESTIMATED VALUE
  /// ==========================================
  int calculateEstimatedValue({
    required double weight,
    required int pricePerKg,
  }) {
    return (weight * pricePerKg).round();
  }

  /// ==========================================
  /// NET VALUE
  /// ==========================================
  int calculateNetValue({
    required int estimatedValue,
    required int pickupFee,
  }) {
    return estimatedValue - pickupFee;
  }

  /// ==========================================
  /// FORMAT RUPIAH
  /// ==========================================
  String rupiah(int value) {
    final text = value.toString();

    final buffer = StringBuffer();

    int counter = 0;

    for (int i = text.length - 1; i >= 0; i--) {
      counter++;

      buffer.write(text[i]);

      if (counter % 3 == 0 &&
          i != 0) {
        buffer.write(".");
      }
    }

    return "Rp ${buffer.toString().split('').reversed.join()}";
  }
}