import 'package:http/http.dart' as http;

class Network {
  final String _url = 'http://192.140.20.234/skripsi/SPC-KTE/web/api';

  auth(data, apiUrl) async {
    var urlAuth = Uri.parse(_url + '/auth' + apiUrl);

    return await http.post(
      urlAuth,
      body: data,
    );
  }

  getKonsultasi() async {}

  getKonsultasiById(id) async {}

  getKonsultasiResult(id) async {
    var urlAuth = Uri.parse(_url + '/konsultasi/result/' + id); 

    return await http.get(
      urlAuth,
      headers: {"Accept": "application/json"},
    );
  }

  addKonsultasi(data) async {
    var urlAuth = Uri.parse(_url + '/konsultasi/save');

    return await http.post(
      urlAuth,
      body: data,
    );
  }
}
