import 'dart:io';

import 'package:SPC_Telur/model/m_kecelakaan.dart';
import 'package:flutter/material.dart';
import 'package:date_field/date_field.dart';
import 'package:image_picker/image_picker.dart';
import 'package:rflutter_alert/rflutter_alert.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:intl/intl.dart';

class AddKecelakaan extends StatefulWidget {
  const AddKecelakaan({Key? key, required this.title}) : super(key: key);
  final String title;

  @override
  State<AddKecelakaan> createState() => _KecelakaanState();
}

class _KecelakaanState extends State<AddKecelakaan> {
  // deklarsi variabel
  final _formKey = GlobalKey<FormState>();

  var urlPost = Uri.parse("https://nearmissbosowa.my.id/api/kecelakaan/add");
  var picker = ImagePicker();
  var data = {};
  var _imageUpload;
  var _validasiImageUpload = const Text('Belum ada gambar yang diambil!');

  bool _klik = true;

  void _uploadImage() async {
    var imageUpload = await picker.pickImage(source: ImageSource.gallery);

    setState(() {
      _imageUpload = File(imageUpload!.path);
      _validasiImageUpload = const Text('');
    });
  }

  void _takeImage() async {
    var imageUpload = await picker.pickImage(source: ImageSource.camera);

    setState(() {
      _imageUpload = File(imageUpload!.path);
      _validasiImageUpload = const Text('');
    });
  }

  TextEditingController controllerNama = TextEditingController();

  // void addData() {
  //   String namaFotoFirst = _imageUpload!.path.split("/").last;
  //   String namaFotoSecond = _fotoSecond!.path.split("/").last;
  //   String namaVideo = _videoUpload!.path.split("/").last;

  //   String locFotoFirst = base64Encode(_imageUpload!.readAsBytesSync());
  //   String locFotoSecond = base64Encode(_fotoSecond!.readAsBytesSync());
  //   String locVideo = base64Encode(_videoUpload!.readAsBytesSync());

  //   data = {
  //     "pelapor": controllerNama.text,
  //     "saksi": controllerSaksi.text,
  //     "uraian": controllerUraian.text,
  //     "tindakan": controllerTindakan.text,
  //     "id_kecelakaan_kategori": _idKategoriKecelakaan,
  //     "tgl_kejadian": _tglKejadian?.toIso8601String(),
  //     "lokasi_kejadian": controllerLokasiKejadian.text,
  //     "foto_first": namaFotoFirst,
  //     "foto_second": namaFotoSecond,
  //     "video": namaVideo,
  //     "loc_first": locFotoFirst,
  //     "loc_second": locFotoSecond,
  //     "loc_video": locVideo,
  //   };

  //   http.post(urlPost, body: data).then((response) {
  //     var tampilkan = json.decode(response.body);

  //     Alert(
  //       context: context,
  //       type: AlertType.success,
  //       title: tampilkan['title'],
  //       desc: tampilkan['text'],
  //       buttons: [
  //         DialogButton(
  //           child: Text(
  //             tampilkan['button'],
  //             style: const TextStyle(color: Colors.white, fontSize: 20),
  //           ),
  //           onPressed: () {
  //             Navigator.of(context).pushNamedAndRemoveUntil('/home', (route) => false);
  //           },
  //           width: 120,
  //         )
  //       ],
  //     ).show();

  //     setState(() {
  //       _klik = true;
  //     });
  //   });
  // }

  String? _validasiNama(String? value) {
    if (value!.isEmpty) {
      return 'Nama Pelapor, Wajib diisi!';
    }
    return null;
  }

  @override
  void _validasiInput() {
    if (_formKey.currentState!.validate() && _imageUpload != null) {
      _formKey.currentState!.save();
      // addData();
      setState(() {
        _klik = false;
      });
    } else {
      setState(() {
        _validasiImageUpload = const Text('Belum ada gambar yang diambil!', style: TextStyle(color: Colors.red));
      });
    }
  }

  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    _form() {
      return CustomScrollView(
        slivers: <Widget>[
          SliverList(
            delegate: SliverChildListDelegate([
              Form(
                key: _formKey,
                autovalidateMode: AutovalidateMode.onUserInteraction,
                child: Column(
                  children: <Widget>[
                    TextFormField(
                      validator: _validasiNama,
                      controller: controllerNama,
                      decoration: const InputDecoration(
                        labelText: 'Nama *',
                        hintText: 'Masukkan nama Anda',
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.only(top: 10),
                      child: Column(
                        children: <Widget>[
                          ElevatedButton(
                            onPressed: _uploadImage,
                            child: Container(
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: const <Widget>[Text("Upload Gambar", style: TextStyle(color: Colors.black))],
                              ),
                            ),
                          ),
                          ElevatedButton(
                            onPressed: _takeImage,
                            child: Container(
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: const <Widget>[Text("Ambil Gambar", style: TextStyle(color: Colors.black))],
                              ),
                            ),
                          ),
                          Container(
                            width: 200,
                            height: 200,
                            decoration: const BoxDecoration(color: Colors.grey),
                            child: _imageUpload != null
                                ? Image.file(
                                    _imageUpload,
                                    width: 200.0,
                                    height: 200.0,
                                    fit: BoxFit.fitHeight,
                                  )
                                : Container(
                                    decoration: const BoxDecoration(color: Colors.grey),
                                    width: 200,
                                    height: 200,
                                    child: Icon(
                                      Icons.camera_alt,
                                      color: Colors.grey[800],
                                    ),
                                  ),
                          ),
                          Container(
                            child: _imageUpload == null ? _validasiImageUpload : _validasiImageUpload,
                          )
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ]),
          ),
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
        backgroundColor: const Color(0xFF1071BA),
        actions: <Widget>[
          Padding(
            padding: const EdgeInsets.only(right: 20.0),
            child: GestureDetector(
              onTap: _validasiInput,
              child: const Icon(
                Icons.check,
                size: 26.0,
              ),
            ),
          ),
        ],
      ),
      body: Container(
        margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
        child: _klik != false ? _form() : _loading(),
      ),
    );
  }
}
