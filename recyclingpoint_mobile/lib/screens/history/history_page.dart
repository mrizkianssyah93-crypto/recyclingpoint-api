import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../providers/history_provider.dart';
import 'package:intl/intl.dart';

class HistoryPage extends StatefulWidget {
  const HistoryPage({super.key});

  @override
  State<HistoryPage> createState() => _HistoryPageState();
}

class _HistoryPageState extends State<HistoryPage> {
  @override
    final NumberFormat rupiahFormatter =
      NumberFormat('#,##0', 'id_ID');
  @override
  void initState() {
    super.initState();

    Future.microtask(() {
      context.read<HistoryProvider>().loadHistory();
    });
  }

  @override
  Widget build(BuildContext context) {
    final provider = context.watch<HistoryProvider>();

    return Scaffold(
      appBar: AppBar(
        title: const Text("Pickup History"),
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,
      ),

      body: provider.loading
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : RefreshIndicator(
              onRefresh: provider.refresh,
              child: provider.history.isEmpty
                  ? ListView(
                      children: const [

                        SizedBox(height: 180),

                        Icon(
                          Icons.history,
                          size: 80,
                          color: Colors.grey,
                        ),

                        SizedBox(height: 20),

                        Center(
                          child: Text(
                            "Belum ada riwayat pickup",
                            style: TextStyle(
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                      ],
                    )
                  : ListView.builder(
                      padding: const EdgeInsets.all(16),
                      itemCount: provider.history.length,
                      itemBuilder: (context, index) {
                        final item =
                            provider.history[index];

                        return Card(
                          margin:
                              const EdgeInsets.only(
                            bottom: 15,
                          ),

                          child: ListTile(
                            leading: CircleAvatar(
                              backgroundColor:
                                  Colors.green.shade100,
                              child: const Icon(
                                Icons.recycling,
                                color: Colors.green,
                              ),
                            ),

                            title: Text(
  item.wasteBankName,
  style: const TextStyle(
    fontWeight: FontWeight.bold,
    fontSize: 16,
  ),
),

subtitle: Column(
  crossAxisAlignment: CrossAxisAlignment.start,
  children: [

    const SizedBox(height: 8),

    Text(
      "Kategori : ${item.wasteCategory}",
    ),

    Text(
      "Berat : ${item.weight} KG",
    ),

    Text(
      "Tanggal : ${item.pickupDate}",
    ),
    Text(
  "Jam Pickup : ${item.pickupTime}",
),

Text(
  "Jarak Pickup : ${item.distanceKm.toStringAsFixed(2)} KM",
),

Text(
  "Pickup Fee : Rp ${rupiahFormatter.format(item.pickupFee)}",
),
Text(
  "Estimated Value : Rp ${rupiahFormatter.format(item.estimatedValue)}",
),

Text(
  "Net Value : Rp ${rupiahFormatter.format(item.netValue)}",
  style: const TextStyle(
    color: Colors.green,
    fontWeight: FontWeight.bold,
  ),
),

const SizedBox(height: 8),

Chip(
  backgroundColor:
      item.status == "completed"
          ? Colors.green.shade100
          : item.status == "process"
              ? Colors.orange.shade100
              : Colors.grey.shade300,

  label: Text(
    item.status.toUpperCase(),
    style: TextStyle(
      color:
          item.status == "completed"
              ? Colors.green
              : item.status == "process"
                  ? Colors.orange
                  : Colors.black87,
      fontWeight: FontWeight.bold,
    ),
  ),
),
                              ],
                            ),
                          ),
                        );
                      },
                    ),
            ),
    );
  }
}