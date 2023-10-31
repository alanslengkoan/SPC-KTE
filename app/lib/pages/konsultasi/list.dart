import 'package:flutter/material.dart';

class Konsultasi extends StatelessWidget {
  const Konsultasi({Key? key, required this.title}) : super(key: key);

  final String title;

  @override
  Widget build(BuildContext context) {
    _listKonsultasiUser() {
      return CustomScrollView(
        slivers: <Widget>[
          SliverList(
            delegate: SliverChildListDelegate([
              Container(
                margin: EdgeInsets.all(10),
                child: TextField(
                  decoration: InputDecoration(
                    labelText: 'Search',
                    labelStyle: TextStyle(
                      color: Colors.black,
                    ),
                    suffixIcon: Icon(
                      Icons.search,
                      color: Colors.black,
                    ),
                    contentPadding: EdgeInsets.fromLTRB(10, 10, 0, 10),
                    focusedBorder: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(5),
                      borderSide: BorderSide(
                        width: 2,
                        color: const Color(0xFF1C6758),
                      ),
                    ),
                    enabledBorder: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(5),
                      borderSide: BorderSide(
                        color: const Color(0xFF1C6758),
                      ),
                    ),
                  ),
                ),
              ),
              Container(
                child: Column(
                  children: <Widget>[
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                    Container(
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
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const ListTile(
                                      leading: Icon(
                                        Icons.archive,
                                        color: const Color(0xFF1C6758),
                                        size: 45,
                                      ),
                                      title: Text(
                                        "Nama Paket",
                                        style: TextStyle(fontSize: 20),
                                      ),
                                      subtitle: Text('26 April 2023'),
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
                    ),
                  ],
                ),
              )
            ]),
          ),
        ],
      );
    }

    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text(title),
        backgroundColor: const Color(0xFF1C6758),
        actions: <Widget>[
          Padding(
            padding: const EdgeInsets.only(right: 20.0),
            child: GestureDetector(
              onTap: () {
                Navigator.pushNamed(context, '/konsultasi/add');
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
