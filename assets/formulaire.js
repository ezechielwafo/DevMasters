<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tickets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Créer un Ticket</h1>
    <form id="ticketForm">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" required><br>
        <label for="description">Description :</label>
        <textarea id="description" required></textarea><br>
        <label for="piece_jointe">Pièce jointe :</label>
        <input type="file" id="piece_jointe"><br>
        <button type="button" id="submitButton">Créer le ticket</button>
    </form>

    <h1>Liste des Tickets</h1>
    <table id="ticketsTable">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Pièce jointe</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les tickets ajoutés apparaîtront ici -->
        </tbody>
    </table>

    <script>
        // Tableau pour stocker les tickets
        let tickets = [];

        // Ajout d'un écouteur d'événement pour le bouton
        document.getElementById('submitButton').addEventListener('click', function () {
            const titre = document.getElementById('titre').value;
            const description = document.getElementById('description').value;
            const pieceJointe = document.getElementById('piece_jointe').files[0]?.name || 'Aucune';

            // Validation
            if (!titre || !description) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }

            // Ajout du ticket au tableau
            const ticket = { titre, description, pieceJointe };
            tickets.push(ticket);

            // Mise à jour de la table
            afficherTickets();

            // Réinitialisation du formulaire
            document.getElementById('ticketForm').reset();
        });

        // Fonction pour afficher les tickets dans la table
        function afficherTickets() {
            const tableBody = document.querySelector('#ticketsTable tbody');
            tableBody.innerHTML = ''; // Effacer le contenu actuel

            tickets.forEach(ticket => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${ticket.titre}</td>
                    <td>${ticket.description}</td>
                    <td>${ticket.pieceJointe}</td>
                `;
                tableBody.appendChild(row);
            });
        }


        
    </script>
</body>
</html>
