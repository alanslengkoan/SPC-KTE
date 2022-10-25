import 'package:flutter/material.dart';

class About extends StatefulWidget {
  const About({Key? key, required this.title}) : super(key: key);
  final String title;

  @override
  State<About> createState() => _AboutState();
}

class _AboutState extends State<About> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(widget.title),
        backgroundColor: const Color(0xFF1071BA),
      ),
      body: Container(
        child: Column(
          children: <Widget>[
            Image.asset(
              'assets/images/cover.jpg',
              fit: BoxFit.cover,
            ),
            Container(
              margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
              child: const Text(
                'PT. SEMEN BOSOWA MAROS merupakan salah satu produsen Semen Portland Type 1 dengan kapasitas produksi 4.3 juta ton/tahun dengan jumlah Line Produksi sebanyak 2 Line, dengan cakupan wilayah kegiatan meliputi wilayah Indonesia dan ekspor ke berbagai negara di Asia dan Afrika. Untuk melayani pelanggan secara optimal PT. SEMEN BOSOWA MAROS yang didukung oleh SDM yang handal, memiliki jaringan distribusi pemasaran di beberapa  propinsi yang ada di Indonesia.',
                textAlign: TextAlign.justify,
              ),
            ),
            Container(
              margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
              child: const Text(
                'Sebagai salah satu perusahaan yang mengutamakan mutu, PT. SEMEN BOSOWA MAROS dalam melaksanakan aktivitas produksi semen selalu berdasarkan standar-standar yang berlaku secara nasional dan internasional dan dilaksanakan oleh personil-personil  yang berkualifikasi pada bidang pekerjaannya.',
                textAlign: TextAlign.justify,
              ),
            ),
            Container(
              margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
              child: const Text(
                'PT. SEMEN BOSOWA MAROS menempatkan sumber daya manusia sebagai manusia-manusia  yang sangat berharga bagi perusahaan,  sehingga selalu diupayakan pengembangannya melalui pelatihan-pelatihan baik yang dilaksanakan internal maupun eksternal.',
                textAlign: TextAlign.justify,
              ),
            )
          ],
        ),
      ),
    );
  }
}
