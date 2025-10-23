Liste de questions afin de clarifier les exigences :

* Quelle partie de l'inventaire doit être affiché pour les utlisateurs non-identifiés ? 
  - Le groupe choisit le paramètre qui va définir quelles objet de l'inventaire sera afficher à l'utilisateur non-identifié.
* Quelle informations doivent identifier un utilisateur ?
  - Login et mot de passe (chiffré)
* L'administrateur web peut bloquer la liste rebut sur un interval de temps ou jusqu'à nouvel ordre ?
  - Le bloquage d'une liste rebut est définitive. Une fois la liste rebut bloquer, il faut en créer une autre. Tant que la liste rebut n'est pas bloquer, on peut ajouter ou supprimer des éléments pour les réinsérer dans l'inventaire.
* L'administrateur web possède-t-il les droits des techniciens en plus des siens ?
  - Oui
* La caractéristique ATTACHED_TO des écrans correspond à quelle information ?
  - ATTACHED_TO réfère à quel Unitée Central l'écran est associé (on peut utilisé le N° de série)
* Il  y a-t-il des fonctionnalités à développer en priorité ?
  - Suivre les SAE
* A-t-on le droit d'utiliser des bibliothèques externes ?
  - Oui, c'est libre

| Objet                         | Acteur |                                 Action|
|:------------------------:|:-------------------------------:|:--------------------------------------------------------------:|
| Inventaire               | utilisateur non-inscrit                     | consulter une partie de l'inventaire |
| parc informatique             | technicien                                     | consulter le parc informatique |
| liste                         | technicien                   | modifier une information dans la liste du parc informatique/exporter une liste en format csv |
| machine                       | technicien                   | mettre une machine dans l’inventaire à partir d’un formulaire |
| fichier de données            | technicien         | mettre une série de machines dans l’inventaire à partir d’un fichier de données |
| liste rebut                   | technicien       | supprimer une machine de l’inventaire pour la placer dans une liste dite du rebut/consulter liste rebut/changer statut matériel |
| base                      | administrateur web                                 | créer un technicien dans la base |
| information               | administrateur web                |créer nom des systèmes d’exploitations/constructeur de la machine |
| technicien                | administrateur web                                     | supprimer un technicien |
| liste rebut               | administrateur web                      | consulter la liste du rebut/bloquer la liste du rebut |
| journaux d'activité     | administrateur système                | consulter les différents journaux d’activités de la plateforme |
















