class UserProfile {
  final int id;

  final String nama;

  final String username;

  final String email;

  final int poin;

  final String? photo;

  UserProfile({
    required this.id,
    required this.nama,
    required this.username,
    required this.email,
    required this.poin,
    this.photo,
  });

  factory UserProfile.fromJson(
    Map<String, dynamic> json,
  ) {
    return UserProfile(
      id: json["id"],

      nama: json["nama"] ?? "",

      username: json["username"] ?? "",

      email: json["email"] ?? "",

      poin: json["poin"] ?? 0,

      photo: json["photo"],
    );
  }
}