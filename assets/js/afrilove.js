/* ============================================================================
   AfriLove World — interactions (sidebar mobile + animations GSAP fluides)
   Amélioration progressive : si GSAP n'est pas chargé, l'UI reste visible.
   ============================================================================ */
(function () {
  "use strict";

  /* ---- Sidebar mobile (off-canvas) ---- */
  var sb = document.querySelector(".sidebar-wrapper");
  if (sb) {
    var backdrop = document.createElement("div");
    backdrop.className = "af-backdrop";
    document.body.appendChild(backdrop);

    function openSb()  { sb.classList.add("open");  backdrop.classList.add("show"); }
    function closeSb() { sb.classList.remove("open"); backdrop.classList.remove("show"); }

    document.querySelectorAll(".toggle-sidebar, .toggle-nav").forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        sb.classList.contains("open") ? closeSb() : openSb();
      });
    });
    backdrop.addEventListener("click", closeSb);
    // ferme après clic sur un lien (mobile)
    sb.querySelectorAll(".sidebar-link").forEach(function (a) {
      a.addEventListener("click", function () { if (window.innerWidth <= 991) closeSb(); });
    });
  }

  /* ---- Marque le lien actif dans la sidebar ---- */
  try {
    var path = window.location.pathname.split("/").pop() || "dashboard.php";
    document.querySelectorAll(".sidebar-wrapper .sidebar-link").forEach(function (a) {
      var href = a.getAttribute("href");
      if (href && href.indexOf(path) !== -1 && path.length > 1) {
        a.classList.add("active");
        a.closest(".sidebar-list") && a.closest(".sidebar-list").classList.add("active");
      }
    });
  } catch (e) {}

  /* ---- Animations GSAP (si disponible) ---- */
  function initGsap() {
    if (!window.gsap) return;
    var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduce) return;
    if (window.ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

    gsap.from(".sidebar-wrapper .sidebar-link", {
      x: -18, opacity: 0, duration: .5, stagger: .035, ease: "power3.out", delay: .1
    });
    gsap.from(".page-header .nav-right > *, .page-header .header-logo-wrapper", {
      y: -12, opacity: 0, duration: .5, stagger: .06, ease: "power3.out"
    });
    if (document.querySelector(".afri-greeting")) {
      gsap.from(".afri-greeting", { y: 18, opacity: 0, duration: .6, ease: "power3.out" });
    }
    gsap.utils.toArray(".afri-bento > *").forEach(function (card, i) {
      gsap.from(card, {
        y: 26, opacity: 0, duration: .6, ease: "power3.out",
        delay: i * 0.015,
        scrollTrigger: window.ScrollTrigger ? { trigger: card, start: "top 94%", once: true } : undefined
      });
    });
    // cartes/ tableaux des autres pages
    gsap.utils.toArray(".page-body .card").forEach(function (card) {
      gsap.from(card, {
        y: 22, opacity: 0, duration: .55, ease: "power3.out",
        scrollTrigger: window.ScrollTrigger ? { trigger: card, start: "top 94%", once: true } : undefined
      });
    });
  }

  if (document.readyState !== "loading") initGsap();
  else document.addEventListener("DOMContentLoaded", initGsap);
})();
