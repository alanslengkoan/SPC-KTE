import 'dart:convert';

import 'package:egg_detection/networks/api.dart';
import 'package:egg_detection/pages/konsultasi/add.dart';
import 'package:egg_detection/pages/konsultasi/result.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Konsultasi extends StatefulWidget {
  const Konsultasi({Key? key, required this.title}) : super(key: key);

  final String title;

  @override
  State<Konsultasi> createState() => _KonsultasiState();
}

class _KonsultasiState extends State<Konsultasi> {
  List _dataKonsultasi = [];

  _loadKonsultasi() async {
    SharedPreferences preferences = await SharedPreferences.getInstance();
    var id = preferences.getString('id_users');
    var response = await Network().getKonsultasiById(id.toString());
    if (response.statusCode == 200) {
      var body = json.decode(response.body);
      if (body['status']) {
        print(body['data']);
        setState(() {
          _dataKonsultasi = body['data'];
        });
      } else {
        throw Exception('Maaf data belum ada!');
      }
    } else {
      throw Exception('Maaf gagal mengambil data!');
    }
  }

  @override
  void initState() {
    super.initState();
    _loadKonsultasi();
  }

  @override
  Widget build(BuildContext context) {
    _listKonsultasiUser() {
      return Container(
        child: ListView.builder(
          itemCount: _dataKonsultasi.length,
          itemBuilder: (context, index) {
            return Container(
              margin: EdgeInsets.all(10),
              height: 100,
              child: Card(
                clipBehavior: Clip.antiAlias,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(8.0),
                ),
                color: Colors.white,
                child: Row(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: <Widget>[
                    Expanded(
                      child: GestureDetector(
                        onTap: () {
                          Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(
                              builder: (context) => ResultKonsultasi(
                                title: "Hasil Konsultasi",
                                id: _dataKonsultasi[index]['id_konsultasi'],
                              ),
                            ),
                            (route) => false,
                          );
                        },
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            ListTile(
                              leading: Icon(
                                Icons.archive,
                                color: const Color(0xFF1C6758),
                                size: 45,
                              ),
                              title: Text(
                                _dataKonsultasi[index]['nama'].toString(),
                                style: TextStyle(fontSize: 20),
                              ),
                              subtitle:
                                  Text(_dataKonsultasi[index]['created_at']),
                            ),
                          ],
                        ),
                      ),
                    ),
                    Container(
                      color: Color(0xFF1C6758),
                      width: 10,
                    ),
                  ],
                ),
              ),
            );
          },
        ),
      );
    }

    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(widget.title),
        backgroundColor: const Color(0xFF1C6758),
        actions: <Widget>[
          Padding(
            padding: const EdgeInsets.only(right: 20.0),
            child: GestureDetector(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => AddKonsultasi(
                      title: "Tambah Konsultasi",
                    ),
                  ),
                );
              },
              child: const Icon(
                Icons.add,
                size: 26.0,
              ),
            ),
          ),
        ],
      ),
      body: Container(
        margin: const EdgeInsets.all(15),
        child: _listKonsultasiUser(),
      ),
    );
  }
}
