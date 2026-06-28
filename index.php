<?php
require 'inc/Header.php';
if(isset($_SESSION['datingname'])) {
    echo '<script>window.location.href="dashboard.php";</script>';
}
?>
<!-- Login v2 -->
<div class="afl-login">

  <!-- GAUCHE — marque -->
  <div class="afl-left">
    <div class="afl-logo">
      <img src="assets/images/afrilove-logo.png" alt="AfriLove World">
    </div>

    <div class="afl-hero">
      <h1>Connecter les <em>cœurs.</em><br>Rapprocher les <em>cultures.</em></h1>
      <div class="afl-rule"></div>
      <p>Gérez votre plateforme de rencontres premium depuis un tableau de bord moderne et sécurisé.</p>
    </div>

    <div class="afl-feats">
      <div class="afl-feat"><span class="ic"><i class="fas fa-shield-halved"></i></span><div><b>Sécurisé</b><span>Données protégées</span></div></div>
      <div class="afl-feat"><span class="ic"><i class="fas fa-chart-simple"></i></span><div><b>Performant</b><span>Tableau de bord avancé</span></div></div>
      <div class="afl-feat"><span class="ic"><i class="fas fa-users"></i></span><div><b>Communauté</b><span>Des milliers de membres</span></div></div>
    </div>

    <div class="afl-copy">© <?= date('Y') ?> AfriLove World. Tous droits réservés.</div>
  </div>

  <!-- DROITE — formulaire -->
  <div class="afl-right">
    <div class="afl-card">
      <h2>Bon retour 👋</h2>
      <p class="afl-lead">Connectez-vous à votre espace d'administration.</p>

      <form class="theme-form" method="post" autocomplete="off">
        <input type="hidden" name="type" value="login"/>

        <div class="afl-field">
          <label>Email</label>
          <div class="afl-input">
            <span class="lead"><i class="fas fa-envelope"></i></span>
            <input name="username" type="text" id="username" required placeholder="admin@afrilove.world">
          </div>
        </div>

        <div class="afl-field">
          <label>Mot de passe</label>
          <div class="afl-input">
            <span class="lead"><i class="fas fa-lock"></i></span>
            <input name="password" type="password" id="password-field" required placeholder="••••••••••••">
            <button type="button" class="eye" id="togglePwd" aria-label="Afficher le mot de passe"><i class="fas fa-eye"></i></button>
          </div>
        </div>

        <div class="afl-field">
          <label>Type d'utilisateur</label>
          <div class="afl-input">
            <span class="lead"><i class="fas fa-user-shield"></i></span>
            <select name="stype" id="stype" required>
              <option value="">Sélectionner</option>
              <option value="Admin">Admin</option>
              <option value="Staff">Staff</option>
            </select>
            <span class="caret"><i class="fas fa-chevron-down"></i></span>
          </div>
        </div>

        <div class="afl-field">
          <label>Langue du tableau de bord</label>
          <div class="afl-input">
            <span class="lead"><i class="fas fa-earth-africa"></i></span>
            <select name="sel_lan" required>
              <option value="">Sélectionner</option>
              <option value="en">English</option>
              <option value="fr">Français</option>
              <option value="ar">Arabic</option>
              <option value="sp">Spanish</option>
              <option value="ru">Russian</option>
              <option value="hi">Hindi</option>
              <option value="ja">Japanese</option>
              <option value="ch">Chinese</option>
              <option value="tu">Turkish</option>
            </select>
            <span class="caret"><i class="fas fa-chevron-down"></i></span>
          </div>
        </div>

        <div class="afl-row">
          <label class="afl-check">
            <input type="checkbox" id="remember">
            <span class="box"><i class="fas fa-check"></i></span>
            Se souvenir de moi
          </label>
        </div>

        <button class="afl-btn" type="submit">Se connecter <span class="arr"><i class="fas fa-arrow-right"></i></span></button>

        <div class="afl-sep">ou</div>
        <div class="afl-secure">
          <span class="lock"><i class="fas fa-lock"></i></span>
          <span>Connexion sécurisée SSL</span>
        </div>
      </form>
    </div>
  </div>

</div>

<script>
/* Afficher / masquer le mot de passe */
(function () {
  var btn = document.getElementById('togglePwd');
  var fld = document.getElementById('password-field');
  if (btn && fld) {
    btn.addEventListener('click', function () {
      var show = fld.type === 'password';
      fld.type = show ? 'text' : 'password';
      btn.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
  }
})();
</script>

<?php require 'inc/Footer.php'; ?>
</body>
</html>
