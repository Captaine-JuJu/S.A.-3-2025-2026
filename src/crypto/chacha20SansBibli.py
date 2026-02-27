def bytesVersEntier (data: bytes) -> int:
    """
    Convertit une valeur binaire en décimale
    :param data: valeur binaire
    :return: Renvoi la valeur de data en décimale el little endian
    """
    if len(data) != 4:
        raise ValueError("data doit être de 4 octets")
    return int.from_bytes(data, byteorder="little")

# def constanteVersEntier():
#     const = b"expand 32-byte k"
#     mots_32bits = []
#
#     for i in range(0,len(const),4):
#         bloc = const[i:i+4]
#         ent = bytesVersEntier(bloc)
#         mots_32bits.append(ent)
#
#     return mots_32bits
#
# def keyVersEntier(key: bytes) -> list[int]:
#     if len(key) != 32:
#         raise ValueError("key doit être de 32 octets")
#     cle_entier = []
#
#     for i in range(0,len(key),4):
#         bloc = key[i:i+4]
#         ent = bytesVersEntier(bloc)
#         cle_entier.append(ent)
#
#     return cle_entier
#
# def nonceVersEntier(nonce: bytes) -> list[int]:
#     if len(nonce) != 12:
#         raise ValueError("nonce doit être de 12 octets")
#
#     nonce_entier = []
#     for i in range(0,len(nonce),4):
#         bloc = nonce[i:i+4]
#         ent = bytesVersEntier(bloc)
#         nonce_entier.append(ent)
#
#     return nonce_entier

def bytesVersMots(bits: bytes) -> list[int]:
    """
        Convertit une suite de bytes en liste de valeur entiere en appelant la fonction bytesVersEntier()
        :param bits: suite de bytes
        :return: Renvoi la liste des valeur entiere 4 par 4 en little endian
        """
    mots = []

    for i in range(0, len(bits), 4):
        bloc = bits[i:i + 4]
        ent = bytesVersEntier(bloc)
        mots.append(ent)

    return mots


def rotation(v: int, n:int) -> int:
    """
        Effectue une rotation circulaire a gauche sur 32 bits
        :param v: entier de 32 bits a faire circuler
        :param n: nombre de bits de rotation
        :return: renvoie l'entier de 32bits après rotation de n bits
    """

    return ((v << n) & 0xFFFFFFFF | (v >> (32 - n)))

# def quarter_round(a, b, c, d):
#     a = (a + b) & 0xffffffff; d ^= a; d = ((d << 16) & 0xffffffff) | (d >> 16)
#     c = (c + d) & 0xffffffff; b ^= c; b = ((b << 12) & 0xffffffff) | (b >> 20)
#     a = (a + b) & 0xffffffff; d ^= a; d = ((d << 8) & 0xffffffff) | (d >> 24)
#     c = (c + d) & 0xFFFF; b ^= c; b = ((b << 7) & 0xffffffff) | (b >> 25)
#     return a, b, c, d

def quarter_round(a, b, c, d):
    """
        Effectue un quarter round de ChaCha20 sur quatre mots de 32 bits
        en appliquant des additions modulo 2^32, des XOR et des rotations
        circulaires afin de mélanger les valeurs.

        :param a: premier mot de 32 bits
        :param b: deuxième mot de 32 bits
        :param c: troisième mot de 32 bits
        :param d: quatrième mot de 32 bits
        :return: renvoie les quatre mots de 32 bits après transformation
    """

    a = (a + b) & 0xFFFFFFFF
    d = d ^ a
    d = rotation(d, 16)

    c = (c + d) & 0xFFFFFFFF
    b = b ^ c
    b = rotation(b, 12)

    a = (a + b) & 0xFFFFFFFF
    d = d ^ a
    d = rotation(d, 8)

    c = (c + d) & 0xFFFFFFFF
    b = b ^ c
    b = rotation(b, 7)

    return a, b, c, d

# def chacha20_round(etat_init: list) -> list:
#     matrice_utile = list(etat_init)
#     for i in range(10):
#
#         # Round des colonnes
#         matrice_utile[0], matrice_utile[4], matrice_utile[8], matrice_utile[12] = quarter_round(matrice_utile[0], matrice_utile[4], matrice_utile[8], matrice_utile[12])
#         matrice_utile[1], matrice_utile[5], matrice_utile[9], matrice_utile[13] = quarter_round(matrice_utile[1], matrice_utile[5], matrice_utile[9], matrice_utile[13])
#         matrice_utile[2], matrice_utile[6], matrice_utile[10], matrice_utile[14] = quarter_round(matrice_utile[2], matrice_utile[6], matrice_utile[10], matrice_utile[14])
#         matrice_utile[3], matrice_utile[7], matrice_utile[11], matrice_utile[15] = quarter_round(matrice_utile[3], matrice_utile[7], matrice_utile[11], matrice_utile[15])
#
#         # Round des diagonales
#         matrice_utile[0], matrice_utile[5], matrice_utile[10], matrice_utile[15] = quarter_round(matrice_utile[0], matrice_utile[5], matrice_utile[10], matrice_utile[15])
#         matrice_utile[1], matrice_utile[6], matrice_utile[11], matrice_utile[12] = quarter_round(matrice_utile[1], matrice_utile[6], matrice_utile[11], matrice_utile[12])
#         matrice_utile[2], matrice_utile[7], matrice_utile[8], matrice_utile[13] = quarter_round(matrice_utile[2], matrice_utile[7], matrice_utile[8], matrice_utile[13])
#         matrice_utile[3], matrice_utile[4], matrice_utile[9], matrice_utile[14] = quarter_round(matrice_utile[3], matrice_utile[4], matrice_utile[9], matrice_utile[14])
#
#     return matrice_utile

def entierVersBytes (entier: int) -> bytes:
    """
    Covertit un entier en binaire sous forme d'octets.
    :param entier: nombre à convertir en bytes
    :return: nombre convertit en bytes
    """
    #renvoie les 4 octets les plus petit
    return entier.to_bytes(4, byteorder="little")

def chacha20_block(key: bytes, nonce:bytes, counter: int) -> bytes:
    """
        Génère un bloc de 64 octets du flot ChaCha20 à partir d'une clé,
        d'un nonce et d'un compteur. Initialise l'état interne (constante,
        clé, compteur, nonce), applique 20 rounds (10 doubles rounds :
        colonnes puis diagonales), puis additionne l'état final à l'état
        initial avant conversion en bytes (little endian).

        :param key: clé secrète de 32 octets
        :param nonce: nonce de 12 octets
        :param counter: compteur de bloc (entier 32 bits)
        :return: renvoie le bloc de flot ChaCha20 de 64 octets
    """

    const = bytesVersMots(b'expand 32-byte k')
    key = bytesVersMots(key)
    nonce = bytesVersMots(nonce)

    matrice_etat = const + key + [counter] + nonce
    matrice_utile = list(matrice_etat)

    for i in range(10):
        matrice_utile[0], matrice_utile[4], matrice_utile[8], matrice_utile[12] = quarter_round(matrice_utile[0],
                                                                                                matrice_utile[4],
                                                                                                matrice_utile[8],
                                                                                                matrice_utile[12])
        matrice_utile[1], matrice_utile[5], matrice_utile[9], matrice_utile[13] = quarter_round(matrice_utile[1],
                                                                                                matrice_utile[5],
                                                                                                matrice_utile[9],
                                                                                                matrice_utile[13])
        matrice_utile[2], matrice_utile[6], matrice_utile[10], matrice_utile[14] = quarter_round(matrice_utile[2],
                                                                                                 matrice_utile[6],
                                                                                                 matrice_utile[10],
                                                                                                 matrice_utile[14])
        matrice_utile[3], matrice_utile[7], matrice_utile[11], matrice_utile[15] = quarter_round(matrice_utile[3],
                                                                                                 matrice_utile[7],
                                                                                                 matrice_utile[11],
                                                                                                 matrice_utile[15])

        # Round des diagonales
        matrice_utile[0], matrice_utile[5], matrice_utile[10], matrice_utile[15] = quarter_round(matrice_utile[0],
                                                                                                 matrice_utile[5],
                                                                                                 matrice_utile[10],
                                                                                                 matrice_utile[15])
        matrice_utile[1], matrice_utile[6], matrice_utile[11], matrice_utile[12] = quarter_round(matrice_utile[1],
                                                                                                 matrice_utile[6],
                                                                                                 matrice_utile[11],
                                                                                                 matrice_utile[12])
        matrice_utile[2], matrice_utile[7], matrice_utile[8], matrice_utile[13] = quarter_round(matrice_utile[2],
                                                                                                matrice_utile[7],
                                                                                                matrice_utile[8],
                                                                                                matrice_utile[13])
        matrice_utile[3], matrice_utile[4], matrice_utile[9], matrice_utile[14] = quarter_round(matrice_utile[3],
                                                                                                matrice_utile[4],
                                                                                                matrice_utile[9],
                                                                                                matrice_utile[14])
    resultat = b""
    for j in range(16):
        somme = (matrice_utile[j] + matrice_etat[j]) & 0xFFFFFFFF
        resultat += somme.to_bytes(4, byteorder="little")

    return resultat

key = b"\x00" * 32
nonce = b"\x00" * 12
counter = 1
res=chacha20_block(key, nonce, counter)
print(res.hex())

# b = b"\x01\x00\x00\x00"
# res = bytesVersEntier(b)
# print(res)
