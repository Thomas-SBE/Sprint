# Sprint
✔️ ❌

🍮 Pierre
🎹 Vincent
🛶 Thomas

## Le directeur se connecte et :
* ✔️ 🍮 modifie les logins et mots de passe : 0.5
* ✔️ 🍮 crée/modifie un service X avec un prix 200 et les pièces X1 à fournir : 0.5
## L'agent administratif Y se connecte et :
* ❌ 🎹 bloque aujourd'hui 18h pour formation : 0.5
## L'agent se connecte et :
* ✔️ 🍮 crée l'étudiant DUPONT avec un découvert 100 : 0.25
* ✔️ 🍮 recherche DUPONT : 0.25
* ✔️ 🍮 modifie directement DUPONT une fois la recherche effectuée : 0.5
* ✔️ 🛶 visualise le planning de l'agent administratif Y en voyant qu'il n'est pas disponible aujourd'hui 18h pour cause de formation: 1
* ❌ 🎹 essaye de prendre quand même un rdv à 18h ce qui doit générer une erreur pour cause de formation : 2
* ❌ 🎹 sauvegarde un rdv avec DUPONT sur un créneau disponible avec visualisation automatique d'une liste déroulante de services possibles dont X et une fois la sauvegarde validée affichage de la pièce X1 à apporter : 3
* ❌ 🎹 visualise les interventions (dont le rdv pris dans le paragraphe ci-dessus) en attente de payement: 1
## L'agent administratif se connecte et :
* ✔️ 🛶 visualise le rdv (pris dans le paragraphe ci-dessus) dans le planning de l'agent administratif : 1
* ❌ 🍮 visualise la synthèse de DUPONT et l'objet d'un rdv en cliquant sur le planning : 1
## L'agent se connecte et :
* ❌ 🛶 essaye de mettre en différé DUPONT mais visualise un blocage de la mise en différé car son montant dépasse le montant autorisé restant : 2
* ✔️ 🛶 augmente a 500 le montant de découvert de DUPONT : 0.5
* ❌ 🛶 met en différé DUPONT et le voit dans sa synthèse avec différé possible de 300 : 1
* ❌ 🛶 fait payer DUPONT et ce payement s'affiche dans la synthèse étudiant avec un différé possible de 500: 1
## Css : 1
## Statistiques du directeur : 1
## MCD : 2
