from ast import List
from Model.Destino import Destino
from Model.PreferenciasUsuario import PreferenciasUsuario

class ProcessarDestinos:
    def __init__(self, destinos: List[Destino]):
        self.destinos = destinos
    
    def buscar_destinos(self, preferencias: PreferenciasUsuario):
        destinos_compativeis = []
        
        for destino in self.destinos:
            if destino.nacionalidade == preferencias.nacionalidade:
                if all(atividade in destino.atividades for atividade in preferencias.atividades):
                    if destino.clima == preferencias.clima:
                        destinos_compativeis.append(destino)
        
        return destinos_compativeis
