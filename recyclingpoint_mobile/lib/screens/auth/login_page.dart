import '../home/home_page.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../providers/auth_provider.dart';
import '../navigation/navigation_page.dart';


class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final TextEditingController usernameController =
      TextEditingController();

  final TextEditingController passwordController =
      TextEditingController();

  bool rememberMe = false;

  bool hidePassword = true;

  @override
  void dispose() {
    usernameController.dispose();
    passwordController.dispose();
    super.dispose();
  }

  Future<void> login() async {
    final auth = context.read<AuthProvider>();

    final success = await auth.login(
      usernameController.text.trim(),
      passwordController.text.trim(),
    );

    if (!mounted) return;

    if (success) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (_) => HomePage(),
        ),
      );
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          backgroundColor: Colors.red,
          content: Text(
            "Username atau Password salah",
          ),
        ),
      );
    }
  }

Future<void> googleLogin() async {
  print("BUTTON GOOGLE DIKLIK");

  final auth = context.read<AuthProvider>();

  final success = await auth.loginWithGoogle();

  print("HASIL = $success");

  if (!mounted) return;

  if (success) {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(
        builder: (_) => const NavigationPage(),
      ),
    );
  } else {
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        backgroundColor: Colors.red,
        content: Text(
          "Google Login gagal",
        ),
      ),
    );
  }
}
  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthProvider>();

    return Scaffold(
      backgroundColor: const Color(0xffF2F8F4),

      body: SafeArea(
        child: Stack(
          children: [

            Positioned(
              top: -150,
              left: -120,
              child: Container(
                width: 320,
                height: 320,
                decoration: const BoxDecoration(
                  color: Color(0xffA5D6A7),
                  shape: BoxShape.circle,
                ),
              ),
            ),

            Positioned(
              bottom: -160,
              right: -140,
              child: Container(
                width: 340,
                height: 340,
                decoration: const BoxDecoration(
                  color: Color(0xff81C784),
                  shape: BoxShape.circle,
                ),
              ),
            ),

            Center(
              child: SingleChildScrollView(
                padding: const EdgeInsets.symmetric(
                  horizontal: 24,
                  vertical: 20,
                ),

                child: Container(
                  padding: const EdgeInsets.all(28),

                  decoration: BoxDecoration(
                    color: Colors.white.withValues(
                      alpha: .95,
                    ),

                    borderRadius:
                        BorderRadius.circular(30),

                    boxShadow: const [
                      BoxShadow(
                        color: Colors.black12,
                        blurRadius: 30,
                        offset: Offset(0, 12),
                      ),
                    ],
                  ),

                  child: Column(
                    children: [

                      const Icon(
                        Icons.recycling,
                        color: Colors.green,
                        size: 90,
                      ),

                      const SizedBox(height: 18),

                      const Text(
                        "Recycling Point",
                        style: TextStyle(
                          fontSize: 30,
                          fontWeight: FontWeight.bold,
                        ),
                      ),

                      const SizedBox(height: 8),

                      const Text(
                        "Welcome Back",
                        style: TextStyle(
                          color: Colors.grey,
                          fontSize: 16,
                        ),
                      ),

                      const SizedBox(height: 35),

                      TextField(
                        controller: usernameController,

                        decoration: InputDecoration(
                          hintText: "Username",

                          prefixIcon:
                              const Icon(Icons.person),

                          filled: true,

                          fillColor:
                              const Color(0xffF6F6F6),

                          border:
                              OutlineInputBorder(
                            borderRadius:
                                BorderRadius.circular(
                                    18),

                            borderSide:
                                BorderSide.none,
                          ),
                        ),
                      ),

                      const SizedBox(height: 20),

                      TextField(
                        controller: passwordController,

                        obscureText: hidePassword,

                        decoration: InputDecoration(
                          hintText: "Password",

                          prefixIcon:
                              const Icon(Icons.lock),

                          suffixIcon: IconButton(
                            onPressed: () {
                              setState(() {
                                hidePassword =
                                    !hidePassword;
                              });
                            },

                            icon: Icon(
                              hidePassword
                                  ? Icons.visibility
                                  : Icons.visibility_off,
                            ),
                          ),

                          filled: true,

                          fillColor:
                              const Color(0xffF6F6F6),

                          border:
                              OutlineInputBorder(
                            borderRadius:
                                BorderRadius.circular(
                                    18),

                            borderSide:
                                BorderSide.none,
                          ),
                        ),
                      ),
					                        const SizedBox(height: 18),

                      Row(
                        children: [

                          Checkbox(
                            value: rememberMe,
                            activeColor: Colors.green,
                            onChanged: (value) {
                              setState(() {
                                rememberMe = value ?? false;
                              });
                            },
                          ),

                          const Text(
                            "Remember Me",
                            style: TextStyle(
                              fontSize: 14,
                            ),
                          ),

                          const Spacer(),

                          TextButton(
                            onPressed: () {

                            },

                            child: const Text(
                              "Forgot Password?",
                              style: TextStyle(
                                color: Colors.green,
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                          ),

                        ],
                      ),

                      const SizedBox(height: 18),

                      SizedBox(
                        width: double.infinity,
                        height: 56,

                        child: ElevatedButton(
                          onPressed: auth.loading
                              ? null
                              : login,

                          style: ElevatedButton.styleFrom(
                            backgroundColor:
                                Colors.green,

                            foregroundColor:
                                Colors.white,

                            elevation: 0,

                            shape:
                                RoundedRectangleBorder(
                              borderRadius:
                                  BorderRadius.circular(
                                      18),
                            ),
                          ),

                          child: auth.loading
                              ? const SizedBox(
                                  width: 24,
                                  height: 24,

                                  child:
                                      CircularProgressIndicator(
                                    color: Colors.white,
                                    strokeWidth: 2.5,
                                  ),
                                )
                              : const Text(
                                  "LOGIN",

                                  style: TextStyle(
                                    fontSize: 18,
                                    fontWeight:
                                        FontWeight.bold,
                                  ),
                                ),
                        ),
                      ),

                      const SizedBox(height: 28),

                      Row(
                        children: const [

                          Expanded(
                            child: Divider(
                              thickness: 1,
                            ),
                          ),

                          Padding(
                            padding: EdgeInsets.symmetric(
                              horizontal: 12,
                            ),

                            child: Text(
                              "atau lanjut dengan",

                              style: TextStyle(
                                color: Colors.grey,
                              ),
                            ),
                          ),

                          Expanded(
                            child: Divider(
                              thickness: 1,
                            ),
                          ),

                        ],
                      ),

                      const SizedBox(height: 24),

                      SizedBox(
                        width: double.infinity,
                        height: 56,

                        child: OutlinedButton.icon(
                          onPressed: auth.loading
                              ? null
                              : googleLogin,

                          style:
                              OutlinedButton.styleFrom(
                            side: const BorderSide(
                              color: Color(0xffE5E7EB),
                            ),

                            backgroundColor:
                                Colors.white,

                            shape:
                                RoundedRectangleBorder(
                              borderRadius:
                                  BorderRadius.circular(
                                      18),
                            ),
                          ),

                          icon: Image.asset(
  "assets/images/google.png",
  width: 22,
  height: 22,
),

                          label: const Text(
                            "Continue with Google",

                            style: TextStyle(
                              color: Colors.black87,
                              fontWeight:
                                  FontWeight.w600,
                              fontSize: 15,
                            ),
                          ),
                        ),
                      ),

                      const SizedBox(height: 28),

                      const Text(
                        "Smart Waste Management Platform",

                        textAlign: TextAlign.center,

                        style: TextStyle(
                          color: Colors.grey,
                          fontSize: 13,
                        ),
                      ),
					                      ],
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}