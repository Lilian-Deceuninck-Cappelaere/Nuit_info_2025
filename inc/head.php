<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La démarche NIRD</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="page-wrapper">

        <header class="app-header">
            <div class="header-content">
                <div class="header-top">
                    <div class="brand">
                        <img src="assets/images/logo.png" alt="Logo NIRD" class="logo">
                        <h1>La démarche NIRD</h1>
                    </div>
                    <button class="user-btn" aria-label="Mon Compte">
                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                </div>

                <nav class="breadcrumbs">
                    <a href="index.html" class="breadcrumb-link">Accueil</a>
                    <span class="separator">&gt;</span>
                </nav>
            </div>
        </header>

        <?= include dirname(__FILE__) . '/top.php' ?>