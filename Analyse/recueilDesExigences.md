# Recueil des Exigences 

## Objectif et portée



## Terminologie employée

Les définitions suivantes se rapportent à des termes employé dans le cahier des charges :

**Parc informatique** : Un parc informatique regroupe l’ensemble du matériel et des logiciels composant le système informatique d’une entreprise.

**Plateforme Web** : structure numérique permettant la gestion d'applications web.

**Liste rebut** : Liste qui recense l’ensemble des équipements informatiques destinés à être retirés de l’inventaire.

**IDE** : application logiciel regroupant tous les outils nécessaires lors du développement informatique d’un système.


## Cas d’utilisation
**Cas d’utilisation métier :** \
**Nom :**  Enregistrement d’un produit \
**Portée :** Boite noire \
**Niveau :** Mer \
**Acteur principaux :** Technicien, Logiciel 

<ins>Précondition :</ins>
* le technicien est authentifié dans le système
* Le technicien accède à l’inventaire.

<ins>Scénario nominal :</ins>

1. Le technicien ajoute un écran, pour cela il renseigne : le numéros de série, le fabricant, le modèle, la taille et le type de connecteur.
2. Le technicien consulte l’inventaire et l’écran est bien affiché.

<ins>Scénario alternatif :</ins> Numéros de série déjà enregistré

* Le logiciel affiche un message d’erreur indiquant que le numéros de série est déjà pris.
* Le technicien consulte l'inventaire et l’écran qu’il voulait ajouter n’est pas répertorié.

<ins>Scénario alternatif :</ins> Enregistrement d’une Unité Central (UC)

* Le technicien ajoute une UC, pour cela il renseigne : le nom du produit, le numéro de série, le fabricant, le modèle, la taille, le type, unité central de traitement, la capacité de la mémoire vive, la capacité du disque dure, le système d’exploitation, le domaine, la location, le bâtiment de stockage, la pièce de stockage, type du DDR, la date d’achat et la date de la fin de la garantie.
* Le technicien consulte l'inventaire et l’écran est bien affiché.


\
**Nom :** Cas d’utilisation métier : Ajout d’un nouveau technicien \
**Portée :** Boite noire \
**Niveau :** Poisson \
**Acteur principaux :** Administrateur web, Logiciel, Technicien 

<ins>Précondition :</ins>
* L’administrateur web est authentifié dans le système
* L’administrateur accède à la liste des techniciens.

<ins>Scénario nominal :</ins>

1. L'administrateur crée un nouveau profil technicien en ajoutant un nouvel identifiant associé à un nouveau mot de passe.
2. Le nouveau technicien apparaît sur l’interface.

<ins>Scénario alternatif :</ins> Identifiant déjà pris
	
* L'administrateur crée un nouveau profil technicien en ajoutant un nouvel identifiant associé à un nouveau mot de passe.
* Un message d’erreur apparaît, l’identifiant est déjà utilisé ou le format des informations ne sont pas valide.
* Le nouveaux profil n’apparait pas dans l’interface

\
**Nom :** Cas d’utilisation métier : Connexion \
**Portée :** Boite noire \
**Niveau :** Nuage \
**Acteur principaux :** Visiteur

<ins>Précondition :</ins>
* Le visiteur se connecte au site et regarde la vidéo ainsi qu’une partie de l’inventaire.

<ins>Scénario nominal :</ins>
1. Le visiteur s’identifie en renseignant son identifiant et son mot de passe pour passer en technicien.
2. Le visiteur consulte la totalité de l'inventaire.

<ins>Scénario alternatif :</ins> Mot de passe ou identifiant invalide
* Le visiteur ne parvient pas à s’identifier, par conséquent un message d'erreur apparaît .
* Le visiteur n'acquiert aucun droit supplémentaire.

## Technologie employée

Le serveur sera hébergé sur un raspBerry Pi 4 fourni par le département Informatique. Le projet sera développé en PHP, HTML, CSS et SQL. Le code source du projet ainsi que sa documentation doivent être disponibles sur Github. 

## Autres exigences

## Facteurs humains



