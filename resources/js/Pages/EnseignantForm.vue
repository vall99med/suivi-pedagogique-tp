<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
  enseignant: {
    type: Object,
    default: null
  }
})

const form = useForm({
  matricule: props.enseignant?.matricule || '',
  nom: props.enseignant?.nom || '',
  prenom: props.enseignant?.prenom || '',
  specialite: props.enseignant?.specialite || '',
})

function submit() {
  if (props.enseignant?.id) {
    // Mode modification
    form.put(`/enseignants/${props.enseignant.id}`)
  } else {
    // Mode création
    form.post('/enseignants')
  }
}
</script>

<template>
  <div class="page">
    <h1>{{ enseignant ? 'Modifier enseignant' : 'Ajouter enseignant' }}</h1>

    <form @submit.prevent="submit" class="form-container">
      <div class="form-group">
        <label>Matricule</label>
        <input v-model="form.matricule" type="text" required />
        <span v-if="form.errors.matricule" class="error">{{ form.errors.matricule }}</span>
      </div>

      <div class="form-group">
        <label>Nom</label>
        <input v-model="form.nom" type="text" required />
        <span v-if="form.errors.nom" class="error">{{ form.errors.nom }}</span>
      </div>

      <div class="form-group">
        <label>Prénom</label>
        <input v-model="form.prenom" type="text" required />
        <span v-if="form.errors.prenom" class="error">{{ form.errors.prenom }}</span>
      </div>

      <div class="form-group">
        <label>Spécialité</label>
        <input v-model="form.specialite" type="text" required />
        <span v-if="form.errors.specialite" class="error">{{ form.errors.specialite }}</span>
      </div>

      <div class="form-actions">
        <button type="submit" :disabled="form.processing" class="btn-submit">
          {{ form.processing ? 'Enregistrement...' : 'Enregistrer' }}
        </button>
        <Link href="/enseignants" class="btn-cancel">Annuler</Link>
      </div>
    </form>

    <div class="navigation">
      <Link href="/enseignants">Retour à la liste</Link>
      <Link href="/">Accueil</Link>
    </div>
  </div>
</template>

<style scoped>
.page { 
  padding: 20px; 
  font-family: Arial, sans-serif;
  max-width: 600px;
  margin: 0 auto;
}

h1 {
  color: #333;
  margin-bottom: 30px;
}

.form-container {
  background: white;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-group {
  margin-bottom: 20px;
}

label { 
  display: block; 
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}

input { 
  width: 100%; 
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
  box-sizing: border-box;
}

input:focus {
  outline: none;
  border-color: #51aa2e;
}

.error {
  color: #dc3545;
  font-size: 12px;
  display: block;
  margin-top: 5px;
}

.form-actions {
  margin-top: 30px;
  display: flex;
  gap: 10px;
}

.btn-submit {
  padding: 10px 20px;
  background: #51aa2e;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

.btn-submit:hover:not(:disabled) {
  background: #3d8022;
}

.btn-submit:disabled {
  background: #ccc;
  cursor: not-allowed;
}

.btn-cancel {
  padding: 10px 20px;
  background: #6c757d;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  display: inline-block;
}

.btn-cancel:hover {
  background: #5a6268;
}

.navigation {
  margin-top: 20px;
  display: flex;
  gap: 20px;
}

.navigation a {
  color: #007bff;
  text-decoration: none;
}

.navigation a:hover {
  text-decoration: underline;
}
</style>