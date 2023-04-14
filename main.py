from Model.Destino import Destino
from Model.PreferenciasUsuario import PreferenciasUsuario
from Enum.Nacionalidade import Nacionalidade
from Enum.Clima import Clima
from Enum.Caracteristica import Caracteristica
from Enum.Atividades import Atividades
from Business.ProcessarDestinos import ProcessarDestinos

def main():

    destinos = []

    destinos.append(Destino("Rio de Janeiro, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.URBANO, [Atividades.PRAIAS, Atividades.GASTRONOMIA, Atividades.MERGULHO, Atividades.TRILHA, Atividades.CARNAVAL]))
    destinos.append(Destino("Florianópolis, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.PRAIA, [Atividades.PRAIAS, Atividades.MERGULHO, Atividades.ECOTURISMO, Atividades.TRILHA]))
    destinos.append(Destino("Foz do Iguaçu, Brasil", Nacionalidade.NACIONAL, Clima.SUBTROPICAL, Caracteristica.NATUREZA, [Atividades.QUEDA_DA_AGUA, Atividades.PATRIMONIO_HISTORICO, Atividades.ECOTURISMO, Atividades.TRILHA]))
    destinos.append(Destino("Salvador, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.HISTORICO, [Atividades.MUSEUS, Atividades.GASTRONOMIA, Atividades.CARNAVAL, Atividades.PATRIMONIO_HISTORICO]))
    destinos.append(Destino("Ilha Grande, Brasil", Nacionalidade.NACIONAL, Clima.SUBTROPICAL, Caracteristica.PRAIA, [Atividades.PRAIAS, Atividades.TRILHA, Atividades.ECOTURISMO]))
    destinos.append(Destino("Cancún, México", Nacionalidade.INTERNACIONAL, Clima.TROPICAL, Caracteristica.URBANO, [Atividades.PRAIAS, Atividades.GASTRONOMIA, Atividades.MERGULHO, Atividades.PATRIMONIO_HISTORICO]))
    destinos.append(Destino("Machu Picchu, Peru", Nacionalidade.INTERNACIONAL, Clima.TROPICAL, Caracteristica.MONTANHA, [Atividades.PATRIMONIO_HISTORICO, Atividades.TRILHA, Atividades.GASTRONOMIA, Atividades.ESQUI]))
    destinos.append(Destino("Paris, França", Nacionalidade.INTERNACIONAL, Clima.TEMPERADO, Caracteristica.URBANO, [Atividades.MUSEUS, Atividades.GASTRONOMIA, Atividades.PATRIMONIO_HISTORICO]))
    destinos.append(Destino("Bali, Indonésia", Nacionalidade.INTERNACIONAL, Clima.TROPICAL, Caracteristica.NATUREZA, [Atividades.PRAIAS, Atividades.MERGULHO, Atividades.ECOTURISMO, Atividades.TRILHA]))
    destinos.append(Destino("Banff, Canadá", Nacionalidade.INTERNACIONAL, Clima.TEMPERADO, Caracteristica.MONTANHA, [Atividades.QUEDA_DA_AGUA, Atividades.TRILHA, Atividades.ECOTURISMO, Atividades.ESQUI]))

    preferencias_usuario = PreferenciasUsuario(Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.PRAIA, [Atividades.PRAIAS, Atividades.MERGULHO])

    destinos = ProcessarDestinos(destinos).buscar_destinos(preferencias_usuario)

    print(destinos)

if __name__ == '__main__':
    main()
