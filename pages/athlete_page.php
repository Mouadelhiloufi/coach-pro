<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "client"){
    header("location: ../pages/athlete_page.php");
    exit();
}
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation with logout form -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center">
                        <i class="fas fa-dumbbell text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-2xl font-bold text-indigo-600">CoachSport</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="coaches.html" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Coachs</a>
                    <a href="athlete-dashboard.html" class="text-indigo-600 px-3 py-2 rounded-md font-medium">Mon Espace</a>
                    <form action="backend/logout.php" method="POST" class="inline">
                        <button type="submit" class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md font-medium">
                            <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Welcome section with PHP-generated username -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Bienvenue, <span class="text-indigo-600">Jean Martin</span>!</h1>
            <p class="text-gray-600">Gérez vos réservations et suivez votre progression sportive</p>
        </div>

        <!-- Stats with PHP-generated data -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Séances à venir</p>
                        <p class="text-3xl font-bold">3</p>
                    </div>
                    <i class="fas fa-calendar-day text-4xl text-blue-200"></i>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Séances validées</p>
                        <p class="text-3xl font-bold">12</p>
                    </div>
                    <i class="fas fa-check-circle text-4xl text-green-200"></i>
                </div>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Total séances</p>
                        <p class="text-3xl font-bold">15</p>
                    </div>
                    <i class="fas fa-chart-line text-4xl text-purple-200"></i>
                </div>
            </div>
        </div>

        <!-- Bookings section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Mes Réservations</h2>
            
            <!-- Tabs with simple onclick -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="window.location.href='athlete-dashboard.html?tab=upcoming'" class="border-indigo-500 text-indigo-600 py-2 px-1 border-b-2 font-medium text-sm">
                        À venir
                    </button>
                    <button onclick="window.location.href='athlete-dashboard.html?tab=past'" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 border-b-2 font-medium text-sm">
                        Historique
                    </button>
                </nav>
            </div>

            <!-- Example booking card - PHP will generate these -->
            <div class="space-y-4">
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">Coach Jean Dupont</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar text-indigo-600 mr-2"></i> 20 Décembre 2024
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-clock text-indigo-600 mr-2"></i> 14:00 - 15:00
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-running text-indigo-600 mr-2"></i> Football
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Confirmée</span>
                            <form action="backend/cancel-booking.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                                <input type="hidden" name="booking_id" value="1">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-times mr-1"></i> Annuler
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- More bookings will be generated by PHP -->
            </div>
        </div>
    </div>
</body>
</html>
