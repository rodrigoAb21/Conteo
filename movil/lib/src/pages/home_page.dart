import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:movil/src/models/eleccion_model.dart';

import 'elecciones_page.dart';

class HomePage extends StatefulWidget {
  static final String routeName = 'home';
  
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Principal"),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            RaisedButton(
              onPressed: () => _getElecciones(context),
              child: Text("TOMAR FOTO"),
              color: Colors.blue,
              textColor: Colors.white,
            ),
          ],
        ),
      ),
    );
  }

  _getElecciones(BuildContext context) async {
    final resp = await http.get('http://testsoft.nl/api/elecciones');
    if(resp.statusCode == 200){
      List<Eleccion> lista = [];
      List<dynamic> decodedResp = convert.jsonDecode(resp.body);
      decodedResp.forEach((item) => 
        lista.add(
          Eleccion(
            item['id'], 
            item['nombre']
          )
        )
      );
      Navigator.pushNamed(context, ListaEleccionesPage.routeName, arguments: lista);
    }
  }

}