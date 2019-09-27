class ResultadoParticipante {
  int id;
  String sigla;
  int total;

  ResultadoParticipante(this.sigla, this.total);

   Map<String, dynamic> toJson() =>
    {
      'id': id,
      'sigla': sigla,
      'total': total,
    };
}