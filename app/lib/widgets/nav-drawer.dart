import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class NavDrawer extends StatelessWidget {
  const NavDrawer({required this.nama, required this.email});

  final String nama;
  final String email;

  @override
  Widget build(BuildContext context) {
    void logout() async {
      SharedPreferences preferences = await SharedPreferences.getInstance();
      preferences.remove("id_users");
      preferences.remove("nama");
      preferences.remove("email");
      preferences.remove("status");
      Navigator.of(context)
          .pushNamedAndRemoveUntil('/sign_in', (route) => false);
    }

    return Drawer(
      child: ListView(
        padding: EdgeInsets.zero,
        children: <Widget>[
          DrawerHeader(
            child: Container(
              child: Column(
                children: [
                  Align(
                    alignment: Alignment.centerLeft,
                    child: Text(
                      'Halo, $nama',
                      style: TextStyle(color: Colors.white, fontSize: 25),
                    ),
                  ),
                  Align(
                    alignment: Alignment.centerLeft,
                    child: Text(
                      '$email',
                      style: TextStyle(color: Colors.white, fontSize: 15),
                    ),
                  ),
                ],
              ),
            ),
            decoration: BoxDecoration(
              color: Color(0xFF1C6758),
            ),
          ),
          ListTile(
            leading: Icon(Icons.verified_user),
            title: Text('Profile'),
            onTap: () => {Navigator.of(context).pop()},
          ),
          ListTile(
            leading: Icon(Icons.exit_to_app),
            title: Text('Logout'),
            onTap: () => {
              logout(),
            },
          ),
        ],
      ),
    );
  }
}
