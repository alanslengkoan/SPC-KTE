import 'dart:io';

import 'package:Safety/model/m_kecelakaan.dart';
import 'package:flutter/material.dart';
import 'package:date_field/date_field.dart';
import 'package:image_picker/image_picker.dart';
import 'package:rflutter_alert/rflutter_alert.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'package:intl/intl.dart';
import 'package:video_player/video_player.dart';

class AddKecelakaan extends StatefulWidget {
  const AddKecelakaan({Key? key, required this.title}) : super(key: key);
  final String title;

  @override
  State<AddKecelakaan> createState() => _KecelakaanState();
}

class _KecelakaanState extends State<AddKecelakaan> {
  // deklarsi variabel
  final _formKey = GlobalKey<FormState>();

  late VideoPlayerController _controllerVideo;

  var urlGet = Uri.parse("https://nearmissbosowa.my.id/api/kecelakaan_kategori");
  var urlPost = Uri.parse("https://nearmissbosowa.my.id/api/kecelakaan/add");
  var picker = ImagePicker();
  var data = {};
  var _videoUpload;
  var _fotoFirst;
  var _fotoSecond;
  var _validasiFotoFirst = const Text('Belum ada foto yang diambil!');
  var _validasiFotoSecond = const Text('Belum ada foto yang diambil!');
  var _validasiVideo = const Text('Belum ada video yang diambil!');

  final List<ListKecelakaanKategori> _layanan = [];
  String? _idKategoriKecelakaan;
  DateTime? _tglKejadian;
  bool _klik = false;

  Future<void> _getData() async {
    var response = await http.get(urlGet, headers: {"Accept": "application/json"});

    if (response.statusCode == 200) {
      var data = json.decode(response.body);

      setState(() {
        _klik = true;
        for (Map i in data) {
          _layanan.add(ListKecelakaanKategori.fromJson(i));
        }
      });
    } else {
      throw Exception('Maaf gagal mengambil data!');
    }
  }

  void _takeVideo() async {
    var videoFile = await picker.pickVideo(source: ImageSource.gallery);

    setState(() {
      _videoUpload = File(videoFile!.path);
      _controllerVideo = VideoPlayerController.file(_videoUpload)
        ..initialize().then((_) {
          setState(() {});
        });
      _validasiVideo = const Text('');
    });
  }

  void _uploadFotoFirst() async {
    var imageFisrt = await picker.pickImage(source: ImageSource.gallery);

    setState(() {
      _fotoFirst = File(imageFisrt!.path);
      _validasiFotoFirst = const Text('');
    });
  }

  void _uploadFotoSecond() async {
    var imageSecond = await picker.pickImage(source: ImageSource.gallery);

    setState(() {
      _fotoSecond = File(imageSecond!.path);
      _validasiFotoSecond = const Text('');
    });
  }

  TextEditingController controllerPelapor = TextEditingController();
  TextEditingController controllerSaksi = TextEditingController();
  TextEditingController controllerUraian = TextEditingController();
  TextEditingController controllerTindakan = TextEditingController();
  TextEditingController controllerLokasiKejadian = TextEditingController();

  void addData() {
    String namaFotoFirst = _fotoFirst!.path.split("/").last;
    String namaFotoSecond = _fotoSecond!.path.split("/").last;
    String namaVideo = _videoUpload!.path.split("/").last;

    String locFotoFirst = base64Encode(_fotoFirst!.readAsBytesSync());
    String locFotoSecond = base64Encode(_fotoSecond!.readAsBytesSync());
    String locVideo = base64Encode(_videoUpload!.readAsBytesSync());

    data = {
      "pelapor": controllerPelapor.text,
      "saksi": controllerSaksi.text,
      "uraian": controllerUraian.text,
      "tindakan": controllerTindakan.text,
      "id_kecelakaan_kategori": _idKategoriKecelakaan,
      "tgl_kejadian": _tglKejadian?.toIso8601String(),
      "lokasi_kejadian": controllerLokasiKejadian.text,
      "foto_first": namaFotoFirst,
      "foto_second": namaFotoSecond,
      "video": namaVideo,
      "loc_first": locFotoFirst,
      "loc_second": locFotoSecond,
      "loc_video": locVideo,
    };

    http.post(urlPost, body: data).then((response) {
      var tampilkan = json.decode(response.body);

      Alert(
        context: context,
        type: AlertType.success,
        title: tampilkan['title'],
        desc: tampilkan['text'],
        buttons: [
          DialogButton(
            child: Text(
              tampilkan['button'],
              style: const TextStyle(color: Colors.white, fontSize: 20),
            ),
            onPressed: () {
              Navigator.of(context).pushNamedAndRemoveUntil('/home', (route) => false);
            },
            width: 120,
          )
        ],
      ).show();

      setState(() {
        _klik = true;
      });
    });
  }

  String? _validasiPelapor(String? value) {
    if (value!.isEmpty) {
      return 'Nama Pelapor, Wajib diisi!';
    }
    return null;
  }

  String? _validasiSaksi(String? value) {
    if (value!.isEmpty) {
      return 'Nama Saksi, Wajib diisi!';
    }
    return null;
  }

  String? _validasiUraian(String? value) {
    if (value!.isEmpty) {
      return 'Uraian Anda, Wajib diisi!';
    }
    return null;
  }

  String? _validasiTindakan(String? value) {
    if (value!.isEmpty) {
      return 'Tindakan Anda, Wajib diisi!';
    }
    return null;
  }

  String? _validasiKategoriKecelakaan(String? value) {
    if (value == null) {
      return 'Kategori Near Miss, Wajib diisi!';
    }
    return null;
  }

  String? _validasiTanggalWaktuKejadian(DateTime? value) {
    if (value == null) {
      return 'Tanggal & Waktu, Wajib diisi!';
    }
    return null;
  }

  String? _validasiLokasiKejadian(String? value) {
    if (value!.isEmpty) {
      return 'Lokasi Kejadian, Wajib diisi!';
    }
    return null;
  }

  @override
  void _validasiInput() {
    if (_formKey.currentState!.validate() && _fotoFirst != null && _fotoSecond != null) {
      _formKey.currentState!.save();
      addData();
      setState(() {
        _klik = false;
      });
    } else {
      setState(() {
        _validasiFotoFirst = const Text('Foto Pertama, Wajib diisi!', style: TextStyle(color: Colors.red));
        _validasiFotoSecond = const Text('Foto Kedua, Wajib diisi!', style: TextStyle(color: Colors.red));
      });
    }
  }

  @override
  void initState() {
    super.initState();
    _getData();
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
                      validator: _validasiPelapor,
                      controller: controllerPelapor,
                      decoration: const InputDecoration(
                        labelText: 'Pelapor *',
                        hintText: 'Masukkan nama Anda',
                      ),
                    ),
                    TextFormField(
                      validator: _validasiSaksi,
                      controller: controllerSaksi,
                      decoration: const InputDecoration(
                        labelText: 'Saksi *',
                        hintText: 'Masukkan nama saksi',
                      ),
                    ),
                    TextFormField(
                      validator: _validasiUraian,
                      controller: controllerUraian,
                      decoration: const InputDecoration(
                        labelText: 'Uraian *',
                        hintText: 'Masukkan uraian Anda',
                      ),
                    ),
                    TextFormField(
                      validator: _validasiTindakan,
                      controller: controllerTindakan,
                      decoration: const InputDecoration(
                        labelText: 'Tindakan *',
                        hintText: 'Masukkan tindakan Anda',
                      ),
                    ),
                    DropdownButtonFormField(
                      validator: _validasiKategoriKecelakaan,
                      icon: const Icon(Icons.keyboard_arrow_down),
                      isExpanded: true,
                      items: _layanan.map((item) {
                        return DropdownMenuItem(
                          child: Text(item.nama.toString()),
                          value: item.id.toString(),
                        );
                      }).toList(),
                      onChanged: (val) {
                        setState(() {
                          _idKategoriKecelakaan = val.toString();
                        });
                      },
                      hint: const Text('Kategori Near Miss *'),
                    ),
                    DateTimeFormField(
                      validator: _validasiTanggalWaktuKejadian,
                      decoration: const InputDecoration(
                        labelText: 'Tanggal & Waktu Kejadian *',
                      ),
                      dateFormat: DateFormat("dd-MM-yyyy hh:mm"),
                      onDateSelected: (DateTime val) {
                        _tglKejadian = val;
                      },
                    ),
                    TextFormField(
                      validator: _validasiLokasiKejadian,
                      controller: controllerLokasiKejadian,
                      decoration: const InputDecoration(
                        labelText: 'Lokasi Kejadian *',
                        hintText: 'Masukkan tindakan Anda',
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.only(top: 10),
                      child: Column(
                        children: <Widget>[
                          ElevatedButton(
                            onPressed: _uploadFotoFirst,
                            child: Container(
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: const <Widget>[Text("Foto First", style: TextStyle(color: Colors.black))],
                              ),
                            ),
                          ),
                          Container(
                            width: 200,
                            height: 200,
                            decoration: const BoxDecoration(color: Colors.grey),
                            child: _fotoFirst != null
                                ? Image.file(
                                    _fotoFirst,
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
                            child: _fotoFirst == null ? _validasiFotoFirst : _validasiFotoFirst,
                          )
                        ],
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.only(top: 10),
                      child: Column(
                        children: <Widget>[
                          ElevatedButton(
                            onPressed: _uploadFotoSecond,
                            child: Container(
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: const <Widget>[
                                  Text(
                                    "Foto Second",
                                    style: TextStyle(color: Colors.black),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            width: 200,
                            height: 200,
                            decoration: const BoxDecoration(color: Colors.grey),
                            child: _fotoSecond != null
                                ? Image.file(
                                    _fotoSecond,
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
                            child: _fotoSecond == null ? _validasiFotoSecond : _validasiFotoSecond,
                          )
                        ],
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.only(top: 10),
                      child: Column(
                        children: <Widget>[
                          ElevatedButton(
                            onPressed: _takeVideo,
                            child: Container(
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: const <Widget>[
                                  Text(
                                    "Take Video",
                                    style: TextStyle(color: Colors.black),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            decoration: const BoxDecoration(color: Colors.grey),
                            child: _videoUpload != null
                                ? Container(
                                    child: Column(
                                      children: <Widget>[
                                        Center(
                                          child: AspectRatio(
                                            aspectRatio: _controllerVideo.value.aspectRatio,
                                            child: VideoPlayer(_controllerVideo),
                                          ),
                                        ),
                                        Container(
                                          child: ElevatedButton(
                                            onPressed: () {
                                              setState(() {
                                                _controllerVideo.value.isPlaying ? _controllerVideo.pause() : _controllerVideo.play();
                                              });
                                            },
                                            child: Icon(
                                              _controllerVideo.value.isPlaying ? Icons.pause : Icons.play_arrow,
                                            ),
                                          ),
                                        )
                                      ],
                                    ),
                                  )
                                : Container(
                                    decoration: const BoxDecoration(color: Colors.grey),
                                    width: 200,
                                    height: 200,
                                    child: Icon(
                                      Icons.video_collection,
                                      color: Colors.grey[800],
                                    ),
                                  ),
                          ),
                          Container(
                            child: _videoUpload == null ? _validasiVideo : _validasiVideo,
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
