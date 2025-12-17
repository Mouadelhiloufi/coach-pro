<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "coach"){
    header("location: ../pages/athlete_page.php");
    exit();
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Coach - CoachSport</title>
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
                    <a href="coach_page.php" class="text-indigo-600 px-3 py-2 rounded-md font-medium">Dashboard</a>
                    <a href="profile_coach.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">
                        <i class="fas fa-user mr-1"></i> Profil
                    </a>
                    
                            <button onclick="window.location.href='../pages/logout.php'" 
                          class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md font-medium transition">
                         <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                     </button>
                    
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Welcome section with PHP-generated name -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Coach - <span class="text-indigo-600">Jean Dupont</span></h1>
            <p class="text-gray-600">Gérez vos réservations, disponibilités et profil professionnel</p>
        </div>

        <!-- Stats Grid with PHP-generated data -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm">En attente</p>
                        <p class="text-3xl font-bold">5</p>
                    </div>
                    <i class="fas fa-clock text-4xl text-orange-200"></i>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Aujourd'hui</p>
                        <p class="text-3xl font-bold">2</p>
                    </div>
                    <i class="fas fa-calendar-day text-4xl text-blue-200"></i>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Demain</p>
                        <p class="text-3xl font-bold">3</p>
                    </div>
                    <i class="fas fa-calendar-plus text-4xl text-green-200"></i>
                </div>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Total validées</p>
                        <p class="text-3xl font-bold">47</p>
                    </div>
                    <i class="fas fa-check-double text-4xl text-purple-200"></i>
                </div>
            </div>
        </div>

        <!-- Bookings Management -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Gestion des Réservations</h2>
            
            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="window.location.href='coach-dashboard.html?tab=pending'" class="border-indigo-500 text-indigo-600 py-2 px-1 border-b-2 font-medium text-sm">
                        En attente
                    </button>
                    <button onclick="window.location.href='coach-dashboard.html?tab=upcoming'" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 border-b-2 font-medium text-sm">
                        À venir
                    </button>
                    <button onclick="window.location.href='coach-dashboard.html?tab=past'" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 border-b-2 font-medium text-sm">
                        Historique
                    </button>
                </nav>
            </div>

            <!-- Example booking card - PHP will generate these -->
            <div class="space-y-4">
                <div class="border border-orange-200 bg-orange-50 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">Marie Laurent</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar text-indigo-600 mr-2"></i> 18 Décembre 2024
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-clock text-indigo-600 mr-2"></i> 10:00 - 11:00
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-running text-indigo-600 mr-2"></i> Tennis
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <form action="backend/accept-booking.php" method="POST" class="inline">
                                <input type="hidden" name="booking_id" value="1">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition text-sm">
                                    <i class="fas fa-check mr-1"></i> Accepter
                                </button>
                            </form>
                            <form action="backend/reject-booking.php" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment refuser cette demande ?')">
                                <input type="hidden" name="booking_id" value="1">
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition text-sm">
                                    <i class="fas fa-times mr-1"></i> Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- More bookings will be generated by PHP -->
            </div>
        </div>

        <!-- Availability Management -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Mes Disponibilités</h2>
            
            <!-- Add availability form -->
            <form action="backend/add-availability.php" method="POST" class="mb-6 p-4 border border-gray-200 rounded-lg">
                <h3 class="font-semibold mb-4">Ajouter une disponibilité</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" name="date" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heure début</label>
                        <input type="time" name="start_time" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heure fin</label>
                        <input type="time" name="end_time" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                    <i class="fas fa-plus mr-2"></i> Ajouter
                </button>
            </form>

            <!-- Example availability slots - PHP will generate these -->
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 border border-gray-200 rounded-md">
                    <div>
                        <p class="font-medium">Lundi 18 Décembre 2024</p>
                        <p class="text-sm text-gray-600">09:00 - 12:00</p>
                    </div>
                    <form action="backend/delete-availability.php" method="POST" class="inline" onsubmit="return confirm('Supprimer cette disponibilité ?')">
                        <input type="hidden" name="availability_id" value="1">
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                <!-- More availability slots will be generated by PHP -->
            </div>
        </div>
    </div>
</body>
</html>
