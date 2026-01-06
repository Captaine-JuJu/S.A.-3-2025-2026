import os


class Chacha20:

    def __init__(self, key: bytes = None, nonce: bytes = None, message: str = None):
        self.key = key
        self.nonce = nonce
        self.message = message
        if self.key is None:
            self.key = os.urandom(256)


    def set_message(self, message: str):
        self.message = message
        return

    def set_nonce(self, nonce: bytes = None):
        if nonce is None:
            self.nonce = os.urandom(96)
        else:
            self.nonce = nonce
        return