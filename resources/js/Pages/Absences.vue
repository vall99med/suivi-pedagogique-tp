<script setup>
import { router, Link } from '@inertiajs/vue3'

defineProps({
  absences: Array
})

function supprimer(absence) {
  if (confirm('Supprimer cette absence ?')) {
    router.delete(`/absences/${absence.id}`)
  }
}

function formatDate(date) {
  return new Date(date).toLocaleDateString('fr-FR')
}
</script>

<template>
  <div class="page">
    <h1>Gestion des Absences</h1>

    <div class="actions">
      <Link href="/absences/create" class="btn-add">Enregistrer une absence</Link>
      <Link href="/">Accueil</Link>
    </div>

    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Étudiant</th>
          <th>Matricule</th>
          <th>Filière</th>
          <th>Motif</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="a in absences" :key="a.id">
          <td>{{ formatDate(a.date) }}</td>
          <td>{{ a.etudiant.prenom }} {{ a.etudiant.nom }}</td>
          <td>{{ a.etudiant.matricule }}</td>
          <td>{{ a.etudiant.filiere }}</td>
          <td>{{ a.motif || '—' }}</td>
          <td>
            <span :class="['badge', a.justifiee ? 'badge-success' : 'badge-danger']">
              {{ a.justifiee ? '✓ Justifiée' : '✗ Non justifiée' }}
            </span>
          </td>
          <td>
            <Link :href="`/absences/${a.id}/edit`" class="btn-edit">Modifier</Link>
            <button @click="supprimer(a)" class="btn-delete">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    <p v-if="!absences || absences.length === 0" class="no-data">
      Aucune absence enregistrée
    </p>
  </div>
</template>

<style scoped>
.page { 
  padding: 20px; 
  font-family: Arial, sans-serif;
  max-width: 1400px;
  margin: 0 auto;
}

h1 {
  color: #333;
  margin-bottom: 20px;
}

.actions { 
  margin-bottom: 20px;
  display: flex;
  gap: 10px;
}

.actions a { 
  padding: 10px 20px;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  display: inline-block;
}

.btn-add {
  background: #51aa2e;
}

.btn-add:hover {
  background: #3d8022;
}

.actions a:not(.btn-add) {
  background: #6c757d;
}

.actions a:not(.btn-add):hover {
  background: #5a6268;
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

.badge {
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: bold;
}

.badge-success {
  background: #d4edda;
  color: #155724;
}

.badge-danger {
  background: #f8d7da;
  color: #721c24;
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
  padding: 40px;
  font-style: italic;
  background: #f9f9f9;
  border-radius: 8px;
}
</style>