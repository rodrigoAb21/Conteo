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
          RaisedButton(
            onPressed: () => _submit(context),
            child: Text("EMPEZAR"),
            color: Colors.blue,
            textColor: Colors.white,
          ),
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
          title: Text("Principal"),
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
