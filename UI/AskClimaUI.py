from tkinter import *

class AskClimaUI:
    
    def __init__(self, root, callback) -> None:
        self.frame = Frame(root)

        label = Label(self.frame, wraplength=450, justify=CENTER, text="Qual o tipo de clima que você prefere para o destino de sua viagem?")
        label.pack(padx=10, pady=10)
        
        self.clima = StringVar(self.frame, value="Tropical")
        optTropical = Radiobutton(self.frame, text="Clima Tropical", variable=self.clima, value="Tropical", selectcolor="gray", activebackground="#3c3c3c")
        optSubtropical = Radiobutton(self.frame, text="Clima Subtropical", variable=self.clima, value="Subtropical", selectcolor="gray", activebackground="#3c3c3c")
        optTemperado = Radiobutton(self.frame, text="Clima Temperado", variable=self.clima, value="Temperado", selectcolor="gray", activebackground="#3c3c3c")
        optFrio = Radiobutton(self.frame, text="Clima Frio", variable=self.clima, value="FRIO", selectcolor="gray", activebackground="#3c3c3c")
        optTropical.pack(padx=150, pady=2, anchor=W)
        optSubtropical.pack(padx=150, pady=2, anchor=W)
        optTemperado.pack(padx=150, pady=2, anchor=W)
        optFrio.pack(padx=150, pady=2, anchor=W)

        button = Button(self.frame, text="Continuar", command=callback)
        button.pack(padx=10, pady=50)

    def show(self):
        self.frame.pack(expand=True, fill=BOTH)
        self.frame.tkraise()