import os


class Chacha20:

    def __init__(self, message: str, key: bytes = None, nonce: bytes = None):

        self.key = key
        self.nonce = nonce
        self.message = message

        if self.key is None:
            self.key = os.urandom(256)
        if self.nonce is None:
            self.nonce = os.urandom(96)


    def set_message(self, message: str):
        self.message = message
        return

    def set_nonce(self, nonce: bytes = None):
        if nonce is None:
            self.nonce = os.urandom(96)
        else:
            self.nonce = nonce
        return

    def cryptage_chacha20(self):
        message_byts = self.message.encode("utf-8")



if __name__ == "__main__":
    chacha = Chacha20("salut")

