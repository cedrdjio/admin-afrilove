<?php
require 'inc/Header.php';
if(isset($_SESSION['datingname'])) {
    echo '<script>window.location.href="dashboard.php";</script>';
}
?>
<!-- Login page -->
<div class="login-page-wrapper">

  <!-- LEFT — Brand panel -->
  <div class="login-brand-panel">
    <img src="assets/images/afrilove-icon.png" alt="AfriLove World" class="login-brand-logo">
    <div class="login-brand-tagline">
      Connecter les <em>cœurs.</em><br>
      Rapprocher les <em>cultures.</em>
    </div>
    <div class="login-brand-divider"></div>
    <p class="login-brand-desc">
      Gérez votre plateforme de rencontres premium<br>
      depuis un tableau de bord moderne et sécurisé.
    </p>
    <div class="login-brand-features">
      <div class="feat">
        <div class="feat-icon">&#128737;</div>
        <div><strong style="color:#fff;display:block;font-size:0.82rem;">Sécurisé</strong><span>Données protégées</span></div>
      </div>
      <div class="feat">
        <div class="feat-icon">&#128202;</div>
        <div><strong style="color:#fff;display:block;font-size:0.82rem;">Performant</strong><span>Tableau de bord avancé</span></div>
      </div>
      <div class="feat">
        <div class="feat-icon">&#128101;</div>
        <div><strong style="color:#fff;display:block;font-size:0.82rem;">Communauté</strong><span>Des milliers de membres</span></div>
      </div>
    </div>
    <div style="position:absolute;bottom:28px;left:50px;color:rgba(255,255,255,0.3);font-size:0.73rem;z-index:1;">
      © 2026 AfriLove World. Tous droits réservés.
    </div>
  </div>

  <!-- RIGHT — Form panel -->
  <div class="login-form-panel">
    <div class="login-form-card">
      <div class="login-title">Bon retour 👋</div>
      <p class="login-subtitle">Connectez-vous à votre espace d'administration.</p>

      <form class="theme-form" method="post" autocomplete="off">
        <input type="hidden" name="type" value="login"/>

        <div class="form-group">
          <label class="col-form-label">Email</label>
          <input class="form-control" name="username" type="text" required id="username" placeholder="admin@afrilove.world">
        </div>

        <div class="form-group">
          <label class="col-form-label">Mot de passe</label>
          <input class="form-control" type="password" name="password" required id="password-field" placeholder="••••••••••••">
        </div>

        <div class="form-group">
          <label class="col-form-label">Type d'utilisateur</label>
          <select class="form-control" name="stype" id="stype" required>
            <option value="">Sélectionner</option>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
          </select>
        </div>

        <div class="form-group">
          <label class="col-form-label">Langue du tableau de bord</label>
          <select class="form-control" name="sel_lan" required>
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
        </div>

        <button class="btn-login" type="submit">Se connecter &rarr;</button>

        <div class="login-footer-copy">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:4px;"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z" fill="#C8941A"/></svg>
          Connexion sécurisée SSL
        </div>
      </form>
    </div>
  </div>

</div>

<?php require 'inc/Footer.php'; ?>
</body>
</html>
