class ResultadoParticipante {
  int id;
  int total;

  ResultadoParticipante();

   Map<String, dynamic> toJson() =>
    {
      'id': id,
      'total': total
    };
}