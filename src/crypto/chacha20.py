import os


class Chacha20:

    def __init__(self, message: str, key: bytes = None, nonce: bytes = None):

        self.message = message

        if self.key is None:
            self.key = os.urandom(32)
        else:
            if len(self.key) != 32:
                raise ValueError("La clée ne fait pas 256 bits")
            self.key = key

        if self.nonce is None:
            self.nonce = os.urandom(16)
        else:
            if len(self.nonce) != 16:
                raise ValueError("Le nonce ne fait pas 96 bits")
            self.nonce = nonce



    def set_message(self, message: str):
        self.message = message
        return

    def set_nonce(self, nonce: bytes = None):
        if nonce is None:
            self.nonce = os.urandom(96).hex()
        else:
            self.nonce = nonce
        return

    def cryptage_chacha20(self):
        message_byts = self.message.encode("utf-8")




if __name__ == "__main__":
    chacha = Chacha20("salut")

