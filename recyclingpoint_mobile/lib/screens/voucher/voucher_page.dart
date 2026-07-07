import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../providers/auth_provider.dart';
import '../../providers/voucher_provider.dart';

class VoucherPage extends StatefulWidget {
  const VoucherPage({super.key});

  @override
  State<VoucherPage> createState() => _VoucherPageState();
}

class _VoucherPageState extends State<VoucherPage> {
  @override
  void initState() {
    super.initState();

    Future.microtask(() {
      context.read<VoucherProvider>().loadData();
    });
  }

  Future<void> redeem(int voucherId) async {
    final success = await context
        .read<VoucherProvider>()
        .redeemVoucher(voucherId);

    if (!mounted) return;

    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        backgroundColor:
            success ? Colors.green : Colors.red,
        content: Text(
          success
              ? "Voucher berhasil ditukarkan"
              : "Redeem gagal",
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthProvider>();
    final provider =
        context.watch<VoucherProvider>();

    return Scaffold(
      appBar: AppBar(
        title: const Text("Voucher"),
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,
      ),

      body: provider.loading
          ? const Center(
              child:
                  CircularProgressIndicator(),
            )
          : RefreshIndicator(
              onRefresh: provider.refresh,
              child: ListView(
                padding:
                    const EdgeInsets.all(20),

                children: [

                  Container(
                    padding:
                        const EdgeInsets.all(20),

                    decoration: BoxDecoration(
                      color: Colors.green,
                      borderRadius:
                          BorderRadius.circular(
                        20,
                      ),
                    ),

                    child: Column(
                      crossAxisAlignment:
                          CrossAxisAlignment
                              .start,

                      children: [

                        const Text(
                          "My Points",
                          style: TextStyle(
                            color:
                                Colors.white70,
                          ),
                        ),

                        const SizedBox(
                          height: 8,
                        ),

                        Text(
                          "${auth.user?.poin ?? 0}",
                          style:
                              const TextStyle(
                            color:
                                Colors.white,
                            fontSize: 38,
                            fontWeight:
                                FontWeight.bold,
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(
                    height: 30,
                  ),

                  const Text(
                    "Available Voucher",
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),

                  const SizedBox(
                    height: 15,
                  ),

                  ...provider.vouchers
                      .map(
                        (voucher) => Card(
                          margin:
                              const EdgeInsets.only(
                            bottom: 15,
                          ),

                          child: Padding(
                            padding:
                                const EdgeInsets.all(
                              16,
                            ),

                            child: Column(
                              crossAxisAlignment:
                                  CrossAxisAlignment
                                      .start,

                              children: [

                                Text(
                                  voucher.nama,
                                  style:
                                      const TextStyle(
                                    fontWeight:
                                        FontWeight
                                            .bold,
                                    fontSize: 17,
                                  ),
                                ),

                                const SizedBox(
                                  height: 5,
                                ),

                                Text(
                                  voucher.deskripsi,
                                ),

                                const SizedBox(
                                  height: 10,
                                ),

                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment
                                          .spaceBetween,

                                  children: [

                                    Text(
                                      "${voucher.point} Point",
                                      style:
                                          const TextStyle(
                                        color: Colors
                                            .green,
                                        fontWeight:
                                            FontWeight
                                                .bold,
                                      ),
                                    ),

                                    ElevatedButton(
                                      onPressed:
                                          () => redeem(
                                        voucher.id,
                                      ),

                                      style:
                                          ElevatedButton
                                              .styleFrom(
                                        backgroundColor:
                                            Colors.green,
                                        foregroundColor:
                                            Colors.white,
                                      ),

                                      child:
                                          const Text(
                                        "Redeem",
                                      ),
                                    ),
                                  ],
                                ),
                              ],
                            ),
                          ),
                        ),
                      ),

                  const SizedBox(
                    height: 20,
                  ),

                  const Text(
                    "Redeem History",
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),

                  const SizedBox(
                    height: 15,
                  ),

                  if (provider.history.isEmpty)

                    const Card(
                      child: Padding(
                        padding:
                            EdgeInsets.all(18),
                        child: Text(
                          "Belum ada riwayat redeem.",
                        ),
                      ),
                    ),

                  ...provider.history.map(
                    (history) => Card(
                      margin:
                          const EdgeInsets.only(
                        bottom: 12,
                      ),

                      child: ListTile(
                        leading:
                            const CircleAvatar(
                          backgroundColor:
                              Color(
                            0xffE8F5E9,
                          ),

                          child: Icon(
                            Icons.card_giftcard,
                            color: Colors.green,
                          ),
                        ),

                        title: Text(
                          history.voucherName,
                        ),

                        subtitle: Text(
                          history.redeemDate,
                        ),

                        trailing: Column(
                          mainAxisAlignment:
                              MainAxisAlignment
                                  .center,

                          children: [

                            Text(
                              "-${history.point}",
                              style:
                                  const TextStyle(
                                color:
                                    Colors.red,
                                fontWeight:
                                    FontWeight
                                        .bold,
                              ),
                            ),

                            const SizedBox(
                              height: 4,
                            ),

                            Container(
                              padding:
                                  const EdgeInsets.symmetric(
                                horizontal: 8,
                                vertical: 3,
                              ),

                              decoration:
                                  BoxDecoration(
                                color: Colors
                                    .green
                                    .shade100,

                                borderRadius:
                                    BorderRadius
                                        .circular(
                                  20,
                                ),
                              ),

                              child: Text(
                                history.status,
                                style:
                                    const TextStyle(
                                  color: Colors
                                      .green,
                                  fontSize: 11,
                                  fontWeight:
                                      FontWeight
                                          .bold,
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),

                  const SizedBox(
                    height: 30,
                  ),
                ],
              ),
            ),
    );
  }
}