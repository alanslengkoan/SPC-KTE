import 'package:egg_detection/pages/about.dart';
import 'package:egg_detection/pages/home.dart';
import 'package:egg_detection/pages/konsultasi/add.dart';
import 'package:egg_detection/pages/konsultasi/result.dart';
import 'package:egg_detection/splash.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'EDA',
      debugShowCheckedModeBanner: false,
      initialRoute: '/',
      routes: {
        '/': (context) => const Splash(),
        '/home': (context) => const Home(),
        '/about': (context) => const About(title: 'About'),
        '/konsultasi/add': (context) => const AddKonsultasi(title: 'Konsultasi'),
        '/konsultasi/result': (context) => const ResultKonsultasi(title: 'Hasil Konsultasi'),
      },
    );
  }
}
