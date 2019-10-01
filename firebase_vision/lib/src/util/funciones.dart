import 'package:firebase_vision/src/models/participante_model.dart';

class Funciones {
  static bool buscarSimilitud(String palabra, String nombre) {
    int cont = 0;
    if (palabra.length > nombre.length) {
      for (int i = 0; i < nombre.length; i++) {
        if (nombre[i] == palabra[i]) {
          cont++;
        }
      }
    } else {
      for (int i = 0; i < palabra.length; i++) {
        if (nombre[i] == palabra[i]) {
          cont++;
        }
      }
    }
    return cont >= ((nombre.length ~/ 2) + 1);
  }


  static String limpiarPalabra(String palabra){
    String nueva = '';
    for (var i = 0; i < palabra.length; i++) {
      if(palabra[i] != '.' && palabra[i] != '='){
        nueva = nueva + palabra[i];
      }
    }
    return nueva;
  }

  static int getParticipante(String palabra, List<Participante> participantes) {
    int id = -1;
    int i = 0;
    while (i < participantes.length) {
      if (participantes[i].sigla.contains(palabra.trim())) {
        return participantes[i].id;
      } else if (buscarSimilitud(limpiarPalabra(palabra), participantes[i].sigla)) {
        return participantes[i].id;
      }
      i++;
    }
    return id;
  }

  static int getTotal(String numero) {
    String nuevo = '0';
    for (var i = 0; i < numero.length; i++) {
      try {
        int.parse(numero[i]);
        nuevo = nuevo + numero[i];
      } on Exception catch (e) {
        e.toString();
      }
    }
    if (nuevo.length > 1) return int.parse(nuevo);
    return -1;
  }
}
