<template>
  <section class="funds-create-modal">
    <div class="content">
      <span class="close" @click="$emit('close')">x</span>
      <h1 class="title">Creating Fund</h1>
      <div class="form">
        <label class="label">Name
          <input type="text" class="input" placeholder="Fund Name" v-model="name" />
        </label>
        <label class="label">Start Year
          <input type="number" class="input" placeholder="Fund Start Year" v-model="year" />
        </label>
        <label class="label">Manager
          <select class="input" v-model="manager">
            <option v-for="manager in managers" :key="manager.id" :value="manager.id"> {{ manager.name }} </option>
          </select>
        </label>
        <label class="label">
          Aliases
          <div class="input --addable">
            <input type="text" class="input --addable" placeholder="Fund Aliases" v-model="aliasModel" />
            <button class="button add" @click="aliases.push(aliasModel); aliasModel = ''">
              Add
            </button>
          </div>
        </label>
        <div class="aliases">
          <div class="alias" v-for="(alias, key) in aliases" :key="alias">
            {{ alias }} <span class="delete" @click="aliases.splice(key, 1)">x</span>
          </div>
        </div>
        <button class="button --margin" :class="{ '--disabled': isDisabled }" @click="createFund">
          {{ this.fund ? 'Update' : 'Create' }}
        </button>
        <button class="button --margin --delete" :class="{ '--disabled': isDisabled }"
          @click="$emit('delete', fund.id)">
          Delete
        </button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    fund: Object,
  },
  emits: ['create', 'close', 'delete'],
  data() {
    return {
      managers: [],
      aliases: [],
      aliasModel: '',
      manager: '',
      name: '',
      year: 2025,
    };
  },
  mounted() {
    this.fetchManagers();
  },
  computed: {
    isDisabled() {
      return this.name.length === 0 || this.year.length === 0;
    }
  },
  methods: {
    async fetchManagers() {
      try {
        const response = await fetch('http://localhost/api/companies');
        this.managers = await response.json();
        this.manager = this.managers[0].id;

        if (this.fund) {
          this.name = this.fund.name;
          this.year = this.fund.start_year;
          this.manager = this.fund.fund_manager_id;
          this.aliases = this.fund.aliases;
        }
      } catch (error) {
        console.error(error);
      }
    },

    async createFund() {
      if (this.isDisabled) {
        return;
      }

      try {
        const url = this.fund ? `http://localhost/api/funds/${this.fund.id}` : 'http://localhost/api/funds';
        const method = this.fund ? 'PUT' : 'POST';

        const response = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
          body: JSON.stringify({
            name: this.name,
            fund_manager_id: this.manager,
            aliases: this.aliases,
            start_year: this.year,
          }),
        });

        const fund = await response.json();
        this.$emit('create', fund);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.funds-create-modal {
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.5);
  position: absolute;
  left: 0;
  top: 0;
  z-index: 100;
  display: flex;
  align-items: center;
  justify-content: center;

  >.content {
    position: relative;
    background-color: white;
    width: 50%;
    min-height: 70%;
    padding: 1rem;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;

    >.close {
      position: absolute;
      top: 0;
      right: 0;
      padding: 0.5rem;
      background-color: red;
      border-radius: 50%;
      height: 20px;
      width: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      margin: 0.5rem;
      cursor: pointer;
    }

    >.title {
      width: 100%;
      text-align: center;
      font-size: 20px;
      text-decoration: underline;
    }

    >.form {
      width: 50%;

      >* {
        width: 100%;
      }

      .button {
        background-color: rgb(28, 118, 186);
        color: white;
        padding: 0.5rem;
        border-radius: 8px;
        cursor: pointer;

        &.--delete {
          background-color: red;
        }

        &.--margin {
          margin-top: 1rem;

          &.--disabled {
            background-color: #667085;
            cursor: not-allowed;
          }
        }
      }

      >.label {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        width: 100%;

        >.input {
          width: 100%;
          padding: 0.5rem;
          margin: 0.5rem 0;
          border: 1px solid #667085;
          border-radius: 8px;

          &.--addable {
            display: flex;
            justify-content: space-between;
            align-items: center;

            input {
              outline: none;
              width: 100%;
            }

            >.add {
              background-color: rgb(28, 118, 186);
              color: white;
              padding: 0.5rem;
              border-radius: 8px;
              cursor: pointer;
            }
          }
        }
      }

      >.aliases {
        padding: 1rem;
        font-size: 12px;
        display: flex;
        justify-content: flex-start;

        >.alias {
          color: white;
          background-color: #667085;
          padding: 0.4rem;
          border-radius: 12px;
          margin: 0.5rem;

          >.delete {
            margin-left: 0.5rem;
            cursor: pointer;
            color: red;
          }
        }
      }
    }
  }
}
</style>