import 'package:flutter/material.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';

class QrPage extends StatefulWidget {
  static final String routeName = 'qr_page';
  QrPage({Key key}) : super(key: key);

  _QrPageState createState() => _QrPageState();
}

class _QrPageState extends State<QrPage> {
String _counter,_value = "";

  Future _incrementCounter() async{

    _counter= await FlutterBarcodeScanner.scanBarcode("#004297", "Cancel", true);

    setState(() {
      _value=_counter;
    });


  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(
      appBar: AppBar(

        title: Text("QR"),
      ),
      body: Center(
        // Center is a layout widget. It takes a single child and positions it
        // in the middle of the parent.
        child: Column(

          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Text(
              'Valor del Scan:',
            ),
            Text(
              _value,
              style: Theme.of(context).textTheme.display1,
            ),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: _incrementCounter,
        tooltip: 'Increment',
        child: Icon(Icons.settings_overscan),
      ), // This trailing comma makes auto-formatting nicer for build methods.
    );
  }
}