<script setup>
import { router, Link } from '@inertiajs/vue3'

defineProps({
  enseignants: Array
})

function supprimer(enseignant) {
  if (confirm('Supprimer cet enseignant ?')) {
    router.delete(`/enseignants/${enseignant.id}`)
  }
}
</script>

<template>
  <div class="page">
    <h1>Enseignants</h1>

    <div class="actions">
      <Link href="/enseignants/create">Ajouter</Link>
      <Link href="/">Accueil</Link>
    </div>

    <table>
      <thead>
        <tr>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Spécialité</th>
          <th>Nombre d'étudiants</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="e in enseignants" :key="e.id">
          <td>{{ e.matricule }}</td>
          <td>{{ e.nom }}</td>
          <td>{{ e.prenom }}</td>
          <td>{{ e.specialite }}</td>
          <td>{{ e.etudiants?.length || 0 }}</td>
          <td>
            <Link :href="`/enseignants/${e.id}/edit`" class="btn-edit">Modifier</Link>
            <button @click="supprimer(e)" class="btn-delete">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    <p v-if="!enseignants || enseignants.length === 0" class="no-data">
      Aucun enseignant enregistré
    </p>
  </div>
</template>

<style scoped>
.page { 
  padding: 20px; 
  font-family: Arial, sans-serif;
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  color: #333;
  margin-bottom: 20px;
}

.actions { 
  margin-bottom: 20px; 
}

.actions a { 
  margin-right: 10px; 
  padding: 8px 16px;
  background: #51aa2e;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  display: inline-block;
}

.actions a:hover {
  background: #3d8022;
}

table { 
  width: 100%; 
  border-collapse: collapse;
  background: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

th, td { 
  border: 1px solid #ddd; 
  padding: 12px;
  text-align: left;
}

th { 
  background: #f4f4f4;
  font-weight: bold;
  color: #333;
}

tbody tr:hover {
  background: #f9f9f9;
}

.btn-edit {
  margin-right: 10px;
  padding: 4px 8px;
  background: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 3px;
  font-size: 14px;
}

.btn-edit:hover {
  background: #0056b3;
}

.btn-delete {
  padding: 4px 8px;
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  font-size: 14px;
}

.btn-delete:hover {
  background: #c82333;
}

.no-data {
  text-align: center;
  color: #666;
  padding: 20px;
  font-style: italic;
}
</style>