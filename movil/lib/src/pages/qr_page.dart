import 'package:flutter/material.dart';
import 'package:qr_code_scanner/qr_code_scanner.dart';
import 'package:qr_code_scanner/qr_scanner_overlay_shape.dart';

class QrPage extends StatefulWidget {
  static final String routeName = 'qr_page';
  QrPage({Key key}) : super(key: key);

  _QrPageState createState() => _QrPageState();
}

class _QrPageState extends State<QrPage> {
  GlobalKey qrKey = GlobalKey();
  var qrText = "";
  QRViewController controller;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("QR SCAN"),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Expanded(
              flex: 5,
              child: QRView(key: qrKey,overlay: QrScannerOverlayShape(
                borderRadius: 10,
                borderColor: Colors.red,
                borderWidth: 10,
                borderLength: 30,
                cutOutSize: 300,
              ), onQRViewCreated: _onQRViewCreate),
            ),
            Expanded(
              flex: 1,
              child: Text('Scan Result: $qrText'),
            )
          ],
        ),
      ),
    );
  }

  @override
  void dispose() {
    controller?.dispose();
    super.dispose();
  }

  void _onQRViewCreate(QRViewController controller) {
    this.controller = controller;
    controller.scannedDataStream.listen((scanData) {
      setState(() {
        qrText = scanData;
      });

    });
  }
}