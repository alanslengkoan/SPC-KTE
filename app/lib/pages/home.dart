import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';

class Home extends StatefulWidget {
  const Home({Key? key}) : super(key: key);

  @override
  State<Home> createState() => _HomeState();
}

class _HomeState extends State<Home> {
  List<String> imgList = [
    'assets/slide/slide1.jpg',
    'assets/slide/slide2.jpg',
    'assets/slide/slide3.jpg',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Center(
          child: Text('SPC Telur'),
        ),
        backgroundColor: const Color(0xFF1C6758),
      ),
      body: Center(
        child: Column(
          children: <Widget>[
            CarouselSlider(
              options: CarouselOptions(
                enlargeCenterPage: true,
                aspectRatio: 2.0,
                autoPlay: true,
              ),
              items: imgList
                  .map(
                    (item) => Image.asset(item, fit: BoxFit.cover, width: 1000),
                  )
                  .toList(),
            ),
            Container(
              margin: const EdgeInsets.only(top: 20),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Card(
                    child: InkWell(
                      splashColor: Colors.green.withAlpha(30),
                      onTap: () {
                        Navigator.pushNamed(context, '/about');
                      },
                      child: const SizedBox(
                        width: 150,
                        height: 100,
                        child: Icon(
                          Icons.info,
                          color: Colors.green,
                          size: 70,
                        ),
                      ),
                    ),
                  ),
                  Card(
                    child: InkWell(
                      splashColor: Colors.green.withAlpha(30),
                      onTap: () {
                        Navigator.pushNamed(context, '/konsultasi/add');
                      },
                      child: const SizedBox(
                        width: 150,
                        height: 100,
                        child: Icon(
                          Icons.add,
                          color: Colors.green,
                          size: 70,
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
