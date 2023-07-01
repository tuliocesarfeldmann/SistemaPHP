class ProcessarDestinos:
    def __init__(self, destinos):
        self.destinos = destinos
    
    def buscar_destinos(self, preferencias):
        destinos_compativeis = []
        confiabilidade = 0

        # Percorre todos os destinos buscando os com maior confiabilidade
        for destino in self.destinos:
            if destino.nacionalidade == preferencias.nacionalidade:
                confiabilidade += 25

                if destino.caracteristica == preferencias.caracteristica:
                    confiabilidade += 25

                if destino.clima == preferencias.clima:
                    confiabilidade += 25

                atividades_comuns = set(destino.atividades).intersection(preferencias.atividades)

                if all(atividade in destino.atividades for atividade in preferencias.atividades):
                    confiabilidade += 25
                elif len(atividades_comuns) > 0:
                    confiabilidade += (len(atividades_comuns) * 25) / len(preferencias.atividades)


            if(confiabilidade > 0):
                destino.taxa_confiabilidade = confiabilidade
                destinos_compativeis.append(destino)

            confiabilidade = 0

        # Ordena os destinos compatíveis por maior taxa de confiabilidade
        destinos_compativeis.sort(key=lambda d: d.taxa_confiabilidade, reverse=True)

        return destinos_compativeis
