import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../providers/auth_provider.dart';

import '../auth/login_page.dart';
import '../voucher/voucher_page.dart';

class HomePage extends StatelessWidget {
  HomePage({super.key});

  final List<Map<String, String>> news = [
    {
      "title": "Cara Memilah Sampah Plastik dengan Benar",
      "image":
          "https://images.unsplash.com/photo-1532996122724-e3c354a0b15b",
    },
    {
      "title": "Bank Sampah Membantu Mengurangi Limbah Rumah Tangga",
      "image":
          "https://images.unsplash.com/photo-1528323273322-d81458248d40",
    },
    {
      "title": "Daur Ulang Kertas untuk Masa Depan yang Lebih Hijau",
      "image":
          "https://images.unsplash.com/photo-1517048676732-d65bc937f952",
    },
  ];

  final List<String> tips = [
    "Pisahkan plastik berdasarkan jenisnya sebelum disetor.",
    "Bersihkan botol dan kaleng agar nilai jual lebih tinggi.",
    "Lipat kardus agar lebih hemat tempat saat penyimpanan.",
  ];

  Future<void> logout(BuildContext context) async {
    final auth = context.read<AuthProvider>();

    await auth.logout();

    if (!context.mounted) return;

    Navigator.pushAndRemoveUntil(
      context,
      MaterialPageRoute(
        builder: (_) => const LoginPage(),
      ),
      (route) => false,
    );
  }

  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthProvider>();

    return Scaffold(
      backgroundColor: const Color(0xffF5F7F6),

      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,

        title: const Text(
          "Recycling Point",
          style: TextStyle(
            fontWeight: FontWeight.bold,
          ),
        ),

        actions: [

          IconButton(
            onPressed: () => logout(context),
            icon: const Icon(Icons.logout),
          ),

        ],
      ),

      body: SingleChildScrollView(

        padding: const EdgeInsets.all(20),

        child: Column(

          crossAxisAlignment:
              CrossAxisAlignment.start,

          children: [
            Text(
  "Halo, ${auth.user?.nama ?? '-'} 👋",
  style: const TextStyle(
    fontSize: 28,
    fontWeight: FontWeight.bold,
  ),
),

const SizedBox(height: 6),

Text(
  auth.user?.username ?? "",
  style: const TextStyle(
    color: Colors.grey,
    fontSize: 15,
  ),
),

const SizedBox(height: 25),

Container(
  width: double.infinity,
  padding: const EdgeInsets.all(22),

  decoration: BoxDecoration(
    color: Colors.green,
    borderRadius: BorderRadius.circular(24),
    boxShadow: [
      BoxShadow(
        color: Colors.green.withValues(alpha: .25),
        blurRadius: 18,
        offset: const Offset(0, 8),
      ),
    ],
  ),

  child: Row(
    crossAxisAlignment: CrossAxisAlignment.start,
    mainAxisAlignment:
        MainAxisAlignment.spaceBetween,

    children: [

      Expanded(
        child: Column(
          crossAxisAlignment:
              CrossAxisAlignment.start,

          children: [

            const Text(
              "Total Point",
              style: TextStyle(
                color: Colors.white70,
                fontSize: 15,
              ),
            ),

            const SizedBox(height: 10),

            Text(
              "${auth.user?.poin ?? 0}",
              style: const TextStyle(
                color: Colors.white,
                fontSize: 42,
                fontWeight: FontWeight.bold,
              ),
            ),

            const SizedBox(height: 6),

            const Text(
              "Kumpulkan lebih banyak poin\nuntuk ditukar menjadi voucher.",
              style: TextStyle(
                color: Colors.white70,
                height: 1.4,
              ),
            ),
          ],
        ),
      ),

      const SizedBox(width: 20),

      ElevatedButton.icon(
        onPressed: () {

          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (_) =>
                  const VoucherPage(),
            ),
          );

        },

        icon: const Icon(
          Icons.card_giftcard,
        ),

        label: const Text(
          "Voucher",
        ),

        style: ElevatedButton.styleFrom(
          backgroundColor: Colors.white,
          foregroundColor: Colors.green,
          elevation: 0,
          padding:
              const EdgeInsets.symmetric(
            horizontal: 18,
            vertical: 14,
          ),
          shape: RoundedRectangleBorder(
            borderRadius:
                BorderRadius.circular(16),
          ),
        ),
      ),
    ],
  ),
),

const SizedBox(height: 35),
const Text(
  "Recycling News",
  style: TextStyle(
    fontSize: 20,
    fontWeight: FontWeight.bold,
  ),
),

const SizedBox(height: 15),

SizedBox(
  height: 270,

  child: ListView.builder(

    scrollDirection: Axis.horizontal,

    itemCount: news.length,

    itemBuilder: (context, index) {

      final item = news[index];

return InkWell(
  borderRadius: BorderRadius.circular(22),
  onTap: () {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(item["title"]!),
      ),
    );
  },
  child: Container(
    width: 260,
    margin: const EdgeInsets.only(right: 18),
    decoration: BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(22),
      boxShadow: const [
        BoxShadow(
          color: Colors.black12,
          blurRadius: 10,
        ),
      ],
    ),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        ClipRRect(
          borderRadius: const BorderRadius.vertical(
            top: Radius.circular(22),
          ),
          child: Image.network(
            item["image"]!,
            width: double.infinity,
            height: 130,
            fit: BoxFit.cover,
          ),
        ),
   Expanded(
  child: Padding(
    padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                item["title"]!,
                maxLines: 2,
                overflow: TextOverflow.ellipsis,
                style: const TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 16,
                ),
              ),
              const SizedBox(height: 10),
              Row(
                children: const [
                  Text(
                    "Read More",
                    style: TextStyle(
                      color: Colors.green,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(width: 6),
                  Icon(
                    Icons.arrow_forward_ios,
                    color: Colors.green,
                    size: 14,
                  ),
                ],
              ),
            ],
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

const SizedBox(height: 35),
const Text(
  "Recycling Tips",
  style: TextStyle(
    fontSize: 20,
    fontWeight: FontWeight.bold,
  ),
),

const SizedBox(height: 15),

ListView.separated(
  shrinkWrap: true,
  physics: const NeverScrollableScrollPhysics(),

  itemCount: tips.length,

  separatorBuilder: (_, _) =>
      const SizedBox(height: 12),

  itemBuilder: (context, index) {

    return Container(

      padding: const EdgeInsets.all(16),

      decoration: BoxDecoration(

        color: Colors.green.shade50,

        borderRadius:
            BorderRadius.circular(18),

        boxShadow: const [

          BoxShadow(
            color: Colors.black12,
            blurRadius: 8,
          ),

        ],
      ),

      child: Row(

        crossAxisAlignment:
            CrossAxisAlignment.start,

        children: [

          Container(

            padding: const EdgeInsets.all(10),

            decoration: BoxDecoration(

              color: Colors.green.shade100,

              shape: BoxShape.circle,

            ),

child: const Icon(
  Icons.eco,
  color: Colors.green,
),
          ),

          const SizedBox(width: 15),

          Expanded(

            child: Text(

              tips[index],

              style: const TextStyle(
                fontSize: 15,
                height: 1.5,
              ),
            ),
          ),

        ],
      ),
    );
  },
),

const SizedBox(height: 35),
const SizedBox(
  height: 40,
),
          ],
        ),
      ),
    );
  }
}