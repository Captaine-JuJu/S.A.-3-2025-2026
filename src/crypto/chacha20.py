import os

import algorithms
from cryptography.hazmat.primitives.ciphers import Cipher, algorithms
from cryptography.hazmat.backends import default_backend


class Chacha20AvecBibli:

    def __init__(self, message_a_crypt: str, key: bytes = None, nonce: bytes = None):

        self.message = message_a_crypt

        if key is None:
            self.key = os.urandom(32)
        else:
            if len(key) != 32:
                raise ValueError("La clée ne fait pas 256 bits")
            self.key = key

        if nonce is None:
            self.nonce = os.urandom(16)
        else:
            if len(nonce) != 16:
                raise ValueError("Le nonce ne fait pas 96 bits")
            self.nonce = nonce


    def set_message(self, new_message: str):
        """Redéfinit le message à chiffrer"""
        self.message = new_message

    def set_nonce(self, nonce: bytes = None):
        """Redéfinit le nonce"""
        if nonce is None:
            self.nonce = os.urandom(96).hex()
        else:
            self.nonce = nonce

    def cryptage_chacha20(self):
        """Crypte un message en chacha20"""
        message_bytes = self.message.encode("utf-8")

        algo = algorithms.ChaCha20(self.key, self.nonce)

        cipher = Cipher(algo, mode=None, backend=default_backend())
        encrypt = cipher.encryptor()

        return encrypt.update(message_bytes) + encrypt.finalize()


    def decrypt_chacha20(self, message_chiffre: bytes) -> str:
        """
        Décrypte un mot binaire avec la méthode chacha20
        :param message_chiffre: Message binaire à décripter
        :return: message décripter
        """
        algo = algorithms.ChaCha20(self.key, self.nonce)

        cipher = Cipher(algo, mode=None, backend=default_backend())
        decrypt = cipher.encryptor()

        message_claire = decrypt.update(message_chiffre) + decrypt.finalize()

        return message_claire.decode('utf-8')


if __name__ == "__main__":
    chacha = Chacha20AvecBibli("salut")
    message_crypt = chacha.cryptage_chacha20()
    print(message_crypt)
    message = chacha.decrypt_chacha20(message_crypt)
    print(message)

