import 'package:flutter/material.dart';

import '../../services/place_service.dart';

class PlaceSearchPage extends StatefulWidget {
  const PlaceSearchPage({super.key});

  @override
  State<PlaceSearchPage> createState() =>
      _PlaceSearchPageState();
}

class _PlaceSearchPageState
    extends State<PlaceSearchPage> {

  final service = PlaceService();

  final controller =
      TextEditingController();

  List<dynamic> predictions = [];

  bool loading = false;

  Future<void> search(
    String keyword,
  ) async {

    setState(() {
      loading = true;
    });

    predictions =
        await service.search(keyword);

    if (!mounted) return;

    setState(() {
      loading = false;
    });
  }
    @override
  Widget build(BuildContext context) {
    return Scaffold(

      appBar: AppBar(
        title: const Text(
          "Cari Alamat",
        ),
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,
      ),

      body: Column(
        children: [

          Padding(
            padding:
                const EdgeInsets.all(16),

            child: TextField(
              controller: controller,

              decoration:
                  const InputDecoration(
                hintText:
                    "Cari alamat...",
                prefixIcon:
                    Icon(Icons.search),
                border:
                    OutlineInputBorder(),
              ),

              onChanged: search,
            ),
          ),

          if (loading)
            const LinearProgressIndicator(),

          Expanded(
            child: ListView.builder(
              itemCount:
                  predictions.length,
              itemBuilder:
                  (context, index) {

                final item =
                    predictions[index];

                return ListTile(

                  leading: const Icon(
                    Icons.location_on,
                  ),

                  title: Text(
                    item["structured_formatting"]
                        ["main_text"],
                  ),

                  subtitle: Text(
                    item["description"],
                  ),
                                    onTap: () async {

                    final detail =
                        await service.getDetail(
                      item["place_id"],
                    );

                    if (!mounted) return;

                    Navigator.pop(
                      context,
                      detail,
                    );
                  },
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}