from tkinter import *

from UI.AskNacionalidadeUI import AskNacionalidadeUI
from UI.AskClimaUI import AskClimaUI
from UI.AskCaracteristicaUI import AskCaracteristicaUI
from UI.AskAtividadesUI import AskAtividadesUI
from UI.ShowResultadosUI import ShowResultadosUI
from Enum.Nacionalidade import Nacionalidade
from Enum.Clima import Clima
from Enum.Caracteristica import Caracteristica
from Enum.Atividades import Atividades
from Model.PreferenciasUsuario import PreferenciasUsuario
from Business.ProcessarDestinos import ProcessarDestinos
from Dados.Destinos import DESTINOS

class App():

    # Root do TK
    root: Tk

    # Páginas de interface
    askNacionalidadeUI: AskNacionalidadeUI
    askClimaUI: AskClimaUI
    askCaracteristicaUI: AskCaracteristicaUI
    askAtividadesUI: AskAtividadesUI
    showResultadosUI: ShowResultadosUI

    # Resultados de cada etapa
    nacionalidade : Nacionalidade
    clima: Clima
    caracteristica: Caracteristica
    atividades: list[Atividades]

    def __init__(self) -> None:
        self.root = Tk()
        self._configureApp(self.root)
        self._prepareInterfaces(self.root)

        self.askNacionalidadeUI.show()

        self.root.mainloop()

    def _configureApp(self, root: Tk):
        root.minsize(500, 300)
        root.resizable(False, True)
        root.title("Recomendador de Viagens Supremo")
        root.configure(background="#3c3c3c", padx=10, pady=10)
        root.option_add("*background", '#4f4f4f')
        root.option_add("*foreground", 'white')
        root.option_add("*font", '20')

    def _prepareInterfaces(self, root):
        self.askNacionalidadeUI = AskNacionalidadeUI(root, self.submitNacionalidadeCallback)
        self.askClimaUI = AskClimaUI(root, self.submitClimaCallback)
        self.askCaracteristicaUI = AskCaracteristicaUI(root, self.submitCaracteristicaCallback)
        self.askAtividadesUI = AskAtividadesUI(root, self.submitAtividadesCallback)

    def submitNacionalidadeCallback(self):
        self.nacionalidade = Nacionalidade(self.askNacionalidadeUI.nacionalidade.get())
        print(self.nacionalidade)

        self.askNacionalidadeUI.frame.destroy()
        self.askClimaUI.show()

    def submitClimaCallback(self):
        self.clima = Clima(self.askClimaUI.clima.get())
        print(self.clima)

        self.askClimaUI.frame.destroy()
        self.askCaracteristicaUI.show()

    def submitCaracteristicaCallback(self):
        self.caracteristica = Caracteristica(self.askCaracteristicaUI.caracteristica.get())
        print(self.caracteristica)

        self.askCaracteristicaUI.frame.destroy()
        self.askAtividadesUI.show()

    def submitAtividadesCallback(self):
        listaAtividades = []
        for atividade in self.askAtividadesUI.atividades:
            isSelected = self.askAtividadesUI.atividades[atividade].get()
            if(isSelected):
                listaAtividades.append(Atividades(atividade))
        self.atividades = listaAtividades
        
        for atividade in self.atividades:
            print(atividade)

        self.askAtividadesUI.frame.destroy()
        self.showResultados()

    def showResultados(self): 
        preferenciasUsuario = PreferenciasUsuario(self.nacionalidade, self.clima, self.caracteristica, self.atividades)

        resultados = ProcessarDestinos(DESTINOS).buscar_destinos(preferenciasUsuario)
        self.showResultadosUI = ShowResultadosUI(self.root, resultados)
        self.showResultadosUI.show()

