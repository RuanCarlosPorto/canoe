<template>
  <section class="companies-card">
    <section class="content">
      <section class="title">
        <h2>{{ company.name }}</h2>
      </section>
    </section>
  </section>
</template>

<script>
export default {
  props: {
    company: {
      type: Object,
      required: true,
    }
  }
}
</script>

<style lang="scss" scoped>
.companies-card {
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

    >.companies {
      display: flex;
      justify-content: space-between;
      margin-top: 1rem;

      >.company {
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