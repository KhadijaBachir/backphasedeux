<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fichiers et chemins autorisés
    |--------------------------------------------------------------------------
    | La liste des chemins d'API qui doivent autoriser les requêtes cross-origin
    | (CORS). Cela inclut tous les chemins nécessaires pour Sanctum et l'API.
    */
    'paths' => [
        'api/*', 
        'sanctum/csrf-cookie',
        'login',
        'logout',
        'register',
        'user',
        'forgot-password',
        'reset-password'
    ],

    /*
    |--------------------------------------------------------------------------
    | Méthodes autorisées
    |--------------------------------------------------------------------------
    | Les méthodes HTTP autorisées. '*' autorise toutes les méthodes (GET, POST, etc.).
    */
    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Origines autorisées
    |--------------------------------------------------------------------------
    | C'est la liste des domaines qui sont autorisés à faire des requêtes vers votre API.
    | Nous ajoutons l'URL de votre frontend Vercel ici.
    */
    'allowed_origins' => [
        // Locaux (pour le développement)
        'http://127.0.0.1:5173',
        'http://localhost:5173',
        'http://localhost:8080',
        'http://127.0.0.1:8080',
        
        // Domaines de Production/Staging (Vercel)
        'https://backphasedeux.vercel.app/', 
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Support des identifiants (Cookies)
    |--------------------------------------------------------------------------
    | Doit être réglé sur 'true' pour que les cookies (Sanctum/CSRF)
    | soient inclus dans la requête cross-origin.
    */
    'supports_credentials' => true,
];