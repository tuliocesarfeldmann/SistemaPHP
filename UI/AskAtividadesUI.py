from tkinter import *

class AskAtividadesUI:
    
    def __init__(self, root, callback) -> None:
        self.frame = Frame(root)

        label = Label(self.frame, wraplength=450, justify=CENTER, text="Qual ou quais são os tipos de atividade que você deseja praticar no destino da sua viagem?\n*(Múltipla escolha)")
        label.pack(padx=10, pady=10)
        
        self.atividades = {"Praias": IntVar(),
                           "Mergulho": IntVar(),
                           "Queda da água": IntVar(),
                           "Passeio de barco": IntVar(),
                           "Gastronomia": IntVar(),
                           "Parques": IntVar(),
                           "Patrimonio Histórico": IntVar(),
                           "Carnaval": IntVar(),
                           "Trilha": IntVar(),
                           "Museus": IntVar(),
                           "Ecoturismo": IntVar(),
                           "Esqui": IntVar(),
                           "Observação de aurora boreal": IntVar(),
                           "Caminhada na neve": IntVar(),
                           "Pesca": IntVar()}
        
        for nomeAtividade in self.atividades:
            checkbox = Checkbutton(self.frame, text=nomeAtividade, variable=self.atividades[nomeAtividade], selectcolor="gray", activebackground="#3c3c3c")
            checkbox.pack(padx=150, pady=2, anchor=W)

        button = Button(self.frame, text="Continuar", command=callback)
        button.pack(padx=10, pady=50)

    def show(self):
        self.frame.pack(expand=True, fill=BOTH)
        self.frame.tkraise()