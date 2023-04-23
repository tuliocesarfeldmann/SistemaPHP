from Model.Destino import Destino
from Enum.Nacionalidade import Nacionalidade
from Enum.Clima import Clima
from Enum.Caracteristica import Caracteristica
from Enum.Atividades import Atividades

DESTINOS = []

DESTINOS.append(Destino("Rio de Janeiro, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.URBANO, [Atividades.PRAIAS, Atividades.GASTRONOMIA, Atividades.MERGULHO, Atividades.TRILHA, Atividades.CARNAVAL]))
DESTINOS.append(Destino("Florianópolis, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.PRAIA, [Atividades.PRAIAS, Atividades.MERGULHO, Atividades.ECOTURISMO, Atividades.TRILHA, Atividades.PARQUES]))
DESTINOS.append(Destino("Foz do Iguaçu, Brasil", Nacionalidade.NACIONAL, Clima.SUBTROPICAL, Caracteristica.NATUREZA, [Atividades.QUEDA_DA_AGUA, Atividades.PATRIMONIO_HISTORICO, Atividades.ECOTURISMO, Atividades.TRILHA]))
DESTINOS.append(Destino("Salvador, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.HISTORICO, [Atividades.MUSEUS, Atividades.GASTRONOMIA, Atividades.CARNAVAL, Atividades.PATRIMONIO_HISTORICO]))
DESTINOS.append(Destino("Ilha Grande, Brasil", Nacionalidade.NACIONAL, Clima.SUBTROPICAL, Caracteristica.PRAIA, [Atividades.PRAIAS, Atividades.TRILHA, Atividades.ECOTURISMO]))
DESTINOS.append(Destino("Curitiba, Brasil", Nacionalidade.NACIONAL, Clima.SUBTROPICAL, Caracteristica.URBANO, [Atividades.PARQUES, Atividades.MUSEUS, Atividades.GASTRONOMIA]))
DESTINOS.append(Destino("Manaus, Brasil", Nacionalidade.NACIONAL, Clima.TROPICAL, Caracteristica.NATUREZA, [Atividades.PASSEIO_DE_BARCO, Atividades.MERGULHO, Atividades.ECOTURISMO, Atividades.PRAIAS, Atividades.PESCA]))
DESTINOS.append(Destino("Cancún, México", Nacionalidade.INTERNACIONAL, Clima.TROPICAL, Caracteristica.URBANO, [Atividades.PRAIAS, Atividades.GASTRONOMIA, Atividades.MERGULHO, Atividades.PATRIMONIO_HISTORICO]))
DESTINOS.append(Destino("Machu Picchu, Peru", Nacionalidade.INTERNACIONAL, Clima.TEMPERADO, Caracteristica.MONTANHA, [Atividades.PATRIMONIO_HISTORICO, Atividades.TRILHA, Atividades.GASTRONOMIA, Atividades.ESQUI]))
DESTINOS.append(Destino("Paris, França", Nacionalidade.INTERNACIONAL, Clima.TEMPERADO, Caracteristica.URBANO, [Atividades.MUSEUS, Atividades.GASTRONOMIA, Atividades.PATRIMONIO_HISTORICO]))
DESTINOS.append(Destino("Bali, Indonésia", Nacionalidade.INTERNACIONAL, Clima.TROPICAL, Caracteristica.NATUREZA, [Atividades.PRAIAS, Atividades.MERGULHO, Atividades.ECOTURISMO, Atividades.TRILHA]))
DESTINOS.append(Destino("Banff, Canadá", Nacionalidade.INTERNACIONAL, Clima.TEMPERADO, Caracteristica.MONTANHA, [Atividades.QUEDA_DA_AGUA, Atividades.TRILHA, Atividades.ECOTURISMO, Atividades.ESQUI, Atividades.CAMINHADA_NA_NEVE]))
DESTINOS.append(Destino("Tromsø, Noruega", Nacionalidade.INTERNACIONAL, Clima.FRIO, Caracteristica.MONTANHA, [Atividades.ESQUI, Atividades.OBSERVACAO_DE_AURORA_BOREAL]))
DESTINOS.append(Destino("Bariloche, Argentina", Nacionalidade.INTERNACIONAL, Clima.FRIO, Caracteristica.MONTANHA, [Atividades.ESQUI, Atividades.CAMINHADA_NA_NEVE, Atividades.PASSEIO_DE_BARCO]))