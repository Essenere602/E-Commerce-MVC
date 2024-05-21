<?php
<<<<<<< HEAD
namespace Views;
=======
namespace Views; 
>>>>>>> origin/Samuel

class LoginForm {
    public function render() {
        if (isset($_SESSION['user'])) {
            echo '
            <p>Welcome, ' . htmlspecialchars($_SESSION['user']) . '!</p>
            <form method="POST" action="?action=logout">
                <button type="submit">Logout</button>
            </form>';
        } else {
            echo '
            <h1>Connectes-toi</h1>
<<<<<<< HEAD
            <form class="vertical" action="login" method="post">
            
            <label for="email">Email</label><input type="text" name="email" id="email">
            <label for="password">Mot de passe</label><input type="password" name="password" id="password">
            <button>Se connecter</button>
        </form>';
        }
    }
}

=======
            <form method="POST" action="?action=login">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <button type="submit">Login</button>
                </div>
            </form>';
        }
    }
}
?>
>>>>>>> origin/Samuel
