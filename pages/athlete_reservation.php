<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "client"){
    header("location: ../pages/athlete_page.php");
    exit();
}

include("../sources/db/db.php");

// Votre requête SQL
$sql = "SELECT 
    U.role,
    U.id,
    U.nom, 
    U.prenom, 
    U.email, 
    U.telephone,
    C.id,
    C.image_coach,
    C.experience,
    C.biographie,
    S.nom as sport_nom,
    D.date as dispo_date,
    D.heure_debut
FROM users U 
INNER JOIN coach C ON C.id_user = U.id 
LEFT JOIN disponibility D ON C.id = D.coach_id 
LEFT JOIN sport_coach SC ON SC.coach_id = C.id 
LEFT JOIN sport S ON S.id = SC.sport_id
-- LEFT JOIN reservation R on C.id=R.coach_id
WHERE U.role = 'coach'";


// Exécution de la requête
$result = mysqli_query($conn, $sql);
$coachs = []; // Initialiser le tableau



// Récupérer tous les résultats dans un tableau
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $coachs[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_coach'])) {


   $date_reservation= $_POST["date_reservation"];
   $heure_reservation= $_POST["heure_reservation"];

    $client_id=$_SESSION["user_id"];
    $id_coach=$_POST["id_coach"];
    
    $date=$date_reservation;
    
    $heure=$heure_reservation;
    $statut="en attente";

    $sql_prepare=$conn->prepare("INSERT into reservation(date,heure,statut,client_id,coach_id)
    values(?,?,?,?,?)");
    $sql_prepare->bind_param("sssii",$date,$heure,$statut,$client_id,$id_coach);
    $sql_prepare->execute();

}




?>








<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Coachs - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Updated navigation with better styling -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center">
                        <i class="fas fa-dumbbell text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-2xl font-bold text-indigo-600">CoachSport</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="athlete_page.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium transition">
                        <i class="fas fa-home mr-1"></i> Accueil
                    </a>
                    <a href="logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                        <i class="fas fa-sign-in-alt mr-1"></i> Deconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Enhanced header section -->
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Nos Coachs Professionnels</h1>
            <p class="text-xl text-gray-600">Trouvez le coach parfait pour atteindre vos objectifs sportifs</p>
        </div>

        <!-- Improved filter section with better styling -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-10">
            <form action="" method="POST">
                <input type="hidden" name="search" value="1">
                <div class="grid md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-running text-indigo-600 mr-1"></i> Sport
                        </label>
                        <select name="sport" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Tous les sports</option>
                            <option value="Football">Football</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Natation">Natation</option>
                            <option value="Athlétisme">Athlétisme</option>
                            <option value="Boxe">Boxe</option>
                            <option value="Musculation">Musculation</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Yoga">Yoga</option>
                            <option value="Pilates">Pilates</option>
                            <option value="Badminton">Badminton</option>
                            <option value="Fitness">Fitness</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-medal text-indigo-600 mr-1"></i> Expérience
                        </label>
                        <select name="experience" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Toutes expériences</option>
                            <option value="0-3">0-3 ans</option>
                            <option value="4-7">4-7 ans</option>
                            <option value="8-12">8-12 ans</option>
                            <option value="13+">13+ ans</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-signal text-indigo-600 mr-1"></i> Niveau
                        </label>
                        <select name="level" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Tous les niveaux</option>
                            <option value="Débutant">Débutant</option>
                            <option value="Intermédiaire">Intermédiaire</option>
                            <option value="Avancé">Avancé</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-md hover:shadow-lg">
                        <i class="fas fa-search mr-2"></i> Rechercher des coachs
                    </button>
                </div>
            </form>
        </div>

        <!-- Enhanced coaches grid with multiple example cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($coachs as $coach): ?>
        <?php if($coach['role']=="coach"): ?>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <!-- En-tête avec photo -->
            <div class="relative h-48 bg-gradient-to-br from-indigo-50 to-blue-100">
                <?php if (!empty($coach['image_coach'])): ?>
                    <img style="border-radius:100%; display:block ; margin:auto; object-fit: cover; width: 160px; height: 160px;" src="<?= $coach['image_coach'] ?>" 
                         alt="<?= $coach['prenom'] . ' ' . $coach['nom'] ?>" 
                         class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-user-circle text-gray-400 text-7xl mb-2"></i>
                            <p class="text-gray-500 font-medium">Coach Sportif</p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Badge expérience -->
                <div class="absolute top-4 right-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                    <?= $coach['experience'] ?> ans
                </div>
            </div>
            
            <!-- Contenu -->
            <div class="p-6">
                <!-- Nom et spécialité -->
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">
                        <?= $coach['prenom'] ?> 
                        <span class="text-indigo-600"><?= $coach['nom'] ?></span>
                    </h3>
                    <div class="inline-flex items-center bg-indigo-50 text-indigo-700 px-3 py-1 rounded-lg text-sm">
                        <i class="fas fa-running mr-2"></i>
                        <?= $coach['sport_nom'] ?>
                    </div>
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
                            <p class="text-gray-800 font-medium text-sm"><?= $coach['email'] ?></p>
                        </div>
                    </div>
                    
                    <!-- Téléphone -->
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-phone text-green-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Téléphone</p>
                            <p class="text-gray-800 font-medium text-sm"><?= $coach['telephone'] ?></p>
                        </div>
                    </div>
                    
                    <!-- Date -->
                    <?php if ($coach['dispo_date']): ?>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-purple-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Prochaine disponibilité</p>
                            <p class="text-gray-800 font-medium text-sm">
                                <?= date('d/m/Y', strtotime($coach['dispo_date'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Biographie -->
                <?php if ($coach['biographie']): ?>
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-gray-600 text-sm italic">
                        <i class="fas fa-quote-left text-indigo-300 mr-1"></i>
                        <?= substr($coach['biographie'], 0, 100) . (strlen($coach['biographie']) > 100 ? '...' : '') ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <!-- FORMULAIRE - juste déplacé en dehors du "space-y-3 mb-6" -->
                <form action="" method="POST">
                    <input type="hidden" name="id_coach" value="<?= $coach['id'] ?>">
                    <input type="hidden" name="coach_nom_complet" value="<?= $coach['prenom'] . ' ' . $coach['nom'] ?>">
                    <input type="hidden" name="sport" value="<?= $coach['sport_nom'] ?? '' ?>">
                    <input type="hidden" name="experience" value="<?= $coach['experience'] ?? '' ?>">
                    
                    <?php if ($coach['dispo_date']): ?>
                        <input type="hidden" name="D_date" value="<?= $coach['dispo_date'] ?>">
                    <?php endif; ?>
                    
                    <?php if ($coach['biographie']): ?>
                        <input type="hidden" name="biographie" value="<?= $coach['biographie'] ?>">
                    <?php endif; ?>
                    
                    <?php if (isset($coach['heure_debut'])): ?>
                        <input type="hidden" name="heure_debut" value="<?= $coach['heure_debut'] ?>">
                    <?php endif; ?>
                    
                    <!-- Champ date/heure pour la réservation -->
                    <div class="mb-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-calendar-day mr-1"></i> Date souhaitée
                            </label>
                            <input type="date" name="date_reservation" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-clock mr-1"></i> Heure souhaitée
                            </label>
                            <input type="time" name="heure_reservation" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                        <!-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-hourglass-half mr-1"></i> Durée (heures)
                            </label>
                            <select name="duree" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                <option value="1">1 heure</option>
                                <option value="1.5">1h30</option>
                                <option value="2">2 heures</option>
                            </select>
                        </div> -->
                    </div>
                    
                    <!-- Bouton de réservation -->
                    <button type="submit" name="submit_reservation" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Réserver cette séance
                    </button>
                </form>
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
                        <span class="text-gray-700 font-semibold">4.8</span>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-indigo-600">45€</p>
                        <p class="text-xs text-gray-500">par séance</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

    <!-- Added footer -->
    <footer class="bg-white shadow-lg mt-20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-600">© 2025 CoachSport. Tous droits réservés.</p>
            <p class="text-sm text-gray-500 mt-2">Trouvez votre coach idéal pour atteindre vos objectifs sportifs</p>
        </div>
    </footer>
</body>
</html>
