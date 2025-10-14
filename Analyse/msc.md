Liste de questions afin de clarifier les exigences :

* Quelle partie de l'inventaire doit être affiché pour les utlisateurs non-identifiés ?

* Quelle informations doivent identifier un utlisateur ?

* L'administrateur web peut bloquer la liste rebut sur un interval de temps ou jusqu'à nouvel ordre ?

* L'administrateur web possède-t-il les droits des techniciens en plus des siens ?

* La caractéristique ATTACHED_TO des écrans correspond à quelle information ?

* Sous quel format les caractéristiques des différents produits sont donnée ?

* Il  y a-t-il des fonctionnalités à développer en priorité ?


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












