<?php
require 'inc/Header.php';

// Greeting logic
$hour = (int)date('H');
if ($hour < 12)      $greeting = 'Bonjour';
elseif ($hour < 18)  $greeting = 'Bon après-midi';
else                 $greeting = 'Bonsoir';

$adminName = isset($_SESSION['datingname']) ? explode('@', $_SESSION['datingname'])[0] : 'Admin';
$adminName = ucfirst($adminName);

// Pre-fetch all counts
$count_interest  = $dating->query("SELECT COUNT(*) c FROM tbl_interest")->fetch_assoc()['c'];
$count_language  = $dating->query("SELECT COUNT(*) c FROM tbl_language")->fetch_assoc()['c'];
$count_religion  = $dating->query("SELECT COUNT(*) c FROM tbl_religion")->fetch_assoc()['c'];
$count_rgoal     = $dating->query("SELECT COUNT(*) c FROM relation_goal")->fetch_assoc()['c'];
$count_faq       = $dating->query("SELECT COUNT(*) c FROM tbl_faq")->fetch_assoc()['c'];
$count_plan      = $dating->query("SELECT COUNT(*) c FROM tbl_plan")->fetch_assoc()['c'];
$count_users     = $dating->query("SELECT COUNT(*) c FROM tbl_user")->fetch_assoc()['c'];
$count_pages     = $dating->query("SELECT COUNT(*) c FROM tbl_page")->fetch_assoc()['c'];
$count_gift      = $dating->query("SELECT COUNT(*) c FROM tbl_gift")->fetch_assoc()['c'];
$count_package   = $dating->query("SELECT COUNT(*) c FROM tbl_package")->fetch_assoc()['c'];
$count_male      = $dating->query("SELECT COUNT(*) c FROM tbl_user WHERE gender='MALE'")->fetch_assoc()['c'];
$count_female    = $dating->query("SELECT COUNT(*) c FROM tbl_user WHERE gender='FEMALE'")->fetch_assoc()['c'];
$count_fake      = $dating->query("SELECT COUNT(*) c FROM tbl_user WHERE user_type='FAKE_USER'")->fetch_assoc()['c'];
$earning_row     = $dating->query("SELECT SUM(amount) AS t FROM plan_purchase_history")->fetch_assoc();
$total_earning   = ($earning_row['t'] ?? 0) ?: 0;
$currency        = $set['currency'] ?? '';

// Genders ratio (for meters)
$gtotal = max(1, (int)$count_male + (int)$count_female);
$male_pct   = round((int)$count_male   / $gtotal * 100);
$female_pct = round((int)$count_female / $gtotal * 100);

// Bento stat tiles (libellé, valeur, icône FA)
$tiles = [
  ['label' => $lang['Interest'],      'count' => $count_interest, 'icon' => 'fa-heart'],
  ['label' => $lang['Language'],      'count' => $count_language, 'icon' => 'fa-earth-africa'],
  ['label' => $lang['Religion'],      'count' => $count_religion, 'icon' => 'fa-place-of-worship'],
  ['label' => $lang['Relation_Goal'], 'count' => $count_rgoal,    'icon' => 'fa-bullseye'],
  ['label' => $lang['Plan'],          'count' => $count_plan,     'icon' => 'fa-crown'],
  ['label' => $lang['FAQ'],           'count' => $count_faq,      'icon' => 'fa-circle-question'],
  ['label' => $lang['Total_Pages'],   'count' => $count_pages,    'icon' => 'fa-file-lines'],
  ['label' => 'Cadeaux',              'count' => $count_gift,     'icon' => 'fa-gift'],
  ['label' => 'Packages',             'count' => $count_package,  'icon' => 'fa-box-open'],
  ['label' => 'Faux Profils',         'count' => $count_fake,     'icon' => 'fa-user-secret'],
];
?>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <?php require 'inc/Navbar.php'; ?>
      <div class="page-body-wrapper">
        <?php require 'inc/Sidebar.php'; ?>

        <div class="page-body">
          <div class="container-fluid pt-4 pb-4">

            <!-- Greeting header -->
            <div class="afri-greeting mb-4">
              <div>
                <h2 class="afri-greeting-title"><?= $greeting ?>, <?= htmlspecialchars($adminName) ?> 👋</h2>
                <p class="afri-greeting-sub">Voici un aperçu de votre plateforme AfriLove World.</p>
              </div>
              <div class="afri-greeting-date">
                <i class="fas fa-calendar-day me-2" style="color:var(--af-gold)"></i><?= date('d F Y') ?>
              </div>
            </div>

            <p class="afri-section-label">Vue d'ensemble</p>

            <!-- ============ Grille Bento ============ -->
            <div class="afri-bento">

              <!-- APERÇU -->
              <div class="bento-card bento-hero b-span-6">
                <div>
                  <div class="h-kicker">Vue d'ensemble</div>
                  <div class="h-title">Votre communauté AfriLove World</div>
                  <div class="h-sub">Connecter les cœurs, rapprocher les cultures. Suivez vos membres et l'activité de la plateforme en un coup d'œil.</div>
                </div>
                <div class="h-foot">
                  <div class="h-stat is-brown"><div class="v" data-count="<?= (int)$count_users ?>">0</div><div class="k"><?= $lang['Total_Users'] ?></div></div>
                  <div class="h-stat"><div class="v" data-count="<?= (int)$count_male ?>">0</div><div class="k">Hommes</div></div>
                  <div class="h-stat"><div class="v" data-count="<?= (int)$count_female ?>">0</div><div class="k">Femmes</div></div>
                </div>
              </div>

              <!-- REVENUS -->
              <div class="bento-card bento-earning b-span-3">
                <div class="e-coin"><i class="fas fa-coins"></i></div>
                <div>
                  <div class="e-label"><?= $lang['Total_Earning'] ?></div>
                  <div class="e-value"><span data-count="<?= (float)$total_earning ?>" data-decimals="2">0</span> <?= htmlspecialchars($currency) ?></div>
                  <span class="e-pill"><i class="fas fa-arrow-trend-up"></i> Cumul</span>
                </div>
              </div>

              <!-- RÉPARTITION -->
              <div class="bento-card bento-split b-span-3">
                <div class="s-head">Répartition membres</div>
                <div class="s-total" data-count="<?= (int)$count_users ?>">0</div>
                <div class="s-row">
                  <span class="s-dot" style="background:var(--af-brown)"></span>
                  <span class="s-meter"><i style="width:<?= $male_pct ?>%;background:var(--af-brown)"></i></span>
                  <span class="s-val"><?= $male_pct ?>%</span>
                </div>
                <div class="s-row">
                  <span class="s-dot" style="background:var(--af-pink)"></span>
                  <span class="s-meter"><i style="width:<?= $female_pct ?>%;background:var(--af-pink)"></i></span>
                  <span class="s-val"><?= $female_pct ?>%</span>
                </div>
                <div class="s-row" style="margin-top:14px;font-size:.74rem;color:var(--af-muted);gap:18px">
                  <span><i class="fas fa-mars me-1" style="color:var(--af-brown)"></i>Hommes</span>
                  <span><i class="fas fa-venus me-1" style="color:var(--af-pink)"></i>Femmes</span>
                </div>
              </div>

              <!-- TUILES STATS -->
              <?php foreach ($tiles as $t): ?>
              <div class="bento-card bento-stat">
                <div class="b-top">
                  <div class="b-icon"><i class="fas <?= $t['icon'] ?>"></i></div>
                  <span class="b-trend"><i class="fas fa-arrow-trend-up"></i></span>
                </div>
                <div>
                  <div class="b-value" data-count="<?= (int)$t['count'] ?>">0</div>
                  <div class="b-label"><?= htmlspecialchars($t['label']) ?></div>
                </div>
              </div>
              <?php endforeach; ?>

            </div><!-- /bento -->

          </div>
        </div>
      </div>
    </div>

<script>
/* Compteurs animés + halo qui suit la souris (léger, requestAnimationFrame) */
(function () {
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function animateCount(el) {
    var target  = parseFloat(el.getAttribute('data-count')) || 0;
    var dec     = parseInt(el.getAttribute('data-decimals') || '0', 10);
    if (reduce) { el.textContent = target.toLocaleString('fr-FR', {minimumFractionDigits:dec, maximumFractionDigits:dec}); return; }
    var start = performance.now(), dur = 1100;
    function tick(now) {
      var p = Math.min(1, (now - start) / dur);
      var e = 1 - Math.pow(1 - p, 3);            // easeOutCubic
      var v = target * e;
      el.textContent = v.toLocaleString('fr-FR', {minimumFractionDigits:dec, maximumFractionDigits:dec});
      if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  var counters = document.querySelectorAll('[data-count]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { animateCount(en.target); io.unobserve(en.target); }
      });
    }, { threshold: 0.4 });
    counters.forEach(function (c) { io.observe(c); });
  } else {
    counters.forEach(animateCount);
  }

  // Halo de survol
  document.querySelectorAll('.bento-card').forEach(function (card) {
    card.addEventListener('pointermove', function (e) {
      var r = card.getBoundingClientRect();
      card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
      card.style.setProperty('--my', (e.clientY - r.top) + 'px');
    });
  });
})();
</script>

<?php require 'inc/Footer.php'; ?>
</body>
</html>
