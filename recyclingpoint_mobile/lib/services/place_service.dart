import 'dart:convert';

import 'package:http/http.dart' as http;

class PlaceService {
  static const apiKey =
      "AIzaSyD03VCP_sP_ggbKR6Tb38EcWeiBXQoerqQ";

  Future<List<dynamic>> search(
    String keyword,
  ) async {
    if (keyword.isEmpty) {
      return [];
    }

    final url = Uri.parse(
      "https://maps.googleapis.com/maps/api/place/autocomplete/json"
      "?input=${Uri.encodeComponent(keyword)}"
      "&components=country:id"
      "&key=$apiKey",
    );

    final response = await http.get(url);

    final json = jsonDecode(response.body);

    if (json["status"] != "OK" &&
        json["status"] != "ZERO_RESULTS") {
      throw Exception(json["status"]);
    }

    return json["predictions"];
  }
    Future<Map<String, dynamic>> getDetail(
    String placeId,
  ) async {
    final url = Uri.parse(
      "https://maps.googleapis.com/maps/api/place/details/json"
      "?place_id=$placeId"
      "&fields=formatted_address,geometry"
      "&key=$apiKey",
    );

    final response = await http.get(url);

    final json = jsonDecode(response.body);

    if (json["status"] != "OK") {
      throw Exception(json["status"]);
    }

    final result = json["result"];

    return {
      "address": result["formatted_address"],
      "latitude":
          result["geometry"]["location"]["lat"],
      "longitude":
          result["geometry"]["location"]["lng"],
    };
  }
}