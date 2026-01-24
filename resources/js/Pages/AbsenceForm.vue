<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
  absence: {
    type: Object,
    default: null
  },
  etudiants: {
    type: Array,
    default: () => []
  }
})

const form = useForm({
  etudiant_id: props.absence?.etudiant_id || '',
  date: props.absence?.date || new Date().toISOString().split('T')[0],
  motif: props.absence?.motif || '',
  justifiee: props.absence?.justifiee || false,
  observation: props.absence?.observation || '',
})

function submit() {
  if (props.absence?.id) {
    form.put(`/absences/${props.absence.id}`)
  } else {
    form.post('/absences')
  }
}
</script>

<template>
  <div class="page">
    <h1>{{ absence ? 'Modifier une absence' : 'Enregistrer une absence' }}</h1>

    <form @submit.prevent="submit" class="form-container">
      <div class="form-group">
        <label>Étudiant *</label>
        <select v-model="form.etudiant_id" required>
          <option value="">-- Sélectionner un étudiant --</option>
          <option v-for="e in etudiants" :key="e.id" :value="e.id">
            {{ e.nom }} {{ e.prenom }} ({{ e.matricule }}) - {{ e.filiere }}
          </option>
        </select>
        <span v-if="form.errors.etudiant_id" class="error">{{ form.errors.etudiant_id }}</span>
      </div>

      <div class="form-group">
        <label>Date *</label>
        <input v-model="form.date" type="date" required />
        <span v-if="form.errors.date" class="error">{{ form.errors.date }}</span>
      </div>

      <div class="form-group">
        <label>Motif</label>
        <input v-model="form.motif" type="text" placeholder="Ex: Maladie, Rendez-vous médical..." />
        <span v-if="form.errors.motif" class="error">{{ form.errors.motif }}</span>
      </div>

      <div class="form-group checkbox-group">
        <label>
          <input v-model="form.justifiee" type="checkbox" />
          Absence justifiée
        </label>
      </div>

      <div class="form-group">
        <label>Observation</label>
        <textarea v-model="form.observation" rows="3" placeholder="Remarques supplémentaires..."></textarea>
        <span v-if="form.errors.observation" class="error">{{ form.errors.observation }}</span>
      </div>

      <div class="form-actions">
        <button type="submit" :disabled="form.processing" class="btn-submit">
          {{ form.processing ? 'Enregistrement...' : 'Enregistrer' }}
        </button>
        <Link href="/absences" class="btn-cancel">Annuler</Link>
      </div>
    </form>

    <div class="navigation">
      <Link href="/absences">Retour à la liste</Link>
      <Link href="/">Accueil</Link>
    </div>
  </div>
</template>

<style scoped>
.page { 
  padding: 20px; 
  font-family: Arial, sans-serif;
  max-width: 700px;
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

.checkbox-group {
  display: flex;
  align-items: center;
}

.checkbox-group label {
  display: flex;
  align-items: center;
  font-weight: normal;
  cursor: pointer;
}

.checkbox-group input[type="checkbox"] {
  width: auto;
  margin-right: 10px;
  cursor: pointer;
}

label { 
  display: block; 
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}

input, select, textarea { 
  width: 100%; 
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

input:focus, select:focus, textarea:focus {
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