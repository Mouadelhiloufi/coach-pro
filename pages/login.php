<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../sources/db/db.php");


if (isset($_SESSION["user_id"])) {
    if ($_SESSION["user_role"] === "client") {
        header("Location: ../pages/athlete_page.php");
        exit();
    } elseif ($_SESSION["user_role"] === "coach") {
        header("Location: ../pages/coach_page.php");
        exit();
    }
}

$error = "";

/* Handle login */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];



    /* Prepared statement (mysqli) */
    $stmt = $conn->prepare("SELECT id, prenom, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    
    
    // var_dump($result->fetch_assoc());
    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();
        // var_dump($user['password']);

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"]   = $user["id"];
            $_SESSION["user_role"] = $user["role"];
            $_SESSION["user_prenom"] = $user["prenom"];
            
            

            if ($user["role"] === "client") {
                header("Location: athlete_page.php");
            } else {
                header("Location: ../pages/coach_page.php");
            }
            exit();

        } else {
            $error = "Incorrect password";
        }

    } else {
        $error = "Email not found";
    }
}
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - CoachSport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    
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
                    <a href="../index.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Accueil</a>
                    <a href="signUp.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md font-medium">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900">Connexion</h2>
                <p class="mt-2 text-gray-600">Accédez à votre espace personnel</p>
            </div>

            <!-- Form ####################################### -->
            <form action="" method="POST" class="space-y-6">
                <input type="hidden" name="login" value="1">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                <!-- Submit Button -->
                 
                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Se connecter
                </button>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Pas encore de compte ? 
                        <a href="../pages/signUp.php" class="font-medium text-indigo-600 hover:text-indigo-500">S'inscrire</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>

