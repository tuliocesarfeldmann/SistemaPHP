class Destino:
    def __init__(self, nome_cidade, nacionalidade, clima, caracteristica, atividades):
        self.nome_cidade = nome_cidade
        self.nacionalidade = nacionalidade
        self.clima = clima
        self.caracteristica = caracteristica
        self.atividades = atividades
        self.taxa_confiabilidade = 0

    def __repr__(self):
        return f"Destino(nome_cidade={self.nome_cidade}, taxa_confiabilidade={self.taxa_confiabilidade}, nacionalidade={self.nacionalidade}, clima={self.clima}, caracteristica={self.caracteristica}, atividades={self.atividades})\n\n"