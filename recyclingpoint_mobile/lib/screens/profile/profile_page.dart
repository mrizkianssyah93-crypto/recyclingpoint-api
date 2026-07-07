import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../providers/profile_provider.dart';
import 'dart:io';

import 'package:image_picker/image_picker.dart';
import '../../config/api.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  final namaController = TextEditingController();

  final usernameController =
      TextEditingController();

  final emailController =
      TextEditingController();
final ImagePicker picker =
    ImagePicker();

  @override
  void initState() {
    super.initState();

    Future.microtask(() async {
      await context
          .read<ProfileProvider>()
          .loadProfile();

      if (!mounted) return;

      final profile =
          context.read<ProfileProvider>().profile;

      if (profile != null) {
        namaController.text = profile.nama;

        usernameController.text =
            profile.username;

        emailController.text =
            profile.email;
      }
    });
  }
    @override
  Widget build(BuildContext context) {
    final provider =
        context.watch<ProfileProvider>();

    final profile = provider.profile;

    return Scaffold(
      appBar: AppBar(
        title: const Text("Profile"),
        backgroundColor: Colors.green,
        foregroundColor: Colors.white,
      ),

      body: provider.loading
          ? const Center(
              child:
                  CircularProgressIndicator(),
            )
          : SingleChildScrollView(
              padding:
                  const EdgeInsets.all(20),

              child: Column(
                children: [

                  CircleAvatar(
                    radius: 55,
                    backgroundColor:
                        Colors.green.shade100,

backgroundImage:
    profile?.photo != null &&
            profile!.photo!.isNotEmpty
        ? NetworkImage(
            "${ApiConfig.baseUrl.replaceAll("/api", "")}/storage/profile/${profile.photo}",
          )
        : null,

                    child:
                        profile?.photo == null ||
                                profile!
                                    .photo!
                                    .isEmpty
                            ? const Icon(
                                Icons.person,
                                size: 60,
                                color:
                                    Colors.green,
                              )
                            : null,
                  ),

                  const SizedBox(height: 15),

                  Text(
                    profile?.nama ?? "-",
                    style:
                        const TextStyle(
                      fontSize: 24,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),

                  const SizedBox(height: 5),

                  Text(
                    profile?.email ?? "-",
                    style:
                        const TextStyle(
                      color: Colors.grey,
                    ),
                  ),

                  const SizedBox(height: 25),

                  Card(
                    elevation: 2,

                    shape:
                        RoundedRectangleBorder(
                      borderRadius:
                          BorderRadius.circular(
                        18,
                      ),
                    ),

                    child: Padding(
                      padding:
                          const EdgeInsets.all(
                        20,
                      ),

                      child: Column(
                        children: [

                          TextField(
                            controller:
                                namaController,

                            decoration:
                                const InputDecoration(
                              labelText:
                                  "Nama",
                            ),
                          ),

                          const SizedBox(
                              height: 18),

                          TextField(
                            controller:
                                usernameController,

                            decoration:
                                const InputDecoration(
                              labelText:
                                  "Username",
                            ),
                          ),

                          const SizedBox(
                              height: 18),

                          TextField(
                            controller:
                                emailController,

                            decoration:
                                const InputDecoration(
                              labelText:
                                  "Email",
                            ),
                          ),
                                                    const SizedBox(height: 25),

                          SizedBox(
                            width: double.infinity,
                            height: 50,

                            child: ElevatedButton.icon(
                              onPressed: () async {

                                final success =
                                    await provider.updateProfile(
                                  nama: namaController.text,
                                  username:
                                      usernameController.text,
                                  email:
                                      emailController.text,
                                );

                                if (!mounted) return;

                                ScaffoldMessenger.of(context)
                                    .showSnackBar(
                                  SnackBar(
                                    backgroundColor: success
                                        ? Colors.green
                                        : Colors.red,
                                    content: Text(
                                      success
                                          ? "Profile berhasil diperbarui."
                                          : "Gagal memperbarui profile.",
                                    ),
                                  ),
                                );
                              },

                              icon: const Icon(
                                Icons.save,
                              ),

                              label: const Text(
                                "Simpan Perubahan",
                              ),

                              style:
                                  ElevatedButton.styleFrom(
                                backgroundColor:
                                    Colors.green,
                                foregroundColor:
                                    Colors.white,
                              ),
                            ),
                          ),

                          const SizedBox(height: 15),

                          SizedBox(
                            width: double.infinity,
                            height: 50,

                            child: OutlinedButton.icon(
  onPressed: () async {
    await uploadPhoto();
  },

  icon: const Icon(
    Icons.photo_camera,
  ),

  label: const Text(
    "Upload Foto Profile",
  ),
),
                          ),
                        ],
                      ),
                    ),
                  ),

                  const SizedBox(height: 30),
                ],
              ),
            ),
    );
  }
  Future<void> uploadPhoto() async {
  final XFile? image =
      await picker.pickImage(
    source: ImageSource.gallery,
    imageQuality: 80,
  );

  if (image == null) return;

  final success =
      await context
          .read<ProfileProvider>()
          .uploadPhoto(
            File(image.path),
          );

  if (!mounted) return;

  ScaffoldMessenger.of(context)
      .showSnackBar(
    SnackBar(
      backgroundColor:
          success ? Colors.green : Colors.red,
      content: Text(
        success
            ? "Foto profile berhasil diupload."
            : "Upload gagal.",
      ),
    ),
  );
}
}