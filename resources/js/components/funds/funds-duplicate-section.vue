<template>
  <section class="funds-duplicate-section">
    <section class="funds-cards">
      <FundsCard v-for="fund in funds" :key="fund.id" :fund="fund" />
    </section>
  </section>
</template>

<script>
import FundsCard from './funds-card.vue';

export default {
  components: {
    FundsCard
  },
  data() {
    return {
      funds: [],
    }
  },
  mounted() {
    this.fetchFunds();
  },
  methods: {
    async fetchFunds() {
      try {
        const response = await fetch(`http://localhost/api/funds/duplicates`);
        this.funds = await response.json();
      } catch (error) {
        console.error(error);
      }
    },
  }
}
</script>

<style lang="scss" scoped>
.funds-duplicate-section {
  width: 80%;

  >.funds-cards {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin: 5rem 5rem 0 5rem;
    width: 100%;

    > * {
      width: 30%;
      margin: 1rem;
    }
  }
}
</style>