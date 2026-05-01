<style>
    :root {
        --ink: #1b2430;
        --muted: #677487;
        --line: rgba(27, 36, 48, 0.1);
        --paper: #f5f6f8;
        --surface: #ffffff;
        --surface-soft: #f8fafc;
        --brand: #0f766e;
        --brand-soft: #e4f4f1;
        --accent: #ef7d34;
        --danger: #c24138;
        --radius-lg: 28px;
        --radius-md: 22px;
        --radius-sm: 16px;
        --shadow: 0 18px 40px rgba(20, 30, 45, 0.08);
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
        margin: 0;
        font-family: 'Manrope', sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at top left, rgba(15, 118, 110, 0.08), transparent 26%),
            linear-gradient(180deg, #fbfbfc 0%, var(--paper) 100%);
    }

    a { color: inherit; text-decoration: none; }
    img { display: block; max-width: 100%; }
    button, input, select, textarea { font: inherit; }

    h1, h2, h3, h4 {
        margin: 0;
        font-weight: 800;
        letter-spacing: -0.04em;
        line-height: 1.05;
    }

    p { margin: 0; line-height: 1.65; }
    .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }

    .announcement-bar {
        background: #13202b;
        color: #d8e2eb;
        font-size: 13px;
    }

    .announcement-content {
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .announcement-note {
        color: #9cb0c1;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .site-header {
        position: sticky;
        top: 0;
        z-index: 40;
        backdrop-filter: blur(14px);
    }

    .topbar {
        background: rgba(251, 251, 252, 0.9);
        border-bottom: 1px solid rgba(27, 36, 48, 0.08);
    }

    .nav {
        min-height: 78px;
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .brand {
        display: inline-flex;
        align-items: center;
        gap: 14px;
    }

    .brand-mark {
        width: 44px;
        height: 44px;
        display: inline-grid;
        place-items: center;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--brand) 0%, #105b56 100%);
        color: white;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.08em;
        box-shadow: 0 12px 24px rgba(15, 118, 110, 0.2);
    }

    .brand-copy {
        display: grid;
        gap: 2px;
    }

    .brand-copy strong {
        font-size: 16px;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .brand-copy small {
        color: var(--muted);
        font-size: 12px;
    }

    .nav-links,
    .nav-actions,
    .hero-actions,
    .page-hero-actions,
    .quick-chips,
    .tag-list {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .nav-links {
        margin-left: auto;
    }

    .nav-links a {
        padding: 10px 12px;
        border-radius: 999px;
        color: var(--muted);
        font-size: 14px;
        font-weight: 700;
    }

    .nav-links a.active,
    .nav-links a:hover {
        background: var(--brand-soft);
        color: var(--brand);
    }

    .btn,
    button {
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 18px;
        border: 0;
        border-radius: 999px;
        cursor: pointer;
        font-weight: 800;
        transition: transform 0.16s ease, box-shadow 0.16s ease, background 0.16s ease;
        background: linear-gradient(135deg, var(--brand) 0%, #105b56 100%);
        color: white;
        box-shadow: 0 14px 24px rgba(15, 118, 110, 0.16);
    }

    .btn:hover,
    button:hover {
        transform: translateY(-1px);
    }

    .btn.small {
        min-height: 40px;
        padding: 0 15px;
        font-size: 14px;
    }

    .btn.secondary {
        background: #16212c;
        box-shadow: none;
    }

    .btn.light {
        background: var(--brand-soft);
        color: var(--brand);
        box-shadow: none;
    }

    .btn.ghost {
        background: rgba(255, 255, 255, 0.76);
        color: var(--ink);
        border: 1px solid var(--line);
        box-shadow: none;
    }

    .btn.danger {
        background: var(--danger);
        box-shadow: none;
    }

    .link-button {
        min-height: auto;
        padding: 0;
        background: transparent;
        color: var(--muted);
        box-shadow: none;
    }

    .page-shell { padding: 24px 0 72px; }
    .alert-stack { display: grid; gap: 12px; margin-bottom: 12px; }
    .section { padding: 34px 0; }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: var(--brand);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .eyebrow::before {
        content: '';
        width: 26px;
        height: 1px;
        background: rgba(15, 118, 110, 0.35);
    }

    .hero-shell,
    .page-hero,
    .card,
    table,
    .sidebar,
    .stat {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(27, 36, 48, 0.08);
        box-shadow: var(--shadow);
    }

    .page-hero,
    .hero-shell {
        border-radius: var(--radius-lg);
    }

    .page-hero {
        display: flex;
        justify-content: space-between;
        gap: 18px;
        padding: 28px;
    }

    .page-hero-compact { padding: 24px; }

    .page-hero h1,
    .hero-copy h1 {
        font-size: clamp(2.1rem, 4.5vw, 3.8rem);
    }

    .page-hero p,
    .hero-copy p,
    .section-head-copy,
    .muted,
    .mini-meta {
        color: var(--muted);
    }

    .page-hero p,
    .hero-copy p { max-width: 620px; }

    .hero-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.85fr);
        gap: 22px;
        padding: 32px;
    }

    .hero-actions,
    .page-hero-actions { margin-top: 20px; }

    .hero-metrics,
    .summary-list,
    .timeline,
    .filter-form,
    .item-stack,
    .order-stack {
        display: grid;
        gap: 12px;
    }

    .hero-metrics {
        margin-top: 22px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .metric-pill,
    .point-card,
    .spec-item,
    .notice-panel,
    .timeline-item,
    .summary-card,
    .results-bar,
    .empty-state {
        padding: 16px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--line);
        background: var(--surface-soft);
    }

    .metric-pill strong,
    .price {
        display: block;
        font-size: 24px;
        font-weight: 800;
        color: var(--ink);
    }

    .hero-side {
        display: grid;
        gap: 14px;
    }

    .hero-product {
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid var(--line);
        background: var(--surface);
    }

    .hero-product img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
    }

    .hero-product-body {
        display: grid;
        gap: 8px;
        padding: 18px;
    }

    .point-grid,
    .category-grid,
    .product-grid,
    .info-grid,
    .detail-lower,
    .order-grid {
        display: grid;
        gap: 18px;
    }

    .point-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .category-grid { grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); }
    .product-grid { grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); }
    .info-grid,
    .detail-lower { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .order-grid { grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }

    .section-head {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 22px;
    }

    .section-head-main {
        display: grid;
        gap: 8px;
    }

    .section-head h2 { font-size: clamp(1.6rem, 3vw, 2.4rem); }

    .category-card,
    .order-card {
        padding: 20px;
        border-radius: var(--radius-md);
        border: 1px solid var(--line);
        background: rgba(255, 255, 255, 0.88);
        display: grid;
        gap: 12px;
    }

    .category-card:hover,
    .product-card:hover,
    .order-card:hover {
        transform: translateY(-3px);
    }

    .category-card,
    .product-card,
    .order-card,
    .hero-product {
        transition: transform 0.16s ease, border-color 0.16s ease;
    }

    .category-index,
    .pill,
    .chip,
    .tag,
    .stock-pill,
    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 800;
    }

    .category-index,
    .pill,
    .chip,
    .status-pill {
        background: var(--brand-soft);
        color: var(--brand);
    }

    .chip.active {
        background: var(--ink);
        color: white;
    }

    .tag,
    .product-specs span {
        background: rgba(27, 36, 48, 0.05);
        color: var(--muted);
    }

    .category-meta,
    .product-topline,
    .product-footer,
    .price-row,
    .results-bar,
    .cart-item-footer,
    .order-top,
    .summary-line,
    .breadcrumb,
    .inline-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .category-meta span:last-child,
    .order-total { font-weight: 800; color: var(--ink); }

    .card {
        border-radius: var(--radius-md);
        overflow: hidden;
    }

    .card-body { padding: 22px; }

    .product-card { display: grid; overflow: hidden; }

    .product-media {
        position: relative;
        background: linear-gradient(180deg, rgba(22, 33, 44, 0.04), rgba(22, 33, 44, 0.12));
    }

    .product-img,
    .detail-image,
    .cart-item-image {
        width: 100%;
        object-fit: cover;
        background: #dde5ea;
    }

    .product-img { aspect-ratio: 4 / 3; }
    .detail-image { aspect-ratio: 1 / 1; border-radius: 22px; }
    .cart-item-image { width: 88px; height: 88px; border-radius: 18px; }

    .product-badge {
        position: absolute;
        left: 14px;
        bottom: 14px;
        background: rgba(22, 33, 44, 0.82);
        color: white;
    }

    .product-body { display: grid; gap: 12px; }
    .product-topline { color: var(--muted); font-size: 13px; }
    .product-topline strong { color: var(--ink); font-size: 12px; letter-spacing: 0.08em; }

    .product-specs { display: flex; gap: 8px; flex-wrap: wrap; }

    .price {
        font-size: 25px;
        color: var(--accent);
    }

    .listing-shell,
    .detail-shell,
    .cart-layout,
    .checkout-shell,
    .form-shell,
    .grid.two,
    .admin-shell {
        display: grid;
        gap: 22px;
    }

    .listing-shell { grid-template-columns: minmax(235px, 275px) minmax(0, 1fr); align-items: start; }
    .detail-shell { grid-template-columns: minmax(0, 1fr) minmax(320px, 0.9fr); align-items: start; }
    .cart-layout { grid-template-columns: minmax(0, 1fr) minmax(280px, 330px); align-items: start; }
    .checkout-shell { grid-template-columns: minmax(0, 1fr) minmax(300px, 360px); align-items: start; }
    .form-shell,
    .grid.two { grid-template-columns: minmax(0, 1fr) minmax(260px, 320px); align-items: start; }
    .admin-shell { grid-template-columns: 220px minmax(0, 1fr); }

    .filter-card,
    .summary-card {
        position: sticky;
        top: 110px;
    }

    .detail-media { padding: 18px; }

    .spec-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .spec-item span {
        display: block;
        margin-bottom: 6px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .stock-pill {
        background: rgba(239, 125, 52, 0.14);
        color: #b85c1d;
    }

    .notice-panel { color: var(--muted); margin-bottom: 20px; }

    .breadcrumb {
        margin-bottom: 16px;
        color: var(--muted);
        font-size: 13px;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 88px minmax(0, 1fr);
        gap: 16px;
        padding: 18px;
    }

    .cart-item-body { display: grid; gap: 12px; }

    .inline-form input { max-width: 110px; }

    .summary-list strong,
    .timeline-item strong { color: var(--ink); }

    .timeline-item {
        border-left: 3px solid rgba(15, 118, 110, 0.2);
        border-radius: 0 16px 16px 0;
    }

    .auth-wrap { max-width: 540px; margin: 0 auto; }
    .checkbox-row { display: flex; align-items: center; gap: 10px; color: var(--muted); }

    input,
    select,
    textarea {
        width: 100%;
        border: 1px solid rgba(27, 36, 48, 0.12);
        border-radius: 16px;
        padding: 14px 16px;
        background: white;
        color: var(--ink);
        transition: border-color 0.16s ease, box-shadow 0.16s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: 0;
        border-color: rgba(15, 118, 110, 0.5);
        box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
    }

    input[type="checkbox"] {
        width: auto;
        accent-color: var(--brand);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .field { margin-bottom: 14px; }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: var(--radius-md);
        overflow: hidden;
    }

    th,
    td {
        padding: 15px 16px;
        border-bottom: 1px solid rgba(27, 36, 48, 0.08);
        text-align: left;
        vertical-align: top;
    }

    th {
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .alert {
        padding: 14px 18px;
        border-radius: 18px;
        border: 1px solid var(--line);
        background: white;
        box-shadow: var(--shadow);
    }

    .alert.success {
        border-color: rgba(15, 118, 110, 0.18);
        background: rgba(228, 244, 241, 0.92);
    }

    .alert.error {
        border-color: rgba(194, 65, 56, 0.18);
        background: rgba(255, 242, 241, 0.96);
    }

    hr {
        margin: 20px 0;
        border: 0;
        border-top: 1px solid rgba(27, 36, 48, 0.08);
    }

    .sidebar {
        padding: 14px;
        border-radius: var(--radius-md);
        background: #16212c;
        color: white;
        align-self: start;
    }

    .sidebar a {
        display: block;
        padding: 12px 14px;
        border-radius: 14px;
        color: rgba(255, 255, 255, 0.84);
        font-size: 14px;
        font-weight: 700;
    }

    .sidebar a:hover { background: rgba(255, 255, 255, 0.08); }

    .stat {
        padding: 22px;
        border-radius: var(--radius-md);
    }

    .stat strong {
        display: block;
        margin-bottom: 6px;
        font-size: 34px;
    }

    .empty-state { text-align: center; color: var(--muted); }

    .site-footer {
        margin-top: 30px;
        padding: 32px 0 44px;
        border-top: 1px solid rgba(27, 36, 48, 0.08);
    }

    .footer-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.2fr) repeat(2, minmax(0, 0.8fr));
        gap: 24px;
    }

    .footer-grid h3 {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .footer-grid p,
    .footer-grid a {
        color: var(--muted);
    }

    .footer-links {
        display: grid;
        gap: 10px;
    }

    .pagination-shell {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 28px;
        color: var(--muted);
        font-size: 13px;
    }

    .pagination-pages {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pagination-link,
    .pagination-dots {
        min-width: 42px;
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 14px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: white;
        color: var(--muted);
        font-weight: 700;
    }

    .pagination-link.is-current {
        background: var(--ink);
        border-color: transparent;
        color: white;
    }

    .pagination-link.is-disabled {
        opacity: 0.45;
        pointer-events: none;
    }

    @media (max-width: 960px) {
        .nav,
        .hero-shell,
        .listing-shell,
        .detail-shell,
        .cart-layout,
        .checkout-shell,
        .form-shell,
        .grid.two,
        .admin-shell,
        .footer-grid,
        .info-grid,
        .detail-lower,
        .point-grid,
        .hero-metrics {
            grid-template-columns: 1fr;
        }

        .page-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-links { margin-left: 0; }
        .filter-card,
        .summary-card { position: static; }
    }

    @media (max-width: 640px) {
        .container { width: min(100% - 24px, 100% - 24px); }

        .announcement-content,
        .nav-actions,
        .nav-links,
        .hero-actions,
        .page-hero-actions {
            align-items: stretch;
        }

        .announcement-content,
        .nav-links,
        .nav-actions {
            flex-direction: column;
        }

        .page-hero,
        .hero-shell,
        .card-body,
        .detail-media,
        .summary-card {
            padding: 20px;
        }

        .page-hero h1,
        .hero-copy h1 { font-size: 2rem; }

        .cart-item {
            grid-template-columns: 1fr;
        }

        .cart-item-image {
            width: 100%;
            height: auto;
            aspect-ratio: 4 / 3;
        }

        .spec-grid,
        .category-grid,
        .product-grid,
        .order-grid {
            grid-template-columns: 1fr;
        }

        table { display: block; overflow-x: auto; }
    }
</style>
