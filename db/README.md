# Base de données

Place ici ton dump SQL sous le nom **`init.sql`** :

```
db/init.sql
```

- En **local** (`docker compose up`), MySQL l'importe automatiquement au 1er démarrage.
- Sur **Railway / Render**, importe-le via l'onglet base de données (ou un client MySQL).

⚠️ `db/init.sql` est ignoré par git (`.gitignore`) : il peut contenir des
données/identifiants, on ne le versionne pas.
