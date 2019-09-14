import 'package:flutter/material.dart';

import 'package:movil/src/pages/elecciones_page.dart';
import 'package:movil/src/pages/qr_page.dart';
import 'src/pages/home_page.dart';

void main() {
  runApp(MyApp());
}
 
class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Material App',
      debugShowCheckedModeBanner: false,
      initialRoute: 'home',
      routes: {
        HomePage.routeName : ( BuildContext context ) => HomePage(),
        ListaEleccionesPage.routeName : ( BuildContext context ) => ListaEleccionesPage(),
        QrPage.routeName : ( BuildContext context ) => QrPage(),
      },
    );
  }
}