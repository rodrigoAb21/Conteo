import 'package:flutter/material.dart';
import 'package:movil/src/models/eleccion_model.dart';
import 'package:movil/src/pages/qr_page.dart';

class ListaEleccionesPage extends StatelessWidget {


  static final String routeName = 'lista_elecciones';

  @override
  Widget build(BuildContext context) {

    final List<Eleccion> lista = ModalRoute.of(context).settings.arguments;

    return Scaffold(
      appBar: AppBar(
        title: Text('Elecciones'),
        centerTitle: true,
        backgroundColor: Colors.blue,
      ),
      body: ListView(
        children: _cargarLista(context,lista),
      ),
    );
  }

  List<Widget> _cargarLista(BuildContext context, List<Eleccion> lista) {
    List<Widget> list = [];
    for (var item in lista) {
      list.add(ListTile(
        title: Text(item.nombre),
        onTap: (){
          Navigator.pushNamed(context, QrPage.routeName,arguments: item);
        },
        ));
        list.add(Divider());
    }
    return list;
  }
}