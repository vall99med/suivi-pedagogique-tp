<template>
  <div class="container mt-5">
    <h2>{{ etudiant ? 'Éditer Étudiant' : 'Ajouter un Étudiant' }}</h2>

    <form @submit.prevent="submitForm" class="mt-3">

      <div class="mb-3">
        <label>Nom :</label>
        <input v-model="form.nom" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label>Prénom :</label>
        <input v-model="form.prenom" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label>Matricule :</label>
        <input v-model="form.matricule" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label>Filière :</label>
        <input v-model="form.filiere" type="text" class="form-control" required />
      </div>

      <div class="mb-3">
        <label>Niveau :</label>
        <input v-model="form.niveau" type="number" class="form-control" required />
      </div>

      <div class="mb-3">
        <label>Enseignant :</label>
        <select v-model="form.enseignant_id" class="form-control">
          <option value="">-- Choisir un enseignant --</option>
          <option v-for="ens in enseignants" :key="ens.id" :value="ens.id">
            {{ ens.nom }} {{ ens.prenom }} ({{ ens.specialite }})
          </option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">
        {{ etudiant ? 'Mettre à jour' : 'Ajouter' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

defineProps({
  etudiant: Object,
  enseignants: Array
})

// Formulaire réactif
const form = reactive(etudiant || {
  nom: '',
  prenom: '',
  matricule: '',
  filiere: '',
  niveau: '',
  enseignant_id: null
})

// Soumission via Inertia
function submitForm() {
  if (etudiant) {
    Inertia.put(`/etudiants/${etudiant.id}`, form)
  } else {
    Inertia.post('/etudiants', form)
  }
}
</script>
