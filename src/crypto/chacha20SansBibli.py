def bytesVersEntier (data: bytes) -> int:
    """
    Convertit une valeur binaire en décimale
    :param data: valeur binaire
    :return: Renvoi la valeur de data en décimale el little endian
    """
    if len(data) != 4:
        raise ValueError("data doit être de 4 octets")
    return int.from_bytes(data, byteorder="little")

def bytesVersMots(bits: bytes) -> list[int]:
    """
        Convertit une suite de bytes en liste de valeur entiere en appelant la fonction bytesVersEntier()
        :param bits: suite de bytes
        :return: Renvoi la liste des valeurs entiere 4 par 4 en little endian
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

    v = ((v << n) & 0xFFFFFFFF | (v >> (32 - n)))

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

    a += b & 0xFFFFFFFF
    d ^= a
    rotation(d, 16)

    c += d & 0xFFFFFFFF
    b ^= c
    rotation(b, 12)

    a += b & 0xFFFFFFFF
    d ^= a
    rotation(d, 8)

    c += d & 0xFFFFFFFF
    b ^= c
    rotation(b, 7)

    return a, b, c, d

def entierVersBytes (entier: int) -> bytes:
    """
    Covertit un entier en binaire sous forme d'octets.
    :param entier: nombre à convertir en bytes
    :return: nombre convertit en bytes
    """

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
    print(matrice_etat)
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

def chacha20_encrypt_decrypt(key: bytes, nonce: bytes, mess: bytes) -> bytes:
    """
    Récupère un message en clair ou crypté, appelle la fonction pour générer un flux de cryptage avec la clé, le nonce
    et le compteur générer par la boucle parcourant le message en paramètre de 64 octets en 64 octets

    :param key: suite de bytes de 32 octets
    :param nonce: suite de bytes de 12 octets
    :param mess: message en clair ou message crypté transformer en suite de bytes
    :return: suite de bytes correspondant au message crypté ou au message decrypté
    """
    resultat = bytearray()

    for i in range(0, len(mess), 64):
        bloc_counter = i // 64
        flow = chacha20_block(key, nonce, bloc_counter)
        bloc_message = mess[i:i + 64]

        for j in range(len(bloc_message)):
            resultat.append(bloc_message[j] ^ flow[j])

    return bytes(resultat)

ma_key = b"\x00" * 32 # 32 bytes
mon_nonce = b"\x00" * 12  # 12 bytes
message_clair = "Bonjour, ceci est un test ChaCha20 ! Je suis l'algorythme de crypatage chacha20, je permet de crypter les messages transitant entre le client et le serveur web !!!".encode()

chiffre = chacha20_encrypt_decrypt(ma_key, mon_nonce, message_clair)
print(f"Message chiffré (hex) : {chiffre.hex()}")

dechiffre = chacha20_encrypt_decrypt(ma_key, mon_nonce, chiffre)
print(f"Message déchiffré : {dechiffre.decode()}")