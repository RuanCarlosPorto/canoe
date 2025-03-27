<template>
  <section class="companies-section">
    <div class="controls">
      <button class="button" @click="creating = true">Create</button>
    </div>
    <section class="companies-cards">
      <CompaniesCard v-for="company in companies" :key="company.id" :company="company" />
    </section>
    <companies-create-modal v-if="creating" @create="creating = false; fetchCompanies();" @close="creating = false;" />
  </section>
</template>

<script>
import CompaniesCard from './companies-card.vue';
import CompaniesCreateModal from './companies-create-modal.vue';

export default {
  components: {
    CompaniesCard,
    CompaniesCreateModal,
  },
  data() {
    return {
      companies: [],
      creating: false,
    }
  },
  mounted() {
    this.fetchCompanies();
  },
  methods: {
    async fetchCompanies() {
      try {
        const response = await fetch(`http://localhost/api/companies`);
        this.companies = await response.json();
      } catch (error) {
        console.error(error);
      }
    },
  }
}
</script>

<style lang="scss" scoped>
.companies-section {
  width: 100%;

  > .controls {
    margin-top: 2rem;
    width: 100%;
    display: flex;
    justify-content: center;

    > .button {
      margin-left: 1rem;
      border: 1px solid #667085;
      padding: 0.5rem;
      border-radius: 8px;
      background-color: rgb(28, 118, 186);
      color: white;
    }
  }

  >.companies-cards {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin: 5rem 5rem 0 5rem;
    width: 100%;

    >* {
      width: 20%;
      margin: 1rem;
    }
  }
}
</style>