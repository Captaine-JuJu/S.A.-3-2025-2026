def bytesVersEntier (data: bytes) -> int:
    """
    Convertit une valeur binaire en décimale
    :param data: valeur binaire
    :return: Renvoi la valeur de data en décimale el little endian
    """
    if len(data) != 4:
        raise ValueError("data doit être de 4 octets")
    return int.from_bytes(data, byteorder="little")

#TODO: Les trois fonction suivantes sont les mêmes, on peut les fusionner en une. ex : byteVersListMot(data: bytes, taille: int) ->list[int]
def constanteVersEntier():
    const = b"expand 32-byte k"
    mots_32bits = []

    for i in range(0,len(const),4):
        bloc = const[i:i+4]
        ent = bytesVersEntier(bloc)
        mots_32bits.append(ent)

    return mots_32bits

def keyVersEntier(key: bytes) -> list[int]:
    if len(key) != 32:
        raise ValueError("key doit être de 32 octets")
    cle_entier = []

    for i in range(0,len(key),4):
        bloc = key[i:i+4]
        ent = bytesVersEntier(bloc)
        cle_entier.append(ent)

    return cle_entier

def nonceVersEntier(nonce: bytes) -> list[int]:
    if len(nonce) != 12:
        raise ValueError("nonce doit être de 12 octets")

    nonce_entier = []
    for i in range(0,len(nonce),4):
        bloc = nonce[i:i+4]
        ent = bytesVersEntier(bloc)
        nonce_entier.append(ent)

    return nonce_entier


def rotation(v: int, n:int) -> int:
    res = ((v << n) | (v >> (32 - n))) & 0xFFFFFFFF
    return res

def quarter_round(a, b, c, d):

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

def chacha20_round(etat_init: list) -> list:
    init = list(etat_init)
    for i in range(20):

        # Round des colonnes
        init[0], init[4], init[8], init[12] = quarter_round(init[0], init[4], init[8], init[12])
        init[1], init[5], init[9], init[13] = quarter_round(init[1], init[5], init[9], init[13])
        init[2], init[6], init[10], init[14] = quarter_round(init[2], init[6], init[10], init[14])
        init[3], init[7], init[11], init[15] = quarter_round(init[3], init[7], init[11], init[15])

        # Round des diagonales
        init[0], init[5], init[10], init[15] = quarter_round(init[0], init[5], init[10], init[15])
        init[1], init[6], init[11], init[12] = quarter_round(init[1], init[6], init[11], init[12])
        init[2], init[7], init[8], init[13] = quarter_round(init[2], init[7], init[8], init[13])
        init[3], init[4], init[9], init[14] = quarter_round(init[3], init[4], init[9], init[14])

    for i in range(16):
        init[i] = (init[i] + etat_init[i]) & 0xFFFFFFFF

    return init

def entierVersBytes (entier: int) -> bytes:
    """
    Covertit un entier en binaire sous forme d'octets.
    :param entier: nombre à convertir en bytes
    :return: nombre convrtit en bytes
    """
    #renvoie les 4 octets les plus petit
    return entier.to_bytes(4, byteorder="little")

def chacha20_block(key: bytes, nonce:bytes, counter: int) -> bytes:
    const = constanteVersEntier()
    key = keyVersEntier(key)
    nonce = nonceVersEntier(nonce)
    bits = b""
    matrice_etat = const + key + [counter] + nonce
    print(matrice_etat)
    etat_final = chacha20_round(matrice_etat)

    for entier in etat_final:
        bits += entierVersBytes(entier)

    return bits

