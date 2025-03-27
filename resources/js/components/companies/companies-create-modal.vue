<template>
    <section class="companies-create-modal">
      <div class="content">
        <span class="close" @click="$emit('close')">x</span>
        <h1 class="title">Creating Company</h1>
        <div class="form">
          <label class="label">Name
            <input type="text" class="input" placeholder="Company Name" v-model="name" />
          </label>
          <button class="button --margin" :class="{ '--disabled': isDisabled }" @click="createCompany">
            {{ this.Company ? 'Update' : 'Create' }}
          </button>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    emits: ['create', 'close'],
    data() {
      return {
        name: '',
      };
    },
    computed: {
      isDisabled() {
        return this.name.length === 0;
      }
    },
    methods: {
      async createCompany() {
        if (this.isDisabled) {
          return;
        }
  
        try {
          const response = await fetch('http://localhost/api/companies', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
            },
            body: JSON.stringify({
              name: this.name,
            }),
          });
  
          const company = await response.json();
          this.$emit('create', company);
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>
  
  <style lang="scss" scoped>
  .companies-create-modal {
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