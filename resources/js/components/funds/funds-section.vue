<template>
  <section class="funds-section">
    <div class="search-container">
      <SearchInput class="search-input" v-model="search" @send="fetchFunds" />
      <button class="button" @click="creating = true">Create</button>
    </div>
    <section class="funds-cards">
      <FundsCard v-for="fund in funds" :key="fund.id" :fund="fund"
        @edit="(fund) => { selectedFund = fund; updating = true; }" />
    </section>
    <funds-create-modal v-if="creating || updating" @create="closeCreateModal" :fund="selectedFund"
      @close="updating = false; creating = false; selectedFund = null;" @delete="deleteFund" />
  </section>
</template>

<script>
import SearchInput from '../search-input.vue';
import FundsCard from './funds-card.vue';
import FundsCreateModal from './funds-create-modal.vue';

export default {
  components: {
    FundsCard,
    SearchInput,
    FundsCreateModal
  },
  data() {
    return {
      funds: [],
      search: '',
      creating: false,
      updating: false,
      selectedFund: null,
    }
  },
  mounted() {
    this.fetchFunds();
  },
  methods: {
    async fetchFunds() {
      try {
        const parameters = this.search ? `?search=${this.search}` : '';
        const response = await fetch(`http://localhost/api/funds${parameters}`);
        this.funds = await response.json();
      } catch (error) {
        console.error(error);
      }
    },
    async deleteFund(id) {
      try {
        await fetch(`http://localhost/api/funds/${id}`, {
          method: 'DELETE',
        });

        this.funds = this.funds.filter(fund => fund.id !== id);
        this.closeCreateModal();
      } catch (error) {
        console.error(error);
      }
    },
    async closeCreateModal() {
      this.creating = false;
      this.updating = false;
      this.selectedFund = null;
      this.fetchFunds();
    }
  }
}
</script>

<style lang="scss" scoped>
.funds-section {
  >.search-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2rem;

    >.search-input {
      width: 35%;
    }

    >.button {
      margin-left: 1rem;
      border: 1px solid #667085;
      padding: 0.5rem;
      border-radius: 8px;
      background-color: rgb(28, 118, 186);
      color: white;
    }
  }

  >.funds-cards {
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