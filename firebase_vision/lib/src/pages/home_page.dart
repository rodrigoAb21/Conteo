import 'package:firebase_vision/src/models/eleccion_model.dart';
import 'package:firebase_vision/src/models/participante_model.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

import 'elecciones_page.dart';

class HomePage extends StatefulWidget {
  static final String routeName = 'home';

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  bool _bandera = false;

  List<Widget> _buildHome(BuildContext context) {
    Center principal = new Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          new Hero(
            tag: 'hero',
            child: Padding(
              padding: EdgeInsets.fromLTRB(0.0, 30.0, 0.0, 0.0),
              child: CircleAvatar(
                backgroundColor: Colors.transparent,
                radius: 135.0,
                child: Image.asset('assets/logo.png'),
              ),
            ),
          ),
          new Padding(
              padding: EdgeInsets.fromLTRB(0.0, 125.0, 0.0, 20.0),
              child: SizedBox(
                height: 50.0,
                width: 250.0,
                child: new RaisedButton(
                  elevation: 5.0,
                  shape: new RoundedRectangleBorder(
                      borderRadius: new BorderRadius.circular(15.0)),
                  color: Colors.orange,
                  child: new Text('INICIAR',
                      style:
                          new TextStyle(fontSize: 16.0, color: Colors.white)),
                  onPressed: () {
                    _submit(context);
                  },
                ),
              ))
        ],
      ),
    );

    var l = new List<Widget>();
    l.add(principal);

    if (_bandera) {
      var modal = new Stack(
        children: [
          new Opacity(
            opacity: 0.3,
            child:
                const ModalBarrier(dismissible: false, color: Colors.blueGrey),
          ),
          new Center(
            child: new CircularProgressIndicator(
              valueColor:
                  new AlwaysStoppedAnimation<Color>(Colors.orangeAccent),
            ),
          ),
        ],
      );
      l.add(modal);
    }

    return l;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text("ELECCIONES"),
          centerTitle: true,
          backgroundColor: Colors.orange,
        ),
        body: new Stack(
          children: _buildHome(context),
        ));
  }

  void _submit(BuildContext context) async {
    setState(() {
      _bandera = true;
    });

    final resp = await http.get('http://testsoft.nl/api/elecciones');
    if (resp.statusCode == 200) {
      List<Eleccion> lista = [];
      List<dynamic> decodedResp = convert.jsonDecode(resp.body);
      decodedResp.forEach((item) => lista.add(new Eleccion(
          item['id'],
          item['nombre'],
          _getParticipantes(
              convert.jsonDecode(convert.jsonEncode(item['participantes']))))));

      setState(() {
        _bandera = false;
      });
      Navigator.pushNamed(context, ListaEleccionesPage.routeName,
          arguments: lista);
    }
  }

  List<Participante> _getParticipantes(List<dynamic> decodedResp) {
    List<Participante> participantes = [];
    decodedResp.forEach(
        (item) => participantes.add(Participante(item['id'], item['sigla'])));
    return participantes;
  }
}
