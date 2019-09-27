import 'package:firebase_vision/src/models/participante_model.dart';

class Eleccion {
  int id;
  String nombre;
  List<Participante> participantes;

  Eleccion(this.id, this.nombre, this.participantes);
}