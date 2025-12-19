<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include("../sources/db/db.php");



    if(isset($_POST["role"])){
        $role=$_POST["role"];
        if($role=="client"){
            $nom=$_POST["nom"];
            $prenom=$_POST["prenom"];
            $email=$_POST["email"];
            $phone=$_POST["phone"];
            $password=$_POST["password"];
            $level=$_POST["level"];
            $role="client";
            $password_hashed=password_hash($password,PASSWORD_DEFAULT);

            $preparUser=$conn->prepare(
                "insert into users(nom,prenom,email,telephone,password,role)values(?,?,?,?,?,?);"
            );
            
            $preparUser->bind_param(
                "ssssss",
                $nom,
                $prenom,
                $email,
                $phone,
                $password_hashed,
                $role
            );
            $preparUser->execute();
            $id_user=$conn->insert_id;

            $preparClient=$conn->prepare("insert into client(niveau,id_user)
                                        values(?,?)");
             $preparClient->bind_param(
                "si",
                $level,
                $id_user
             );    
             $preparClient->execute(); 
             header("location: login.php");
             exit();                   



        }else if($role=="coach"){
            $nom=$_POST["nom"];
            $prenom=$_POST["prenom"];
            $email=$_POST["email"];
            $phone=$_POST["phone"];
            $password=$_POST["password"];
            $profil_image=$_POST["profile_image"];
            $experience=$_POST["experience"];
            $biography=$_POST["biography"];
            $role="coach";
            $password_hashed=password_hash($password,PASSWORD_DEFAULT);

            $preparUser=$conn->prepare(
                "insert into users(nom,prenom,email,telephone,password,role)values(?,?,?,?,?,?)"
            );
            
            $preparUser->bind_param(
                "ssssss",
                $nom,
                $prenom,
                $email,
                $phone,
                $password_hashed,
                $role
            );
            $preparUser->execute();
            $id_user=$conn->insert_id;


            

            $preparCoach=$conn->prepare(
                "insert into coach(image_coach,biographie,experience,id_user)values(?,?,?,?)"
            );


            if(empty(trim($profil_image))){
                $profil_image="data:image/png;base64,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";
            }

            $preparCoach->bind_param(
                "sssi",
                $profil_image,
                $biography,
                $experience,
                $id_user
            );
            
            $preparCoach->execute();
            

            header("location: login.php");
             exit();

            
        }
        
    }




    ?>










<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl p-8">
            <!-- Step 1: Role Selection with simple onclick to show form -->
            <div id="roleSelection" class="text-center">
                <div class="mb-8">
                    <i class="fas fa-dumbbell text-indigo-600 text-5xl mb-4"></i>
                    <h2 class="text-3xl font-extrabold text-gray-900">Choisissez votre rôle</h2>
                    <p class="mt-2 text-gray-600">Comment souhaitez-vous utiliser CoachSport ?</p>
                </div>

                <div class="space-y-4">
                    <!-- Updated onclick to show athlete-specific fields -->
                    <button onclick="document.getElementById('roleSelection').classList.add('hidden'); document.getElementById('registrationForm').classList.remove('hidden'); document.getElementById('selectedRole').value='client'; document.getElementById('roleLabel').textContent='Inscription en tant que Sportif'; document.getElementById('coachFields').classList.add('hidden'); document.getElementById('athleteFields').classList.remove('hidden');" 
                        class="w-full border-2 border-gray-300 rounded-lg p-6 hover:border-indigo-600 hover:bg-indigo-50 transition text-center group">
                        <i class="fas fa-running text-5xl text-indigo-600 mb-3 group-hover:scale-110 transition-transform"></i>
                        <p class="text-xl font-bold text-gray-900">Sportif</p>
                        <p class="text-sm text-gray-600 mt-2">Je cherche un coach pour progresser</p>
                    </button>

                    <!-- Updated onclick to show coach-specific fields -->
                    <button onclick="document.getElementById('roleSelection').classList.add('hidden'); document.getElementById('registrationForm').classList.remove('hidden'); document.getElementById('selectedRole').value='coach'; document.getElementById('roleLabel').textContent='Inscription en tant que Coach'; document.getElementById('athleteFields').classList.add('hidden'); document.getElementById('coachFields').classList.remove('hidden');" 
                        class="w-full border-2 border-gray-300 rounded-lg p-6 hover:border-indigo-600 hover:bg-indigo-50 transition text-center group">
                        <i class="fas fa-whistle text-5xl text-indigo-600 mb-3 group-hover:scale-110 transition-transform"></i>
                        <p class="text-xl font-bold text-gray-900">Coach</p>
                        <p class="text-sm text-gray-600 mt-2">Je veux proposer mes services de coaching</p>
                    </button>
                </div>



                
                

                <div class="mt-6">
                    <a href="../index.php" class="text-sm text-gray-600 hover:text-indigo-600">
                        <i class="fas fa-arrow-left mr-1"></i> Retour à l'accueil
                    </a>
                </div>
            </div>

            <!-- Step 2: Registration Form submits to PHP -->
            <div id="registrationForm" class="hidden">
                <div class="text-center mb-8">
                    <button onclick="document.getElementById('roleSelection').classList.remove('hidden'); document.getElementById('registrationForm').classList.add('hidden');" 
                        class="text-sm text-gray-600 hover:text-indigo-600 mb-4 inline-flex items-center">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </button>
                    <h2 class="text-3xl font-extrabold text-gray-900">Créer un compte</h2>
                    <p class="mt-2 text-gray-600" id="roleLabel"></p>
                </div>
                <!-- form############################# -->
                <form action="" method="POST" onsubmit="return validateForm()" class="space-y-4">
                    <input type="hidden" id="selectedRole" name="role" value="">

                    <!-- Name Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" id="prenom" name="prenom" required
                                
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="nom" name="nom" required
                                
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required
                            
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="tel" id="phone" name="phone" required placeholder="0612345678"
                            
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" id="password" name="password" required
                            
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">Min 8 caractères, 1 majuscule, 1 chiffre</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- PAAARTE CLIENT -->
                    <div id="athleteFields" class="hidden space-y-4">
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700">Niveau</label>
                            <select id="level" name="level" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Sélectionnez votre niveau</option>
                                <option value="debutant">Débutant</option>
                                <option value="intermediaire">Intermédiaire</option>
                                <option value="avance">Avancé</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                    </div>

                    <!-- PART COACH -->
                    <div id="coachFields" class="hidden space-y-4">
                        <div>
                            <label for="profileImage" class="block text-sm font-medium text-gray-700">Photo de profil</label>
                            <input type="url" id="profile_image" name="profile_image" 
               placeholder="https://exemple.com/image.jpg"
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
        <p class="text-xs text-gray-500 mt-1">Entrez l'URL complète de l'image</p>
                        </div>

                        <div>
                            <label for="biography" class="block text-sm font-medium text-gray-700">Biographie</label>
                            <textarea id="biography" name="biography" rows="4" 
                                placeholder="Parlez-nous de votre parcours et de votre passion pour le coaching..."
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>

                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700">Expérience (années)</label>
                            <input type="number" id="experience" name="experience" min="0" max="50" placeholder="Ex: 5"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        S'inscrire
                    </button>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Déjà inscrit ? 
                            <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Se connecter</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
function validateForm() {
    var isValid = true;
    
    // Nettoyer les anciennes erreurs
    var oldErrors = document.querySelectorAll('.error');
    oldErrors.forEach(function(el) {
        el.remove();
    });
    
    // Validation NOM
    var nom = document.getElementById('nom').value;
    if (!/^[A-Za-z ]+$/.test(nom)) {
        showError('nom', 'Nom invalide');
        isValid = false;
    }
    console.log(nom)

    
    // Validation PRENOM
    var prenom = document.getElementById('prenom').value;
    if (!/^[A-Za-z ]+$/.test(prenom)) {
        showError('prenom', 'Prénom invalide');
        isValid = false;
    }
    console.log(prenom);
    // Validation EMAIL
    var email = document.getElementById('email').value;
    if (!/^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]+$/.test(email)) {
        showError('email', 'Email invalid (ex: mouad@gmail.com)');
        isValid = false;
    }
    
    // Validation TELEPHONE
    var phone = document.getElementById('phone').value;
    if (!/^[0-9\+\-]{10,15}$/.test(phone)) {
        showError('phone', 'Téléphone invalide (10-15 chiffres)');
        isValid = false;
    }
    
    // Validation MOT DE PASSE
    var password = document.getElementById('password').value;
    let confirmPassword=document.getElementById("confirmPassword").value
    

    if(password!=confirmPassword){
        showError('confirmPassword',"veuillez entrer le meme code dans la verification de mot de passe")
        isValid = false;
    }
    
    // Validation ROLE
    var role = document.getElementById('selectedRole').value;
    
   
    
    
    // Si COACH, valider les champs coach
    if (role === 'coach') {
        
        
        // Biographie
        var biography = document.getElementById('biography').value;
        if (!/.+/.test(biography)) {
            showError('biography', 'La biographie est invalid');
            isValid = false;
        }
        
        // URL photo (optionnel mais doit être valide si rempli)
        var url = document.getElementById('profile_image').value;
        if (url.trim() == '') {
            
                showError('profileImageUrl', 'URL invalid veuillez entrer un URL correcte');
                isValid = false;
            
        }
    }
    
    return isValid;
}



function showError(placeError, message) {
    var field = document.getElementById(placeError);
    
    // Ajoute une bordure rouge
    field.style.borderColor = 'red';
    field.style.borderWidth = '2px';
    
    // Crée le message d'erreur
    var errorDiv = document.createElement('div');
    errorDiv.className = 'error';
    errorDiv.style.color = 'red';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    
    // Ajoute après le champ
    field.parentNode.appendChild(errorDiv);
}
</script>