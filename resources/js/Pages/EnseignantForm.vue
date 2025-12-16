<template>
  <div class="container mt-5">
    <h2>{{ enseignant ? 'Éditer Enseignant' : 'Ajouter un Enseignant' }}</h2>

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
        <label>Spécialité :</label>
        <input v-model="form.specialite" type="text" class="form-control" required />
      </div>

      <button type="submit" class="btn btn-primary">
        {{ enseignant ? 'Mettre à jour' : 'Ajouter' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

defineProps({
  enseignant: Object
})

// Formulaire réactif
const form = reactive(enseignant || {
  nom: '',
  prenom: '',
  matricule: '',
  specialite: ''
})

// Soumission via Inertia
function submitForm() {
  if (enseignant) {
    Inertia.put(`/enseignants/${enseignant.id}`, form)
  } else {
    Inertia.post('/enseignants', form)
  }
}
</script>
