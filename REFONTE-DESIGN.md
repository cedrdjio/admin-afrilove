# AfriLove World — Refonte UI (thème Bento crème · marron · or)

Refonte **visuelle uniquement**. Aucune page ni fonctionnalité PHP n'a été
modifiée : les formulaires, endpoints AJAX (`inc/Operation.php`), requêtes SQL,
l'API mobile (`/api`) et les passerelles de paiement restent **identiques**.
La plateforme tierce qui dépend de la base de données n'est pas impactée.

## Ce qui a changé

| Fichier | Changement |
|---|---|
| `inc/Header.php` | Ajout de **Tailwind CSS (CDN)** préfixé `tw-` + chargement du nouveau thème |
| `assets/css/afrilove-theme.css` | **Nouveau** — thème complet : palette, grille Bento, animations, habillage global |
| `dashboard.php` | Tableau de bord transformé en **grille Bento animée** (mêmes données SQL) |
| Pages existantes (`list_*`, `add_*`, `setting.php`…) | Reçoivent automatiquement la palette crème/marron/or, sans modification du markup |

> Les anciens fichiers CSS (`style.css`, `color-1.css`, `responsive.css`,
> `picker.css`, vendors) sont **conservés** : ils assurent la mise en page
> Bootstrap des 40+ pages. On ne fait que les surcharger.

## Style & palette

Style épuré (beaucoup de blanc, ombres douces) avec le **marron en accent léger**
— jamais dominant.

- Fond `#F4F2EE` (blanc cassé chaud) · Cartes `#FFFFFF` · Texte `#1F1A16`
- Accent marron `#B08968` / `#8A6A4B` (tons doux) · Bordures `#ECE7DF`
- Badges discrets : vert `#46A86B`, ambre `#C98A1E`

## Sécurité « fichier manquant »

- Tailwind et Font Awesome sont chargés par **CDN** (comme avant). Aucun fichier
  local supplémentaire requis ; aucun appel vers un fichier inexistant.
- Tailwind est **préfixé `tw-`** : il ne peut pas entrer en collision avec les
  classes Bootstrap existantes (`.border`, `.shadow`, `.container`, `.rounded`…).
- `preflight: false` : Tailwind ne réinitialise rien.

## Prévisualiser SANS PHP/MySQL (dossier `preview/`)

Pour voir le design avant de déployer, ouvre simplement dans un navigateur :

- `preview/login.html` — page de connexion
- `preview/dashboard.html` — tableau de bord (données d'exemple)

Ces fichiers sont **statiques** (HTML + CSS), ils réutilisent le vrai thème
(`assets/css/afrilove-theme.css`) et embarquent Font Awesome en local
(`preview/vendor/fontawesome/`) : l'aperçu fonctionne **même hors-ligne**.
Ils ne servent qu'à l'aperçu — le vrai dashboard reste `dashboard.php`.

### Aperçu en ligne (optionnel)

Tu peux glisser le dépôt sur un hébergement statique (Vercel, Netlify, GitHub
Pages) pour partager l'aperçu : pointe sur `/preview/login.html`.
⚠️ Ces hébergeurs n'exécutent **pas** PHP — c'est pour l'aperçu design uniquement.

## Hébergement réel sur IONOS

IONOS exécute PHP + MySQL. Procédure :

1. Téléverse tout le dépôt à la racine web (ex. `htdocs/` ou `/`).
2. Configure la connexion BDD dans `inc/Connection.php` (hôte, base, user, mot de passe IONOS).
3. Importe la base depuis ton dump SQL (`Gomeet (Copie).sql`) via phpMyAdmin IONOS.
4. Vérifie que le PHP d'IONOS est ≥ 7.4 et que l'extension `mysqli` est active.
5. Ouvre `https://ton-domaine/` → page de connexion.

Le dossier `preview/` peut rester en ligne (inoffensif) ou être supprimé en prod.
