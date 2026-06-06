<style>
    :root {
        --ink: #16202a;
        --muted: #64748b;
        --line: rgba(22, 32, 42, 0.1);
        --paper: #f3f5f7;
        --surface: #ffffff;
        --surface-soft: #f7fafc;
        --brand: #0f766e;
        --brand-strong: #0b5b55;
        --brand-soft: #ddf5f1;
        --accent: #f97316;
        --accent-soft: #fff1e7;
        --accent-strong: #d95f0e;
        --navy: #17324d;
        --danger: #c24138;
        --radius-xl: 34px;
        --radius-lg: 26px;
        --radius-md: 20px;
        --radius-sm: 14px;
        --shadow-lg: 0 24px 60px rgba(22, 32, 42, 0.12);
        --shadow-md: 0 16px 34px rgba(22, 32, 42, 0.08);
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
        margin: 0;
        font-family: 'Manrope', sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at top left, rgba(15, 118, 110, 0.1), transparent 25%),
            radial-gradient(circle at top right, rgba(249, 115, 22, 0.12), transparent 20%),
            linear-gradient(180deg, #fbfcfd 0%, var(--paper) 100%);
    }

    a { color: inherit; text-decoration: none; }
    img { display: block; max-width: 100%; }
    button, input, select, textarea { font: inherit; }

    h1, h2, h3, h4 {
        margin: 0;
        font-weight: 800;
        letter-spacing: -0.04em;
        line-height: 1.02;
    }

    p { margin: 0; line-height: 1.68; }
    .container { width: min(1200px, calc(100% - 32px)); margin: 0 auto; }

    .announcement-bar {
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-strong) 100%);
        color: white;
        font-size: 13px;
        font-weight: 700;
    }

    .announcement-content {
        min-height: 42px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .announcement-note {
        background: rgba(255, 255, 255, 0.18);
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .site-header {
        position: sticky;
        top: 0;
        z-index: 40;
        backdrop-filter: blur(16px);
    }

    .topbar {
        background: rgba(255, 255, 255, 0.88);
        border-bottom: 1px solid rgba(22, 32, 42, 0.08);
    }

    .nav {
        min-height: 80px;
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
        width: 46px;
        height: 46px;
        display: inline-grid;
        place-items: center;
        border-radius: 15px;
        background: linear-gradient(135deg, var(--brand) 0%, var(--navy) 100%);
        color: white;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.08em;
        box-shadow: 0 14px 28px rgba(15, 118, 110, 0.22);
    }

    .brand-copy {
        display: grid;
        gap: 2px;
    }

    .brand-copy strong {
        font-size: 17px;
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
    .tag-list,
    .category-pills,
    .feature-strip {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .nav-links { margin-left: auto; }

    .nav-links a {
        padding: 10px 14px;
        border-radius: 999px;
        color: var(--muted);
        font-size: 14px;
        font-weight: 700;
        transition: background 0.16s ease, color 0.16s ease;
    }

    .nav-links a.active,
    .nav-links a:hover {
        background: var(--brand-soft);
        color: var(--brand);
    }

    .btn,
    button {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 20px;
        border: 0;
        border-radius: 999px;
        cursor: pointer;
        font-weight: 800;
        transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-strong) 100%);
        color: white;
        box-shadow: 0 16px 28px rgba(249, 115, 22, 0.2);
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
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-strong) 100%);
        box-shadow: 0 14px 24px rgba(15, 118, 110, 0.18);
    }

    .btn.light {
        background: var(--brand-soft);
        color: var(--brand);
        box-shadow: none;
    }

    .btn.ghost {
        background: rgba(255, 255, 255, 0.88);
        color: var(--ink);
        border: 1px solid var(--line);
        box-shadow: none;
    }

    .btn.danger {
        background: var(--danger);
        box-shadow: none;
    }

    .btn.block {
        width: 100%;
    }

    .link-button {
        min-height: auto;
        padding: 0;
        background: transparent;
        color: var(--muted);
        box-shadow: none;
    }

    .page-shell { padding: 26px 0 76px; }
    .alert-stack { display: grid; gap: 12px; margin-bottom: 12px; }
    .section { padding: 38px 0; }
    .section.tight { padding-top: 18px; }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: var(--accent-strong);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .eyebrow::before {
        content: '';
        width: 28px;
        height: 1px;
        background: rgba(249, 115, 22, 0.45);
    }

    .hero-shell,
    .page-hero,
    .card,
    table,
    .sidebar,
    .stat {
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(22, 32, 42, 0.08);
        box-shadow: var(--shadow-md);
    }

    .hero-shell,
    .page-hero {
        border-radius: var(--radius-xl);
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
        font-size: clamp(2.3rem, 4.8vw, 4.4rem);
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
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: minmax(0, 1.18fr) minmax(300px, 0.82fr);
        gap: 24px;
        padding: 36px;
        background:
            radial-gradient(circle at top right, rgba(255, 255, 255, 0.26), transparent 28%),
            linear-gradient(135deg, #12324b 0%, #0f766e 54%, #f97316 100%);
        color: white;
        box-shadow: var(--shadow-lg);
    }

    .hero-shell::after {
        content: '';
        position: absolute;
        inset: auto -60px -100px auto;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .hero-copy,
    .hero-side {
        position: relative;
        z-index: 1;
    }

    .hero-copy .eyebrow,
    .hero-copy p,
    .hero-copy .metric-pill span,
    .hero-copy .feature-badge {
        color: rgba(255, 255, 255, 0.88);
    }

    .hero-copy .eyebrow::before {
        background: rgba(255, 255, 255, 0.45);
    }

    .hero-actions,
    .page-hero-actions { margin-top: 22px; }

    .hero-actions .btn.secondary {
        background: rgba(255, 255, 255, 0.14);
        box-shadow: none;
        border: 1px solid rgba(255, 255, 255, 0.16);
    }

    .hero-actions .btn.ghost {
        background: white;
        border-color: transparent;
    }

    .hero-metrics,
    .summary-list,
    .timeline,
    .filter-form,
    .item-stack,
    .order-stack,
    .promo-stack,
    .hero-product-list,
    .feature-list {
        display: grid;
        gap: 12px;
    }

    .hero-metrics {
        margin-top: 24px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .metric-pill,
    .point-card,
    .spec-item,
    .notice-panel,
    .timeline-item,
    .summary-card,
    .results-bar,
    .empty-state,
    .promo-banner,
    .feature-card {
        padding: 16px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--line);
        background: var(--surface-soft);
    }

    .hero-shell .metric-pill {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(6px);
    }

    .metric-pill strong,
    .price {
        display: block;
        font-size: 24px;
        font-weight: 800;
        color: var(--ink);
    }

    .hero-shell .metric-pill strong {
        color: white;
    }

    .hero-side {
        display: grid;
        gap: 14px;
    }

    .hero-product {
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.14);
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
    }

    .hero-product img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }

    .hero-product-body {
        display: grid;
        gap: 8px;
        padding: 18px;
        color: white;
    }

    .feature-strip {
        margin-top: 20px;
    }

    .feature-badge {
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.14);
        font-size: 13px;
        font-weight: 700;
    }

    .point-grid,
    .category-grid,
    .product-grid,
    .info-grid,
    .detail-lower,
    .order-grid,
    .promo-grid,
    .showcase-grid {
        display: grid;
        gap: 18px;
    }

    .point-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .category-grid { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
    .product-grid { grid-template-columns: repeat(auto-fit, minmax(235px, 1fr)); }
    .info-grid,
    .detail-lower,
    .promo-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .showcase-grid { grid-template-columns: 1.2fr 0.8fr; }
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

    .section-head h2 { font-size: clamp(1.8rem, 3vw, 2.7rem); }

    .category-card,
    .order-card {
        border-radius: var(--radius-lg);
        border: 1px solid rgba(22, 32, 42, 0.08);
        background: rgba(255, 255, 255, 0.94);
        display: grid;
    }

    .category-card {
        padding: 0;
        overflow: hidden;
        gap: 0;
    }

    .order-card {
        padding: 20px;
        gap: 14px;
    }

    .category-card:hover,
    .product-card:hover,
    .order-card:hover {
        transform: translateY(-4px);
    }

    .category-card,
    .product-card,
    .order-card,
    .hero-product,
    .promo-banner {
        transition: transform 0.18s ease, border-color 0.18s ease, box-shadow 0.18s ease;
    }

    .category-card-body {
        padding: 20px;
        display: grid;
        gap: 12px;
    }

    .category-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .category-visual {
        min-height: 120px;
        background: linear-gradient(135deg, #def7f2 0%, #fff0e6 100%);
        display: grid;
        place-items: center;
        font-size: 44px;
    }

    .category-index,
    .pill,
    .chip,
    .tag,
    .stock-pill,
    .status-pill,
    .promo-pill {
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

    .status-pill.info {
        background: rgba(14, 116, 144, 0.12);
        color: #0f766e;
    }

    .status-pill.success {
        background: rgba(22, 163, 74, 0.12);
        color: #166534;
    }

    .status-pill.warning {
        background: rgba(249, 115, 22, 0.12);
        color: #c2410c;
    }

    .status-pill.danger {
        background: rgba(194, 65, 56, 0.12);
        color: #991b1b;
    }

    .promo-pill {
        background: rgba(255, 255, 255, 0.16);
        color: white;
    }

    .chip.active {
        background: var(--navy);
        color: white;
    }

    .tag,
    .product-specs span {
        background: rgba(22, 32, 42, 0.05);
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
    .inline-form,
    .promo-banner-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .category-meta span:last-child,
    .order-total { font-weight: 800; color: var(--ink); }

    .order-actions,
    .toolbar,
    .admin-action-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .card {
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .card-body { padding: 22px; }

    .product-card {
        display: grid;
        overflow: hidden;
        border-radius: var(--radius-lg);
        background: white;
        box-shadow: var(--shadow-md);
    }

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
        top: 14px;
        background: white;
        color: var(--brand);
        box-shadow: 0 10px 18px rgba(22, 32, 42, 0.08);
    }

    .product-body { display: grid; gap: 12px; }
    .product-topline { color: var(--muted); font-size: 13px; }
    .product-topline strong { color: var(--ink); font-size: 12px; letter-spacing: 0.08em; text-transform: uppercase; }

    .product-specs { display: flex; gap: 8px; flex-wrap: wrap; }

    .price {
        font-size: 26px;
        color: var(--accent-strong);
    }

    .listing-shell,
    .detail-shell,
    .cart-layout,
    .checkout-shell,
    .form-shell,
    .grid.two,
    .admin-shell,
    .admin-content-grid {
        display: grid;
        gap: 22px;
    }

    .listing-shell { grid-template-columns: minmax(235px, 275px) minmax(0, 1fr); align-items: start; }
    .detail-shell { grid-template-columns: minmax(0, 1fr) minmax(320px, 0.92fr); align-items: start; }
    .cart-layout { grid-template-columns: minmax(0, 1fr) minmax(280px, 330px); align-items: start; }
    .checkout-shell { grid-template-columns: minmax(0, 1fr) minmax(300px, 360px); align-items: start; }
    .form-shell,
    .grid.two { grid-template-columns: minmax(0, 1fr) minmax(260px, 320px); align-items: start; }
    .admin-shell { grid-template-columns: 220px minmax(0, 1fr); }
    .admin-content-grid { grid-template-columns: minmax(0, 1.2fr) minmax(290px, 0.8fr); align-items: start; }

    .order-side-stack {
        display: grid;
        gap: 18px;
    }

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
        background: var(--accent-soft);
        color: var(--accent-strong);
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

    .promo-banner {
        position: relative;
        overflow: hidden;
        padding: 24px;
        background: linear-gradient(135deg, #16324b 0%, #0f766e 100%);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .promo-banner.alt {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    }

    .promo-banner p,
    .promo-banner .muted {
        color: rgba(255, 255, 255, 0.86);
    }

    .promo-banner h3 {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .promo-banner::after {
        content: '';
        position: absolute;
        right: -36px;
        bottom: -56px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .feature-card {
        display: grid;
        gap: 8px;
        background: white;
    }

    input,
    select,
    textarea {
        width: 100%;
        border: 1px solid rgba(22, 32, 42, 0.12);
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
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .table-shell {
        overflow: hidden;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(22, 32, 42, 0.08);
        background: rgba(255, 255, 255, 0.94);
        box-shadow: var(--shadow-md);
    }

    th,
    td {
        padding: 15px 16px;
        border-bottom: 1px solid rgba(22, 32, 42, 0.08);
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
        box-shadow: var(--shadow-md);
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
        border-top: 1px solid rgba(22, 32, 42, 0.08);
    }

    .sidebar {
        padding: 14px;
        border-radius: var(--radius-lg);
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
        border-radius: var(--radius-lg);
    }

    .stat strong {
        display: block;
        margin-bottom: 6px;
        font-size: 34px;
    }

    .admin-thumb {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        object-fit: cover;
        border: 1px solid rgba(22, 32, 42, 0.08);
        background: #edf2f7;
    }

    .admin-preview-card {
        display: grid;
        grid-template-columns: 120px minmax(0, 1fr);
        gap: 16px;
        align-items: center;
        margin-bottom: 18px;
        padding: 16px;
        border-radius: var(--radius-md);
        background: var(--surface-soft);
        border: 1px solid rgba(22, 32, 42, 0.08);
    }

    .admin-preview-image {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 18px;
        background: #edf2f7;
    }

    .empty-state { text-align: center; color: var(--muted); }

    .site-footer {
        margin-top: 34px;
        padding: 34px 0 48px;
        border-top: 1px solid rgba(22, 32, 42, 0.08);
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
        background: var(--navy);
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
        .hero-metrics,
        .promo-grid,
        .showcase-grid,
        .admin-content-grid {
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
        .summary-card,
        .promo-banner,
        .order-card {
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
        .order-grid,
        .promo-grid {
            grid-template-columns: 1fr;
        }

        table { display: block; overflow-x: auto; }

        .admin-preview-card {
            grid-template-columns: 1fr;
        }
    }
</style>
