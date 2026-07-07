class UserModel {
  final int id;
  final String nama;
  final String username;
  final String email;
  final String role;
  final int poin;
  final String? foto;

  UserModel({
    required this.id,
    required this.nama,
    required this.username,
    required this.email,
    required this.role,
    required this.poin,
    this.foto,
  });

  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'],
      nama: json['nama'],
      username: json['username'],
      email: json['email'] ?? '',
      role: json['role'],
      poin: json['poin'] ?? 0,
      foto: json['foto'],
    );
  }
}