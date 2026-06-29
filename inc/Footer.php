<!-- latest jquery-->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap js-->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- scrollbar js -->
<script src="assets/js/scrollbar/simplebar.js"></script>
<!-- notify js -->
<script src="assets/js/notify/bootstrap-notify.min.js"></script>
<!-- script js -->
<script src="assets/js/script.js"></script>
<!-- sidebar menu -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- select2 -->
<script src="assets/js/select2/select2.full.min.js"></script>
<!-- datatable js -->
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<!-- summernote js -->
<script src="assets/js/summer.js"></script>
<!-- picker js -->
<script src="assets/js/picker.js"></script>
<!-- AfriLove : sidebar mobile + animations GSAP -->
<script src="assets/js/afrilove.js"></script>

<script>
$(document).ready(function () {

    /* ---- Login form ---- */
    $(".theme-form").on("submit", function (e) {
        e.preventDefault();
        var username  = $("input[name='username']").val();
        var password  = $("input[name='password']").val();
        var stype     = $("select[name='stype']").val();
        var sel_lan   = $("select[name='sel_lan']").val();

        if (!username || !password || !stype || !sel_lan) {
            $.notify({ title: "Champs manquants !", message: "Remplissez tous les champs." }, { type: "danger", timer: 3000 });
            return;
        }

        $.ajax({
            url: "inc/Operation.php",
            type: "POST",
            data: { type: "login", username: username, password: password, stype: stype, sel_lan: sel_lan },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.Result === "true") {
                    $.notify({ title: res.title, message: res.message }, { type: "success", timer: 1500 });
                    setTimeout(function () { window.location.href = res.action; }, 1000);
                } else {
                    $.notify({ title: res.title, message: "Email ou mot de passe incorrect." }, { type: "danger", timer: 3000 });
                }
            },
            error: function () {
                $.notify({ title: "Erreur !", message: "Impossible de contacter le serveur." }, { type: "danger", timer: 3000 });
            }
        });
    });

    /* ---- Toggle status (dark mode, user status…) ---- */
    $(document).on("click", ".drop", function () {
        var id = $(this).attr("data-id");
        var status = $(this).attr("data-status");
        var type = $(this).attr("data-type");
        var coll_type = $(this).attr("coll-type");
        $.ajax({
            url: "inc/Operation.php",
            type: "POST",
            data: { id: id, status: status, data_type: type, coll_type: coll_type, type: "update_status" },
            success: function (response) {
                var res = JSON.parse(response);
                $.notify({ title: res.title, message: res.message }, { type: res.Result === "true" ? "success" : "danger", timer: 2000 });
                setTimeout(function () { window.location.href = res.action; }, 1500);
            }
        });
    });
});
</script>
