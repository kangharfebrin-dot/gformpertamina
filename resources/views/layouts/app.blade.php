<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Monitoring Penyaluran & Stok - Pertamina Patra Niaga FT Maos')</title>
    <!-- Google Fonts: Roboto & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --pertamina-red: #E31E24;
            --pertamina-blue: #005BAA;
            --pertamina-green: #82BC23;
            --pertamina-dark: #1E293B;
            --pertamina-light-bg: #F0F4F9;
            --card-border-radius: 12px;
            --card-shadow: 0 1px 3px rgba(60, 64, 67, 0.15), 0 2px 6px 2px rgba(60, 64, 67, 0.05);
            --focus-shadow: 0 1px 3px rgba(0, 0, 0, 0.2), 0 4px 8px rgba(0, 91, 170, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Inter', sans-serif;
            background-color: var(--pertamina-light-bg);
            color: #202124;
            line-height: 1.5;
            min-height: 100vh;
            padding-bottom: 60px;
        }

        /* Top Navigation Header */
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--pertamina-dark);
            font-weight: 700;
            font-size: 16px;
        }

        .navbar-logo-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--pertamina-red) 33%, var(--pertamina-blue) 33% 66%, var(--pertamina-green) 66%);
            padding: 2px;
            border-radius: 4px;
        }

        .navbar-logo-inner {
            background: #ffffff;
            padding: 4px 8px;
            border-radius: 2px;
            font-size: 12px;
            font-weight: 800;
            color: var(--pertamina-dark);
            letter-spacing: 0.5px;
        }

        .navbar-nav {
            display: flex;
            gap: 12px;
        }

        .nav-link {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            color: #5f6368;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link:hover {
            background-color: #f1f3f4;
            color: var(--pertamina-blue);
        }

        .nav-link.active {
            background-color: #e8f0fe;
            color: var(--pertamina-blue);
            font-weight: 600;
        }

        /* Container Layout */
        .form-container {
            max-width: 770px;
            margin: 24px auto 0 auto;
            padding: 0 16px;
        }

        /* Cards Base */
        .gf-card {
            background: #ffffff;
            border-radius: var(--card-border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 16px;
            padding: 24px;
            position: relative;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #dadce0;
        }

        .gf-card.focused {
            border-left: 5px solid var(--pertamina-blue);
            box-shadow: var(--focus-shadow);
        }

        /* Header Form Card */
        .gf-header-card {
            border-top: 10px solid var(--pertamina-red);
            border-radius: 12px;
            overflow: hidden;
            padding: 0;
        }

        .gf-header-banner {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .gf-header-content {
            padding: 24px 28px 20px 28px;
            border-top: 4px solid var(--pertamina-blue);
        }

        .gf-form-title {
            font-size: 28px;
            font-weight: 400;
            color: #202124;
            margin-bottom: 8px;
            line-height: 1.25;
        }

        .gf-form-subtitle {
            font-size: 14px;
            color: #5f6368;
            margin-bottom: 16px;
        }

        .gf-form-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #f1f3f4;
            color: #3c4043;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .gf-divider {
            height: 1px;
            background-color: #dadce0;
            margin: 16px 0;
        }

        .gf-required-note {
            color: var(--pertamina-red);
            font-size: 13px;
        }

        /* Form Question Components */
        .gf-question-title {
            font-size: 16px;
            font-weight: 500;
            color: #202124;
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
            gap: 4px;
        }

        .gf-required-star {
            color: var(--pertamina-red);
            font-weight: bold;
        }

        .gf-question-desc {
            font-size: 13px;
            color: #70757a;
            margin-bottom: 14px;
        }

        .gf-input-text {
            width: 100%;
            max-width: 360px;
            border: none;
            border-bottom: 1px solid #70757a;
            padding: 8px 0;
            font-size: 14px;
            font-family: inherit;
            color: #202124;
            outline: none;
            background: transparent;
            transition: border-color 0.2s ease;
        }

        .gf-input-text:focus {
            border-bottom: 2px solid var(--pertamina-blue);
        }

        .gf-input-full {
            max-width: 100%;
        }

        /* Section Header Cards */
        .gf-section-card {
            background: linear-gradient(135deg, #005BAA 0%, #004B87 100%);
            color: #ffffff;
            border: none;
        }

        .gf-section-card .gf-section-title {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .gf-section-card .gf-section-subtitle {
            font-size: 13px;
            color: #e0e7ff;
            margin-top: 4px;
        }

        /* Form Actions Buttons */
        .gf-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            margin-bottom: 36px;
        }

        .btn-gf-submit {
            background-color: var(--pertamina-red);
            color: #ffffff;
            border: none;
            padding: 10px 24px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.25px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-gf-submit:hover {
            background-color: #c8181d;
            box-shadow: 0 2px 6px rgba(227, 30, 36, 0.3);
        }

        .btn-gf-clear {
            background: transparent;
            color: var(--pertamina-blue);
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .btn-gf-clear:hover {
            background-color: rgba(0, 91, 170, 0.08);
        }

        /* Alerts & Verification Messages */
        .gf-alert-error {
            background-color: #fce8e6;
            border-left: 4px solid var(--pertamina-red);
            color: #c5221f;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 13px;
            margin-top: 8px;
        }

        /* Footer Branding */
        .gf-footer {
            text-align: center;
            font-size: 12px;
            color: #70757a;
            margin-top: 40px;
        }

        .gf-footer a {
            color: var(--pertamina-blue);
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 0 8px;
                margin-top: 12px;
            }

            .gf-card {
                padding: 16px;
            }

            .gf-input-text {
                max-width: 100%;
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Header Navigation -->
    <nav class="navbar">
        <a href="{{ route('monitoring.form') }}" class="navbar-brand">
            <div class="navbar-logo-badge">
                <div class="navbar-logo-inner">PERTAMINA</div>
            </div>
            <span>Patra Niaga FT Maos</span>
        </a>
        <div class="navbar-nav">
            <a href="{{ route('monitoring.form') }}"
                class="nav-link {{ request()->routeIs('monitoring.form') ? 'active' : '' }}">
                <i class="fa-regular fa-file-lines"></i> Formulir Input
            </a>
            <a href="{{ route('monitoring.responses') }}"
                class="nav-link {{ request()->routeIs('monitoring.responses') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells"></i> Data Rekap (Sheets)
            </a>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="form-container">
        @yield('content')

        <footer class="gf-footer">
            <p>Formulir Monitoring Penyaluran & Stok Tangki &bull; <strong>Pertamina Patra Niaga Fuel Terminal
                    Maos</strong></p>
            <p style="margin-top: 4px;">Sistem Otomasi Input Data Operasional &copy; {{ date('Y') }}</p>
        </footer>
    </main>

    <script>
        // Interactive Google Form Card Focus Effect
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.gf-input-text, select, input[type="date"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    const card = this.closest('.gf-card');
                    if (card && !card.classList.contains('gf-header-card') && !card.classList.contains('gf-section-card')) {
                        document.querySelectorAll('.gf-card').forEach(c => c.classList.remove('focused'));
                        card.classList.add('focused');
                    }
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>