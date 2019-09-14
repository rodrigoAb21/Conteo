import 'package:flutter/material.dart';

class QrPage extends StatelessWidget {

  static final String routeName = 'qr';

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Preferencias'),
        centerTitle: true,
        backgroundColor: Colors.blue,
      ),
      body: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Text('Settings'),
          Divider()
        ],
      ),
    );
  }
}