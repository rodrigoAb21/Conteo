import 'package:firebase_vision/src/models/resultado_participante.dart';

class Respuesta {
  int eleccionId;
  int mesaId;
  List<ResultadoParticipante> resultados;

  Respuesta(this.eleccionId, this.mesaId, this.resultados);
}