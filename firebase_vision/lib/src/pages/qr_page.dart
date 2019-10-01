import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:firebase_vision/src/models/eleccion_model.dart';
import 'package:firebase_vision/src/models/participante_model.dart';
import 'package:firebase_vision/src/models/respuesta.dart';
import 'package:firebase_vision/src/models/resultado_participante.dart';
import 'package:firebase_vision/src/util/funciones.dart';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:firebase_ml_vision/firebase_ml_vision.dart';
import 'package:http/http.dart' as http;

class QrPage extends StatefulWidget {
  static final String routeName = 'qr_page';
  @override
  _QrPageState createState() => _QrPageState();
}

class _QrPageState extends State<QrPage> {
  File pickedImage;
  bool isImageLoaded = false;
  Respuesta respuesta;
  List<ResultadoParticipante> resultados;

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
    } on Exception catch (e) {
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
    } on Exception catch (e) {
      print(e);
    }
  }

  int devolverId(String sigla, List<Participante> participantes) {
    participantes.forEach((participante) {
      if (participante.sigla.contains(sigla)) {
        return participante.id;
      }
    });
    return -1;
  }

  showAlertDialog(BuildContext context) {
    // set up the AlertDialog
    AlertDialog alert = AlertDialog(
      title: Text("UPS!"),
      content: Text("No se pudo leer el QR.\nPor favor utilice otra foto."),
    );
    // show the dialog
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return alert;
      },
    );
  }

  extraerDatos(Eleccion eleccion, BuildContext context) async {
    if (isImageLoaded) {
      respuesta = new Respuesta();
      resultados = new List();

      // QR
      FirebaseVisionImage ourImage = FirebaseVisionImage.fromFile(pickedImage);
      BarcodeDetector barcodeDetector =
          FirebaseVision.instance.barcodeDetector();
      List barCodes = await barcodeDetector.detectInImage(ourImage);

      for (Barcode readableCode in barCodes) {
        try {
          respuesta.mesaId = int.parse(readableCode.displayValue);
        } on Exception catch (e) {
          print(e);
        }
      }

      if (respuesta.mesaId != null && respuesta.mesaId > 0) {
        // TEXTO
        TextRecognizer recognizeText = FirebaseVision.instance.textRecognizer();
        VisionText readText = await recognizeText.processImage(ourImage);

        for (TextBlock block in readText.blocks) {
          print("----------BLOQUE------------");
          for (TextLine line in block.lines) {
            print("----------LINEA------------");
            ResultadoParticipante resultado = new ResultadoParticipante();
            bool sw1, sw2 = false;
            
            for (int i = 0; i < line.elements.length; i++) {
              // buscando participante
              if (i == 0) {
                int id = Funciones.getParticipante(
                    line.elements[i].text, eleccion.participantes);
                if (id >= 0) {
                  resultado.id = id;
                  sw1 = true;
                }
              } else {
                //buscando numero
                int total = Funciones.getTotal(line.elements[i].text);
                if (sw2 == false && total >= 0) {
                  resultado.total = total;
                  sw2 = true;
                }
              }
              print(line.elements[i].text);
            }

            //agregando item a resultados
            if (sw1 == true && sw2 == true) {
              resultados.add(resultado);
            }
          }
        }
        print('Total de resultados encontrados: ${resultados.length}');
      } else {
        showAlertDialog(context);
      }
    }
  }

  enviar() async {
    if (resultados.length > 0) {
      respuesta.resultados = resultados;
      print(jsonEncode(respuesta));

      final resp = await http.post('http://testsoft.nl/api/resultados',
          body: jsonEncode(respuesta),
          headers: {"Content-Type": "application/json"});
      if (resp.statusCode == 200) {
        print('OK!');
      } else {
        print(resp.statusCode);
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    Eleccion eleccion = ModalRoute.of(context).settings.arguments;

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
              child: Text('TOMAR FOTO'),
              onPressed: pickImageCamera,
              color: Colors.blue,
              textColor: Colors.white,
            ),
            SizedBox(height: 10.0),
            RaisedButton(
              child: Text('SELECCIONAR DE GALERIA'),
              onPressed: pickImageGallery,
              color: Colors.blue,
              textColor: Colors.white,
            ),
            SizedBox(height: 10.0),
            RaisedButton(
              child: Text('EXTRAER DATOS'),
              onPressed: () {
                extraerDatos(eleccion, context);
              },
              color: Colors.blue,
              textColor: Colors.white,
            ),
            RaisedButton(
              child: Text('ENVIAR'),
              onPressed: enviar,
              color: Colors.blue,
              textColor: Colors.white,
            )
          ],
        ));
  }
}
