<footer class="main-footer zesco-footer">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <span class="zesco-footer-brand">
                <i class="fas fa-bolt" style="color: #FFB223; margin-right: 4px;"></i>
                <strong>ZESCO</strong> Limited
            </span>
            <span class="zesco-footer-sep">|</span>
            <span class="zesco-footer-text">
                Renewable Energy Management System &copy; {{ date('Y') }}
            </span>
        </div>
        <div class="d-flex align-items-center" style="gap: 1rem;">
            <span class="zesco-footer-text">
                Designed by <strong>Innovation &amp; Systems Development Division</strong> &ndash; ICT
            </span>
            <span class="zesco-footer-version">
                v{{ config('constants.version') }}
            </span>
        </div>
    </div>
</footer>
