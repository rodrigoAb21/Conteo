import 'package:firebase_vision/src/models/participante_model.dart';

class Funciones {
  static bool buscarSimilitud(String palabra, String nombre) {
    int cont = 0;
    for (int i = 0; i < palabra.length; i++) {
      if (nombre.contains(palabra[i])) {
        cont++;
      }
    }
    return cont > 1;
  }

  static int getParticipante(String palabra, List<Participante> participantes) {
    int id = -1;
    int i = 0;
    while(i < participantes.length){
      if (buscarSimilitud(palabra, participantes[i].sigla)) {
        id = participantes[i].id;
        participantes.removeAt(i);
        break;
      }
      i++;
    }
    return id;
  }

  
}
