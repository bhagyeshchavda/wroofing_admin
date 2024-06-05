<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a>
<style>
#back-to-top {
    transition: background-color .3s,
    opacity .5s, visibility .5s;
    opacity: 0;
    visibility: hidden;
}
#back-to-top.show {
    opacity: 1;
    visibility: visible;
}
</style>
<script>
    var btn = $('#back-to-top');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });
</script>
<footer class="main-footer">
    {{-- <span class="mw-powered-by">Developed by <a href="https://www.glorywebs.com/" target="_blank" title="Make a website">Glorywebs Creatives Pvt. Ltd.</a></span> --}}
    <strong>Developed by <a href="https://www.glorywebs.com/" target="_blank">Glorywebs Creatives Pvt. Ltd.</a></strong>
    {{-- All rights reserved. --}}
    {{-- <strong>Copyright &copy; 2023-{{ date('Y') }} <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div> --}}
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
