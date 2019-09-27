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
  bool _saving = false;

  List<Widget> _buildForm(BuildContext context) {
    Center principal = new Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          RaisedButton(
            onPressed: () => _submit(context),
            child: Text("TOMAR FOTO"),
            color: Colors.blue,
            textColor: Colors.white,
          ),
        ],
      ),
    );

    var l = new List<Widget>();
    l.add(principal);

    if (_saving) {
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
          children: _buildForm(context),
        ));
  }

  void _submit(BuildContext context) async {
    print('submit called...');

    setState(() {
      _saving = true;
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
        _saving = false;
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
