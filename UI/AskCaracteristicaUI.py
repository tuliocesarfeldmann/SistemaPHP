from tkinter import *

class AskCaracteristicaUI:
    
    def __init__(self, root, callback) -> None:
        self.frame = Frame(root)

        label = Label(self.frame, wraplength=450, justify=CENTER, text="Qual é o tipo de lugar para o qual você deseja viajar?")
        label.pack(padx=10, pady=10)
        
        self.caracteristica = StringVar(self.frame, value="Urbano")
        optUrbano = Radiobutton(self.frame, text="Urbano", variable=self.caracteristica, value="Urbano", selectcolor="gray", activebackground="#3c3c3c")
        optPraia = Radiobutton(self.frame, text="Praia", variable=self.caracteristica, value="Praia", selectcolor="gray", activebackground="#3c3c3c")
        optNatureza = Radiobutton(self.frame, text="Natureza", variable=self.caracteristica, value="Natureza", selectcolor="gray", activebackground="#3c3c3c")
        optMontanha = Radiobutton(self.frame, text="Montanha", variable=self.caracteristica, value="Montanha", selectcolor="gray", activebackground="#3c3c3c")
        optHistorico = Radiobutton(self.frame, text="Histórico", variable=self.caracteristica, value="Histórico", selectcolor="gray", activebackground="#3c3c3c")
        optUrbano.pack(padx=150, pady=2, anchor=W)
        optPraia.pack(padx=150, pady=2, anchor=W)
        optNatureza.pack(padx=150, pady=2, anchor=W)
        optMontanha.pack(padx=150, pady=2, anchor=W)
        optHistorico.pack(padx=150, pady=2, anchor=W)

        button = Button(self.frame, text="Continuar", command=callback)
        button.pack(padx=10, pady=50)

    def show(self):
        self.frame.pack(expand=True, fill=BOTH)
        self.frame.tkraise()