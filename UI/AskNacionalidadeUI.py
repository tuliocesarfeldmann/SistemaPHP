from tkinter import *

class AskNacionalidadeUI:
    
    def __init__(self, root, callback) -> None:
        self.frame = Frame(root)

        label = Label(self.frame, wraplength=450, justify=CENTER, text="Você deseja viajar para algum lugar dentro do Brasil (Nacional) ou para fora do Brasil (Internacional)?")
        label.pack(padx=10, pady=10)
        
        self.nacionalidade = StringVar(self.frame, value="Nacional")
        radioNacional = Radiobutton(self.frame, text="Viagem Nacional", variable=self.nacionalidade, value="Nacional", selectcolor="gray", activebackground="#3c3c3c")
        radioInternacional = Radiobutton(self.frame, text="Viagem Internacional", variable=self.nacionalidade, value="Internacional", selectcolor="gray", activebackground="#3c3c3c")
        radioNacional.pack(padx=150, pady=2, anchor=W)
        radioInternacional.pack(padx=150, pady=2, anchor=W)

        button = Button(self.frame, text="Continuar", command=callback)
        button.pack(padx=10, pady=50)

    def show(self):
        self.frame.pack(expand=True, fill=BOTH)
        self.frame.tkraise()
