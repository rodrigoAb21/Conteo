import 'package:firebase_vision/src/models/resultado_participante.dart';

class Respuesta {
  int mesaId;
  List<ResultadoParticipante> resultados;

  Respuesta();

  Map<String, dynamic> toJson() =>
    {
      'mesaId': mesaId,
      'resultados' : resultados
    };

}