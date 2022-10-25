import 'package:Safety/pages/about.dart';
import 'package:Safety/pages/home.dart';
import 'package:Safety/pages/kecelakaan/add.dart';
import 'package:Safety/pages/kecelakaan/chart.dart';
import 'package:Safety/splash.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'SAFETY',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primaryColor: const Color(0xFFFFFFFF),
      ),
      initialRoute: '/',
      routes: {
        '/': (context) => const Splash(),
        '/home': (context) => const Home(),
        '/about': (context) => const About(title: 'About'),
        '/kecelakaan/chart': (context) => const ChartKecelakaan(title: 'Chart Near Miss'),
        '/kecelakaan/add': (context) => const AddKecelakaan(title: 'Tambah Near Miss'),
      },
    );
  }
}
