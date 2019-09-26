import 'dart:async';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:firebase_ml_vision/firebase_ml_vision.dart';

class QrPage extends StatefulWidget {
  static final String routeName = 'qr_page';
  @override
  _QrPageState createState() => _QrPageState();
}

class _QrPageState extends State<QrPage> {
  File pickedImage;

  bool isImageLoaded = false;

  Future pickImageGallery() async {
    try {
     var tempStore = await ImagePicker.pickImage(source: ImageSource.gallery);
     if (tempStore == null) {
       throw Exception('File is not available');
     } else {
        setState(() {
          pickedImage = tempStore;
          isImageLoaded = true;
        });
     }
    } on Exception catch (e){
      print(e);
    }
  }

  Future pickImageCamera() async {
    try {
     var tempStore = await ImagePicker.pickImage(source: ImageSource.camera);
     if (tempStore == null) {
       throw Exception('File is not available');
     } else {
        setState(() {
          pickedImage = tempStore;
          isImageLoaded = true;
        });
     }
    } on Exception catch (e){
      print(e);
    }
  }

  Future readText() async {
    FirebaseVisionImage ourImage = FirebaseVisionImage.fromFile(pickedImage);
    TextRecognizer recognizeText = FirebaseVision.instance.textRecognizer();
    VisionText readText = await recognizeText.processImage(ourImage);

    for (TextBlock block in readText.blocks) {
      for (TextLine line in block.lines) {
        for (TextElement word in line.elements) {
          print(word.text);
        }
      }
    }
  }

  Future decode() async {
    FirebaseVisionImage ourImage = FirebaseVisionImage.fromFile(pickedImage);
    BarcodeDetector barcodeDetector = FirebaseVision.instance.barcodeDetector();
    List barCodes = await barcodeDetector.detectInImage(ourImage);

    for (Barcode readableCode in barCodes) {
      print(readableCode.displayValue);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          backgroundColor: Colors.blue,
        ),
        body: Column(
          children: <Widget>[
            SizedBox(height: 100.0),
            isImageLoaded
                ? Center(
                    child: Container(
                        height: 200.0,
                        width: 200.0,
                        decoration: BoxDecoration(
                            image: DecorationImage(
                                image: FileImage(pickedImage),
                                fit: BoxFit.cover))),
                  )
                : Container(),
            SizedBox(height: 10.0),
            RaisedButton(
              child: Text('Pick an image'),
              onPressed: pickImageGallery,
            ),
            SizedBox(height: 10.0),
            RaisedButton(
              child: Text('Read Text'),
              onPressed: readText,
            ),
            RaisedButton(
              child: Text('Read Bar Code'),
              onPressed: decode,
            )
          ],
        ));
  }
}
