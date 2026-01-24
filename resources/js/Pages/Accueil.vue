<template>
    <div class="container">
        <h1>Projet Suivi Pédagogique</h1>
        <p>Gestion des étudiants, enseignants et absences</p>

        <div class="actions">
            <a href="/etudiants">Gérer les étudiants</a>
            <a href="/enseignants">Gérer les enseignants</a>
            <a href="/absences">Gérer les absences</a>
        </div>
    </div>
</template>

<style scoped>
.container {
    text-align: center;
    margin-top: 60px;
}

h1 {
    color: #333;
    font-size: 2.5em;
    margin-bottom: 10px;
}

p {
    color: #666;
    font-size: 1.2em;
    margin-bottom: 40px;
}

.actions {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.actions a {
    display: inline-block;
    padding: 15px 30px;
    background: #51aa2e;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 1.1em;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.actions a:hover {
    background: #3d8022;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
</style>