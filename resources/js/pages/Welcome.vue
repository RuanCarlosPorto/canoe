<template>
  <section class="welcome">
    <div class="content">
      <h1 class="title">Welcome Canoe Take Home</h1>
      <section class="tabs">
        <div class="tab" v-for="(tab, index) in tabs" :key="tab" :class="{ '--active': index === step }"
          @click="step = index">{{ tab }}</div>
      </section>
      <funds-section v-if="step === 0" />
      <funds-duplicate-section v-if="step === 1" />
      <companies-section v-if="step === 2" />
    </div>
  </section>
</template>

<script>
import CompaniesSection from '@/components/companies/companies-section.vue';
import FundsDuplicateSection from '@/components/funds/funds-duplicate-section.vue';
import FundsSection from '@/components/funds/funds-section.vue';

export default {
  components: {
    FundsSection,
    FundsDuplicateSection,
    CompaniesSection
  },
  data() {
    return {
      step: 0,
      tabs: [
        'Funds',
        'Possible duplicates',
        'Companies'
      ]
    }
  },
}
</script>

<style lang="scss" scoped>
.welcome {
  display: flex;
  justify-content: center;
  min-height: 100vh;
  flex-wrap: wrap;
  background-color: #ffffff;
  color: #667085;

  >.content {
    width: 100%;

    >.title {
      font-size: 2rem;
      width: 100%;
      text-align: center;
      text-decoration: underline;
    }

    >.tabs {
      display: flex;
      justify-content: center;
      margin-top: 2rem;

      >.tab {
        padding: 1rem;
        cursor: pointer;

        &:not(:last-child) {
          border-right: 2px solid #667085;
        }

        &:hover {
          background-color: #f0f0f0;
        }

        &.--active {
          border-bottom: 3px solid #667085;
        }
      }
    }
  }
}
</style>