from tkinter import *

class ShowResultadosUI:
    
    def __init__(self, root, resultados) -> None:
        self.frame = Frame(root)

        print(resultados)

        label = Label(self.frame, wraplength=450, justify=CENTER, text="Nós recomendas os seguintes destinos para a sua próxima viagem:")
        label.pack(padx=10, pady=10)
        
        achouDestino = False
        
        for destino in resultados:
            if(destino.taxa_confiabilidade > 60.0):
                achouDestino = True
                destino = Label(self.frame, wraplength=450, justify=CENTER, text=f"{destino.nome_cidade}\nTaxa de confiabilidade: {destino.taxa_confiabilidade:.1f} %")
                destino.pack(padx=10, pady=20)

        if not achouDestino:
            naoAchouLabel = Label(self.frame, wraplength=450, justify=CENTER, text="Desculpe, não conseguimos encontrar nenhum destino de acordo com suas preferências")
            naoAchouLabel.pack(padx=10, pady=20)
            pass
            


    def show(self):
        self.frame.pack(expand=True, fill=BOTH)
        self.frame.tkraise()

    