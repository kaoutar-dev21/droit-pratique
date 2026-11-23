document.addEventListener('DOMContentLoaded', function () {
    // Menu mobile
    var toggle = document.getElementById('navToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('open');
            toggle.classList.toggle('open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }

    // Fermer les messages flash
    document.querySelectorAll('.flash-close').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.flash').remove();
        });
    });
    setTimeout(function () {
        document.querySelectorAll('.flash-success').forEach(function (el) { el.remove(); });
    }, 6000);

    // Compteur de caractères (commentaires)
    document.querySelectorAll('textarea[data-counter]').forEach(function (area) {
        var target = document.querySelector(area.getAttribute('data-counter'));
        var max = area.getAttribute('maxlength') || 1000;
        var update = function () { if (target) target.textContent = area.value.length + ' / ' + max; };
        area.addEventListener('input', update);
        update();
    });

    // Confirmation avant suppression
    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm(form.getAttribute('data-confirm'))) e.preventDefault();
        });
    });
});