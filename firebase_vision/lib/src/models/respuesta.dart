import 'package:firebase_vision/src/models/resultado_participante.dart';

class Respuesta {
  int eleccionId;
  int mesaId;
  List<ResultadoParticipante> resultados;

  Respuesta();

  Map<String, dynamic> toJson() =>
    {
      'eleccionId': eleccionId,
      'mesaId': mesaId,
      'resultados' : resultados
    };

}