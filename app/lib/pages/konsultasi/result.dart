import 'package:SPC_Telur/model/m_kecelakaan_chart.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:charts_flutter/flutter.dart' as charts;
import 'dart:convert';

class ChartKecelakaan extends StatefulWidget {
  const ChartKecelakaan({Key? key, required this.title}) : super(key: key);
  final String title;

  @override
  State<ChartKecelakaan> createState() => _ChartKecelakaanState();
}

class _ChartKecelakaanState extends State<ChartKecelakaan> {
  var urlGet = Uri.parse("https://nearmissbosowa.my.id/api/kecelakaan/chart");

  final List<ListKecelakaanChart> _data = [];
  final List<charts.Series<ListKecelakaanChart, String>> _chartData = [];
  var _showChart;

  void _getData() async {
    var response = await http.get(urlGet, headers: {"Accept": "application/json"});

    if (response.statusCode == 200) {
      var data = json.decode(response.body);

      setState(() {
        for (Map i in data) {
          _data.add(ListKecelakaanChart(i['x'].toString(), i['y'], i['color']));
        }

        _chartData.add(
          charts.Series(
            id: 'Sales',
            data: _data,
            domainFn: (ListKecelakaanChart row, _) => row.x,
            measureFn: (ListKecelakaanChart row, _) => row.y,
            labelAccessorFn: (ListKecelakaanChart row, _) => '${row.x}: ${row.y} Orang',
            fillColorFn: (ListKecelakaanChart row, _) => charts.ColorUtil.fromDartColor(
              Color(int.parse(row.color)),
            ),
          ),
        );

        _showChart = charts.BarChart(
          _chartData,
          animate: true,
          vertical: false,
          barRendererDecorator: charts.BarLabelDecorator<String>(),
          domainAxis: const charts.OrdinalAxisSpec(
            renderSpec: charts.NoneRenderSpec(),
          ),
        );
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
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(widget.title),
        backgroundColor: const Color(0xFF1C6758),
      ),
      body: Container(
        margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
        child: Column(
          children: <Widget>[
            Expanded(
              child: _showChart ??
                  const Center(
                    child: CircularProgressIndicator(),
                  ),
            )
          ],
        ),
      ),
    );
  }
}
