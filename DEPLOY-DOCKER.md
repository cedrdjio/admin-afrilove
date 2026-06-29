# Déployer AfriLove World en conteneur (Docker)

L'app tourne en conteneur **PHP 8.2 + MySQL**. `inc/Connection.php` lit d'abord
les **variables d'environnement** (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`),
sinon les valeurs en dur (pour IONOS).

---

## 1. En LOCAL (pour voir tout de suite)

Pré-requis : Docker Desktop installé.

```bash
# 1) place ton dump SQL ici :
#    db/init.sql
# 2) lance :
docker compose up --build
```

➡️ Ouvre **http://localhost:8080** — l'app tourne, la base est importée automatiquement.

---

## 2. En LIGNE gratuitement — Railway (recommandé)

1. Va sur **railway.app** → connecte-toi avec **GitHub**.
2. **New Project → Deploy from GitHub repo** → choisis `cedrdjio/admin-afrilove`.
   Railway détecte le **Dockerfile** et build le conteneur.
3. **New → Database → Add MySQL**. Railway crée une base et expose ces variables :
   `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`, `MYSQLPORT`.
4. Sur le **service web** → onglet **Variables** → ajoute :
   ```
   DB_HOST = ${{MySQL.MYSQLHOST}}
   DB_USER = ${{MySQL.MYSQLUSER}}
   DB_PASS = ${{MySQL.MYSQLPASSWORD}}
   DB_NAME = ${{MySQL.MYSQLDATABASE}}
   ```
   *(Si le port n'est pas 3306, mets `DB_HOST = ${{MySQL.MYSQLHOST}}:${{MySQL.MYSQLPORT}}`.)*
5. **Importe la base** : onglet MySQL → **Data / Query** (ou un client comme
   TablePlus avec les identifiants Railway) → importe ton `Gomeet (Copie).sql`.
6. Service web → **Settings → Networking → Generate Domain** → tu obtiens une URL
   publique `https://….up.railway.app`. 🎉

Ensuite, **chaque push sur GitHub redéploie automatiquement** — c'est comme ça
qu'on itère ensemble : je pousse, Railway met à jour, tu rafraîchis l'URL.

---

## 3. Alternative — Render

- **New → Web Service → Build from a Dockerfile** (depuis GitHub).
- Render n'offre pas de **MySQL gratuit** : il te faut une base externe gratuite
  (ex. **Aiven for MySQL** free, ou **Clever Cloud**), puis renseigne les mêmes
  variables `DB_HOST/USER/PASS/NAME`.

---

## Fichiers fournis
- `Dockerfile` — image PHP + mysqli, sert l'app sur `$PORT`.
- `docker-compose.yml` — pile locale app + MySQL (import auto de `db/init.sql`).
- `.dockerignore` — exclut `.git`, `node_modules`, `preview`, le dump SQL.
