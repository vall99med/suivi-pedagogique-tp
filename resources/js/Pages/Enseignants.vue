<template>
    <div class="container mt-5">
         <button @click="goToCreate" class="btn btn-success mb-3">Ajouter un enseignant</button>
        <h2>Liste des enseignants et leurs étudiants</h2>

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Spécialité</th>
                    <th>Étudiants</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="enseignant in enseignants" :key="enseignant.id">
                    <td>{{ enseignant.matricule }}</td>
                    <td>{{ enseignant.nom }}</td>
                    <td>{{ enseignant.prenom }}</td>
                    <td>{{ enseignant.specialite }}</td>
                    <td>
                        <ul>
                            <li v-for="etudiant in enseignant.etudiants" :key="etudiant.id">
                                {{ etudiant.nom }} {{ etudiant.prenom }}
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
defineProps({
    enseignants: Array
})

function goToCreate() {
  Inertia.visit('/enseignants/create')
}
</script>
