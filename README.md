# 🖥️ La loutre du réseau (RPI Edition)

Une plateforme web légère et robuste dédiée à la gestion du parc informatique d'entreprise. Conçue pour être auto-hébergée sur architecture ARM, elle permet un suivi précis du matériel tout en garantissant l'intégrité des données via un système de rôles strict.

---

## 🌍 Environnement de Déploiement

Le projet est optimisé pour une consommation de ressources minimale :
* **Serveur de Production :** Raspberry Pi 4 (8GB RAM).
* **Système d'exploitation :** Debian (Bullseye/Bookworm).
* **Serveur Web :** Apache2 / MariaDB / PHP.
* **Compatibilité :** Parfaitement fonctionnel sous Windows via **XAMPP/WAMP** pour le développement local.

---

## 🔐 Système de Permissions (RBAC)

L'accès aux fonctionnalités est segmenté en quatre niveaux pour assurer la sécurité et la cohérence des données :

| Rôle | Périmètre d'action |
| :--- | :--- |
| **🌐 Public** | Accès à l'accueil et au login. Visualisation d'un **échantillon de démo** (2-3 lignes max) de la table des Unités Centrales. |
| **🛠️ Technicien** | Gestionnaire de terrain. Droits **CRUD complets** sur les Unités Centrales et les Écrans (Ajout, Modification, Suppression). |
| **🛡️ Admin Web** | Garant de la base. Gère les comptes utilisateurs et les **référentiels** (Marques, OS) pour éviter les erreurs de syntaxe lors des saisies. |
| **📜 Admin Sys** | Auditeur sécurité. Accès exclusif à la consultation des **logs de connexion**. |

---

## 🛠️ Stack Technique

* **Backend :** PHP (Gestion des sessions et logique métier).
* **Base de données :** MariaDB / SQL (Structure relationnelle).
* **Frontend :** HTML5 / CSS3 (Design épuré et responsive).
* **Scripts :** JavaScript (Interactions dynamiques).

---

## 📈 Fonctionnalités Clés

* **Intégrité de saisie :** L'Admin Web centralise les noms d'OS et de marques. Les techniciens utilisent des menus déroulants pré-remplis, éliminant les doublons (ex: "Win10" vs "Windows 10").
* **Sécurité des Routes :** Vérification systématique des privilèges de session sur chaque page sensible.
* **Traçabilité :** Journalisation automatique des tentatives de connexion pour l'Admin Sys.
* **Optimisation RPi :** Architecture légère permettant une navigation fluide même sur micro-ordinateur.

---
