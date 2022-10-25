class ListKecelakaanKategori {
  final int? id;
  final String? nama;

  ListKecelakaanKategori({this.id, this.nama});

  factory ListKecelakaanKategori.fromJson(Map<dynamic, dynamic> json) {
    return ListKecelakaanKategori(
      id: json['id_kecelakaan_kategori'],
      nama: json['nama'],
    );
  }
}
