<?php
include("../sources/db/db.php");
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "coach"){
    header("location: ../pages/athlete_page.php");
    exit();
}

$sql="SELECT 
    R.client_id as id, 
    U.email,
    U.telephone,
    U.nom, 
    U.prenom, 
    U.role,
    S.nom as sport_nom, 
    R.date,
    R.heure,
    R.statut 
FROM users U 
INNER JOIN client CL ON U.id = CL.id_user
LEFT JOIN reservation R ON CL.id = R.client_id
LEFT JOIN coach C ON R.coach_id = C.id
LEFT JOIN sport_coach ON C.id = sport_coach.coach_id 
LEFT JOIN sport S ON S.id = sport_coach.sport_id 
WHERE U.role = 'client'";

    $result=mysqli_query($conn,$sql);

    $clients=[];

    while($row=mysqli_fetch_assoc($result)){
        $clients[]=$row;
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
                    <a href="" class="flex items-center">
                        <i class="fas fa-dumbbell text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-2xl font-bold text-indigo-600">CoachSport</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="" class="text-indigo-600 px-3 py-2 rounded-md font-medium">Dashboard</a>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Coach - <span class="text-indigo-600"><?php echo $_SESSION["user_prenom"]?></span></h1>
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

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($clients as $client): ?>
        <?php if($client['role']=="client"): ?>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <!-- En-tête avec photo -->
            <div class="relative h-48 bg-gradient-to-br from-green-50 to-emerald-100">
                <?php if (!empty($client['photo_client'])): ?>
                    <img style="border-radius:100%; display:block ; margin:auto; object-fit: cover; width: 160px; height: 160px;" src="<?= $client['photo_client'] ?>" 
                         alt="<?= $client['prenom'] . ' ' . $client['nom'] ?>" 
                         class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-user-circle text-gray-400 text-7xl mb-2"></i>
                            <p class="text-gray-500 font-medium">Client</p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Badge statut réservation -->
                <?php if ($client['statut']): ?>
                <div class="absolute top-4 right-4 px-3 py-1.5 rounded-full text-sm font-bold shadow-lg
                    <?php 
                    switch($client['statut']) {
                        case 'confirmée': echo 'bg-green-500 text-white'; break;
                        case 'en attente': echo 'bg-yellow-500 text-white'; break;
                        case 'annulée': echo 'bg-red-500 text-white'; break;
                        default: echo 'bg-gray-500 text-white';
                    }
                    ?>">
                    <?= ucfirst($client['statut']) ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Contenu -->
            <div class="p-6">
                <!-- Nom et réservation -->
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">
                        <?= $client['prenom'] ?> 
                        <span class="text-emerald-600"><?= $client['nom'] ?></span>
                    </h3>
                    <?php if ($client['sport_nom']): ?>
                    <div class="inline-flex items-center bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-sm">
                        <i class="fas fa-running mr-2"></i>
                        <?= $client['sport_nom'] ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Informations -->
                <div class="space-y-3 mb-6">
                    <!-- Email -->
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-blue-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Email</p>
                            <p class="text-gray-800 font-medium text-sm"><?= $client['email'] ?></p>
                        </div>
                    </div>
                    
                    <!-- Téléphone -->
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-phone text-green-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Téléphone</p>
                            <p class="text-gray-800 font-medium text-sm"><?= $client['telephone'] ?></p>
                        </div>
                    </div>
                    
                    <!-- Date de réservation -->
                    <?php if ($client['date']): ?>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-purple-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Réservation</p>
                            <p class="text-gray-800 font-medium text-sm">
                                <?= date('d/m/Y', strtotime($client['date'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Biographie (si existe) -->
                <?php if (!empty($client['biographie'])): ?>
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-gray-600 text-sm italic">
                        <i class="fas fa-quote-left text-emerald-300 mr-1"></i>
                        <?= substr($client['biographie'], 0, 100) . (strlen($client['biographie']) > 100 ? '...' : '') ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <!-- Bouton de contact -->
                <button type="button" onclick="contacterClient(<?= $client['id'] ?>)" 
                        class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Contacter ce client
                </button>
            </div>
            
            <!-- Footer avec note -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-700 font-semibold">4.5</span>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-700">Client</p>
                        <p class="text-xs text-gray-500"><?= $client['role'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
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
