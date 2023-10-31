import 'package:egg_detection/auth/sign_in/view.dart';
import 'package:egg_detection/auth/sign_up/view.dart';
import 'package:egg_detection/pages/about.dart';
import 'package:egg_detection/pages/home.dart';
import 'package:egg_detection/pages/konsultasi/add.dart';
import 'package:egg_detection/pages/konsultasi/list.dart';
import 'package:egg_detection/pages/konsultasi/result.dart';
import 'package:egg_detection/widgets/splash.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

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
      home: CheckAuth(),
      routes: {
        '/home': (context) => const Home(),
        '/about': (context) => const About(title: 'About'),
        '/sign_in': (context) => SignIn(),
        '/sign_up': (context) => SignUp(),
        '/konsultasi': (context) => Konsultasi(title: 'Konsultasi'),
        '/konsultasi/add': (context) => AddKonsultasi(title: 'Tambah Konsultasi'),
        '/konsultasi/result': (context) => ResultKonsultasi(title: 'Hasil Konsultasi'),
      },
    );
  }
}

class CheckAuth extends StatefulWidget {
  @override
  State<CheckAuth> createState() => CheckAuthState();
}

class CheckAuthState extends State<CheckAuth> {
  void _checkIfLoggedIn() async {
    SharedPreferences preferences = await SharedPreferences.getInstance();
    var idUsers = preferences.getString('id_users');
    if (idUsers != null && idUsers.isNotEmpty && idUsers != '') {
      String nama = preferences.getString("nama") ?? '';
      String email = preferences.getString("email") ?? '';
      bool status = preferences.getBool("status") ?? false;

      setState(() {
        _checkSession(idUsers, nama, email, status);
      });
    } else {
      Navigator.of(context)
          .pushNamedAndRemoveUntil('/sign_in', (route) => false);
    }
  }

  _checkSession(String idUsers, String nama, String email, bool status) async {
    SharedPreferences preferences = await SharedPreferences.getInstance();
    setState(
      () {
        preferences.setString("id_users", idUsers);
        preferences.setString("nama", nama);
        preferences.setString("email", email);
        preferences.setBool("status", status);
        Navigator.of(context)
            .pushNamedAndRemoveUntil('/home', (route) => false);
      },
    );
  }

  @override
  void initState() {
    super.initState();
    Future.delayed(Duration(seconds: 3), () {
      _checkIfLoggedIn();
    });
  }

  @override
  Widget build(BuildContext context) {
    return const Splash();
  }
}
