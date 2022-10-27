import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class ResultKonsultasi extends StatefulWidget {
  const ResultKonsultasi({Key? key, required this.title, this.id}) : super(key: key);
  final String title;
  final int? id;

  @override
  State<ResultKonsultasi> createState() => _ChartKecelakaanState();
}

class _ChartKecelakaanState extends State<ResultKonsultasi> {
  Map konsultasi = {};

  void _getData() async {
    var urlGet = Uri.parse("http://192.168.1.4/skripsi/spc/SPC-Kualitas-Telur/web/api/konsultasi/result/${widget.id}");

    var response = await http.get(urlGet, headers: {"Accept": "application/json"});

    if (response.statusCode == 200) {
      var data = json.decode(response.body);

      setState(() {
        konsultasi = data;
      });
    } else {
      throw Exception('Maaf gagal mengambil data!');
    }
  }

  @override
  void initState() {
    super.initState();
    _getData();
  }

  @override
  Widget build(BuildContext context) {
    _show() {
      return ListView(
        children: <Widget>[
          Column(
            children: <Widget>[
              Row(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.all(25.0),
                    child: Text(
                      'Nama',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['nama'],
                    ),
                  ),
                ],
              ),
              Row(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.all(25.0),
                    child: Text(
                      'Klasifikasi',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['klasifikasi'],
                    ),
                  ),
                ],
              ),
              Row(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.all(25.0),
                    child: Text(
                      'Deskripsi',
                    ),
                  ),
                  Expanded(
                    child: Text(
                      konsultasi['deskripsi'],
                      textAlign: TextAlign.justify,
                    ),
                  ),
                ],
              ),
              Row(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.only(left: 25, right: 10, top: 25, bottom: 25),
                    child: Text(
                      'R',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['r'].toString(),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(left: 25, right: 10, top: 25, bottom: 25),
                    child: Text(
                      'G',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['g'].toString(),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(left: 25, right: 10, top: 25, bottom: 25),
                    child: Text(
                      'B',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['b'].toString(),
                    ),
                  ),
                ],
              ),
              Row(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.only(left: 25, right: 10, top: 25, bottom: 25),
                    child: Text(
                      'H',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['h'].toString(),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(left: 25, right: 10, top: 25, bottom: 25),
                    child: Text(
                      'S',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['s'].toString(),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(left: 25, right: 10, top: 25, bottom: 25),
                    child: Text(
                      'V',
                    ),
                  ),
                  Container(
                    child: Text(
                      konsultasi['konsultasi']['v'].toString(),
                    ),
                  ),
                ],
              ),
            ],
          )
        ],
      );
    }

    _loading() {
      return const Center(
        child: CircularProgressIndicator(),
      );
    }

    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(widget.title),
        backgroundColor: const Color(0xFF1C6758),
      ),
      body: Container(
        margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
        child: konsultasi.isEmpty ? _loading() : _show(),
      ),
    );
  }
}
