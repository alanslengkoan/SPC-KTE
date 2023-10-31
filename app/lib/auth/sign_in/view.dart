import 'package:egg_detection/auth/sign_up/view.dart';
import 'package:egg_detection/networks/api.dart';
import 'package:flutter/material.dart';
import 'package:rflutter_alert/rflutter_alert.dart';
import 'dart:convert';

import 'package:shared_preferences/shared_preferences.dart';

class SignIn extends StatefulWidget {
  @override
  State<SignIn> createState() => _SignInState();
}

class _SignInState extends State<SignIn> {
  final _formKey = GlobalKey<FormState>();

  TextEditingController controllerUsername = TextEditingController();
  TextEditingController controllerPassword = TextEditingController();

  String? _validasiUsername(String? value) {
    if (value == null || value.isEmpty) {
      return 'Username, Wajib diisi!';
    }
    return null;
  }

  String? _validasiPassword(String? value) {
    if (value == null || value.isEmpty) {
      return 'Password, Wajib diisi!';
    }
    return null;
  }

  _logIn() async {
    var data = {
      "username": controllerUsername.text,
      "password": controllerPassword.text,
    };

    var response = await Network().auth(data, '/login');
    var body = json.decode(response.body);
    var type;
    print(body);
    if (response.statusCode == 200) {
      if (body['status']) {
        type = AlertType.success;
      } else {
        type = AlertType.error;
      }

      if (body['status']) {
        _checkSession(
          body['id_users'],
          body['nama'],
          body['email'],
          body['status'],
        );
      } else {
        Alert(
          context: context,
          type: type,
          title: body['title'],
          desc: body['text'],
          buttons: [
            DialogButton(
              child: Text(
                body['button'],
                style: const TextStyle(color: Colors.white, fontSize: 20),
              ),
              onPressed: () {
                Navigator.pop(context);
              },
              width: 120,
            )
          ],
        ).show();
      }
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

  _validasiInput() {
    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();

      _logIn();

      // setState(() {
      //   _klik = false;
      // });
    }
  }

  @override
  Widget build(BuildContext context) {
    _signInScreen() {
      return Scaffold(
        body: Center(
          child: ListView(
            shrinkWrap: true,
            children: <Widget>[
              Container(
                margin: EdgeInsets.only(top: 30),
                alignment: Alignment.center,
                child: Image.asset('assets/images/logo.png', width: 100),
              ),
              Card(
                margin: EdgeInsets.all(30),
                elevation: 3,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(25),
                ),
                child: Padding(
                  padding: EdgeInsets.all(40),
                  child: Form(
                    key: _formKey,
                    child: Column(
                      children: <Widget>[
                        Container(
                          padding: EdgeInsets.only(bottom: 30),
                          child: Text(
                            'SIGN IN',
                            style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                              color: Colors.green,
                            ),
                          ),
                        ),
                        TextFormField(
                          validator: _validasiUsername,
                          controller: controllerUsername,
                          decoration: InputDecoration(
                            labelText: 'Username',
                            labelStyle: TextStyle(color: Colors.black87),
                            prefixIcon: Icon(
                              Icons.person_pin_rounded,
                              color: Colors.green,
                            ),
                            contentPadding: EdgeInsets.fromLTRB(20, 10, 0, 10),
                            focusedBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(25),
                              borderSide: BorderSide(
                                width: 2,
                                color: Colors.green,
                              ),
                            ),
                            enabledBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(25),
                              borderSide: BorderSide(
                                color: Colors.green,
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 10),
                        TextFormField(
                          validator: _validasiPassword,
                          controller: controllerPassword,
                          obscureText: true,
                          decoration: InputDecoration(
                            labelText: 'Password',
                            labelStyle: TextStyle(color: Colors.black87),
                            prefixIcon: Icon(
                              Icons.lock,
                              color: Colors.green,
                            ),
                            suffixIcon: GestureDetector(
                              child: Icon(
                                Icons.visibility,
                                color: Colors.green,
                              ),
                              onTap: () {},
                            ),
                            contentPadding:
                                EdgeInsets.fromLTRB(20, 10, -20, 10),
                            focusedBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(25),
                              borderSide: BorderSide(
                                width: 2,
                                color: Colors.green,
                              ),
                            ),
                            enabledBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(25),
                              borderSide: BorderSide(
                                color: Colors.green,
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 30),
                        Material(
                          borderRadius: BorderRadius.circular(25),
                          color: Colors.green,
                          child: MaterialButton(
                            minWidth: double.infinity,
                            onPressed: _validasiInput,
                            child:
                                Icon(Icons.arrow_forward, color: Colors.white),
                          ),
                        ),
                        SizedBox(height: 15),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: <Widget>[
                            GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) {
                                      return SignUp();
                                    },
                                  ),
                                );
                              },
                              child: Text(
                                'SIGN UP',
                                style: TextStyle(
                                  color: Colors.green,
                                ),
                              ),
                            ),
                          ],
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

    return _signInScreen();
  }
}
