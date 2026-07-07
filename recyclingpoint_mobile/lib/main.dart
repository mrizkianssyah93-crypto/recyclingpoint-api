import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'providers/auth_provider.dart';
import 'screens/splash/splash_page.dart';
import 'providers/history_provider.dart';
import 'providers/pickup_provider.dart';
import 'providers/voucher_provider.dart';
import 'providers/profile_provider.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();

  runApp(
    MultiProvider(
      providers: [
ChangeNotifierProvider(
  create: (_) => VoucherProvider(),
),
  ChangeNotifierProvider(
    create: (_) => AuthProvider(),
  ),

  ChangeNotifierProvider(
    create: (_) => PickupProvider(),
  ),

  ChangeNotifierProvider(
    create: (_) => HistoryProvider(),
  ),
  ChangeNotifierProvider(
  create: (_) => ProfileProvider(),
),

],
      child: const RecyclingPointApp(),
    ),
  );
}

class RecyclingPointApp extends StatelessWidget {
  const RecyclingPointApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Recycling Point',
      debugShowCheckedModeBanner: false,

      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: Colors.green,
        ),
        useMaterial3: true,
      ),

      home: const SplashPage(),
    );
  }
}