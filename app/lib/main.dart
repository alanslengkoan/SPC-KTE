import 'package:SPC_Telur/pages/about.dart';
import 'package:SPC_Telur/pages/home.dart';
import 'package:SPC_Telur/pages/konsultasi/add.dart';
import 'package:SPC_Telur/pages/konsultasi/result.dart';
import 'package:SPC_Telur/splash.dart';
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
      theme: ThemeData(
        primaryColor: const Color(0xFFFFFFFF),
      ),
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
