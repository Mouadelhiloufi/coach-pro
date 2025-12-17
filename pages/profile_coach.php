<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
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
                    <a href="coach-dashboard.html" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Dashboard</a>
                    <a href="coach-profile.html" class="text-indigo-600 px-3 py-2 rounded-md font-medium">
                        <i class="fas fa-user mr-1"></i> Profil
                    </a>
                    
                        <button type="submit" onclick="window.location.href='../pages/logout.php'" class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md font-medium">
                            <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                        </button>
                    
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Mon Profil Professionnel</h2>
            
            <form action="backend/update-profile.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                    <input type="file" name="profile_photo" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Biographie</label>
                    <textarea name="bio" rows="4" placeholder="Parlez de votre parcours, votre passion pour le sport..." class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Disciplines enseignées</label>
                    <input type="text" name="sports" placeholder="Ex: Football, Tennis, Natation" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <p class="text-xs text-gray-500 mt-1">Séparez les disciplines par des virgules</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Années d'expérience</label>
                    <input type="number" name="experience" min="0" max="50" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Certifications</label>
                    <input type="text" name="certifications" placeholder="Ex: BPJEPS, CQP, Diplôme d'État" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <p class="text-xs text-gray-500 mt-1">Séparez les certifications par des virgules</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tarif par séance (€)</label>
                    <input type="number" name="hourly_rate" min="10" max="200" step="5" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition font-medium">
                    <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
</body>
</html>
