<template>
  <section class="search-input">
    <input type="text" placeholder="Search for a Fund" v-model="search" />
    <button @click="$emit('send')">Search</button>
  </section>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: String,
      required: true
    }
  },
  emits: ['update:modelValue', 'send'],
  data() {
    return {
      search: this.modelValue,
    }
  },
  watch: {
    modelValue(value) {
      this.search = value;
    },
    search(value) {
      this.$emit('update:modelValue', value);
    }
  }
}
</script>

<style lang="scss" scoped>
.search-input {
  display: flex;
  justify-content: space-between;
  border: 1px solid #667085;
  border-radius: 0.25rem;

  > input {
    padding: 0.5rem;
    font-size: 1rem;
    border: none;
    width: 100%;
  }

  > button {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border-left: 1px solid #667085;
  }
}
</style>