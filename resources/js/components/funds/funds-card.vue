<template>
  <section class="funds-card" @click="$emit('edit', fund)">
    <div class="content">
      <div class="title">
        <h1>{{ fund.name }}</h1>
      </div>
      <div class="funds">
        <div class="fund">
          <p class="fund-description">Fund Year: {{ fund.start_year }}</p>
          <p class="fund-description">Aliases: {{ fund.aliases.join(', ') }}</p>
          <p class="fund-description" v-if="fund.duplicate_name">Duplicated Id: {{ fund.duplicate_id }}</p>
          <p class="fund-description" v-if="fund.duplicate_name">Duplicated Fund Name: {{ fund.duplicate_name }}</p>
          <p class="fund-description" v-if="fund.duplicate_name">Duplicated Fund Aliases: {{ duplicatedAlias }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    fund: {
      type: Object,
      required: true
    }
  },
  emits: ['edit'],
  computed: {
    duplicatedAlias() {
      const aliases = JSON.parse(this.fund.duplicate_aliases);

      return aliases.join(', ');
    }
  }
}
</script>

<style lang="scss" scoped>
.funds-card {
  display: flex;
  justify-content: center;
  width: 100%;
  margin-top: 2rem;
  background-color: #f5f5f5;
  border: 1px solid #667085;
  border-radius: 0.25rem;
  box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1);
  padding: 1rem;

  >.content {
    width: 100%;

    >.title {
      font-size: 1.5rem;
      width: 100%;
      text-align: center;
      display: flex;
      justify-content: space-between;
      align-items: center;

      >.close {
        background-color: red;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        cursor: pointer;
        font-size: 15px;
        font-weight: bold;
      }
    }

    >.funds {
      display: flex;
      justify-content: space-between;
      margin-top: 1rem;

      >.fund {
        border-radius: 0.25rem;
        width: 100%;

        >.fund-description {
          font-size: 1rem;
        }
      }
    }
  }
}
</style>