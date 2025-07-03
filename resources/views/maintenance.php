<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | E-Inspection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2eafc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .maintenance-card {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            border-radius: 1.5rem;
            background: #fff;
            padding: 2.5rem 2rem;
            max-width: 420px;
            width: 100%;
            text-align: center;
        }
        .maintenance-icon {
            font-size: 4rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .maintenance-title {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .maintenance-desc {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="maintenance-card">
        <div class="maintenance-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                <path d="M1 0a1 1 0 0 1 1 1v2.293l2.146-2.147a.5.5 0 0 1 .708.708L2.707 4H5a1 1 0 0 1 1 1v2.293l2.146-2.147a.5.5 0 0 1 .708.708L6.707 8H9a1 1 0 0 1 1 1v2.293l2.146-2.147a.5.5 0 0 1 .708.708L10.707 12H13a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2.293l-2.147 2.146a.5.5 0 1 1-.708-.708L4 10.707V9a1 1 0 0 1 1-1h2.293l-2.147 2.146a.5.5 0 1 1-.708-.708L8 6.707V5a1 1 0 0 1 1-1h2.293l-2.147 2.146a.5.5 0 1 1-.708-.708L12 2.707V1a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2.293l2.147-2.146a.5.5 0 1 1 .708.708L12 5.293V7a1 1 0 0 1-1 1H8.707l2.147-2.146a.5.5 0 1 1 .708.708L6 9.293V11a1 1 0 0 1-1 1H2.707l2.147-2.146a.5.5 0 1 1 .708.708L4 13.293V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2.293l-2.147 2.146a.5.5 0 1 1-.708-.708L4 10.707V9a1 1 0 0 1 1-1h2.293l-2.147 2.146a.5.5 0 1 1-.708-.708L8 6.707V5a1 1 0 0 1 1-1h2.293l-2.147 2.146a.5.5 0 1 1-.708-.708L12 2.707V1a1 1 0 0 1 1-1h2z"/>
            </svg>
        </div>
        <div class="maintenance-title">Sistem Sedang Diselenggara</div>
        <div class="maintenance-desc">
            Kami sedang melakukan penyelenggaraan berkala untuk meningkatkan mutu sistem.<br>
            Sila kembali semula selepas beberapa ketika.<br>
            <span class="fw-semibold">Terima kasih atas kesabaran anda.</span>
        </div>
        <div class="text-muted small">&copy; <?php echo date('Y'); ?> E-Inspection</div>
    </div>
</body>
</html>
