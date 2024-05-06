<form action="inscription" method="post">
    <label for="lastname">Nom :</label> <input type="text" name="lastname" id="lastname">
    <label for="firstname">Prénom :</label> <input type="text" name="firstname" id="firstname">
    <label for="email">Email :</label> <input type="text" name="email" id="email">
    <label for="phone">Téléphone :</label> <input type="text" name="phone" id="phone">
    <label for="password">Mot de passe :</label> <input type="password" name="password" id="password">
    <label for="birthdate">Date de naissance :</label> <input type="datetime-local" name="birthdate" id="birthdate">
   <button>Envoyer</button>
</form>







<style>

.form-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="password"] {
    width: 30%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    width: 30%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}


</style>
