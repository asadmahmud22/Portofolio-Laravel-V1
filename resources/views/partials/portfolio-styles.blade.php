{{-- resources/views/partials/portfolio-styles.blade.php --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #0f0f13;
        color: #e2e2e2;
    }

    /* ─── PORTFOLIO WRAPPER ─── */
    .portfolio-page {
        min-height: 100vh;
        padding: 60px 48px 80px;
        max-width: 860px;
        margin: 0 auto;
    }

    /* ─── PAGE HEADER ─── */
    .page-header {
        margin-bottom: 40px;
    }

    .page-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        font-weight: 600;
        color: #4b5563;
        text-decoration: none;
        margin-bottom: 28px;
        transition: color 0.2s;
    }

    .page-back:hover { color: #34d399; }
    .page-back svg { width: 14px; height: 14px; }

    .page-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 22px;
        font-weight: 800;
        color: #f0f0f0;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .page-title svg { color: #34d399; }

    .page-subtitle {
        font-size: 13px;
        color: #4b5563;
    }

    /* ─── DIVIDER ─── */
    .section-divider {
        border: none;
        border-top: 1px solid #1e1e26;
        margin: 0 0 40px;
    }

    /* ─── CARDS ─── */
    .card {
        background: #141418;
        border: 1.5px solid #1e1e26;
        border-radius: 12px;
        padding: 18px 20px;
        transition: border-color 0.2s;
    }

    .card:hover { border-color: #34d39944; }

    .card-label {
        font-size: 11px;
        font-weight: 600;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .card-value {
        font-size: 14px;
        font-weight: 700;
        color: #f0f0f0;
    }

    .card-sub {
        font-size: 12px;
        color: #6b7280;
        margin-top: 3px;
    }

    /* ─── BADGE ─── */
    .badge-green {
        font-size: 12px;
        font-weight: 600;
        color: #34d399;
        background: #1a2e24;
        border: 1px solid #34d39933;
        padding: 3px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }

    /* ─── STATUS ─── */
    .status-available {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: #34d399;
        font-weight: 600;
        margin-bottom: 28px;
    }

    .status-available .dot {
        width: 7px;
        height: 7px;
        background: #34d399;
        border-radius: 50%;
        animation: pulse 1.8s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.4; transform: scale(1.4); }
    }

    /* ─── BUTTONS ─── */
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: transparent;
        border: 1.5px solid #2a2a35;
        color: #9ca3af;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 20px;
        border-radius: 999px;
        cursor: pointer;
        text-decoration: none;
        transition: border-color 0.2s, color 0.2s, background 0.2s;
    }

    .btn-action:hover { border-color: #34d399; color: #34d399; background: #1a2e2440; }
    .btn-action svg { width: 14px; height: 14px; }
    .btn-action-primary { border-color: #34d399; color: #34d399; }
    .btn-action-primary:hover { background: #34d399; color: #0f0f13; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
        .portfolio-page { padding: 32px 20px 60px; }
    }
</style>