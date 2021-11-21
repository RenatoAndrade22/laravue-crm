<template>
  <div>
    <b-row class="p-3">
      <b-col cols="6">
        <h3>{{ title }}</h3>
      </b-col>
    </b-row>

    <b-row class="mb-3">

      <b-col cols="4">
        <b-form-input
          id="h-first-name"
          v-model="search"
          :placeholder="'Buscar '+slug"
        />
      </b-col>

      <b-col cols="3" class="float-end">
        <b-button
          type="submit"
          variant="primary"
          @click="$bvModal.show('bv-modal-example')"
        >
          Cadastrar novo
        </b-button>
      </b-col>

    </b-row>

    <div class="box">
      <b-table v-if="table" hover :bordered="true" :items="list" :fields="fields">
        <template #cell(ações)="row">
          <b-button size="sm" variant="secondary">Ver</b-button>
          <b-button size="sm" variant="secondary">Editar</b-button>
        </template>
      </b-table>
    </div>

    <b-modal
      id="bv-modal-example"
      ref="first-login"
      size="lg"
      :title="'Cadastrar '+slug"
      centered
      hide-footer
    >
      <b-row class="form">

        <b-col class="input_form mb-1" v-for="(item, index) in form" :cols="item.col" >
          <p>{{ item.label }} <span class="required" v-if="item.required">*</span></p>
          <b-form-input
            v-if="item.type === 'input'"
            v-model="item.value"
            :placeholder="item.placeholder ? item.placeholder : item.label"
          />
        </b-col>

        <!-- submit and reset -->
        <b-col>
          <b-button
            type="submit"
            variant="primary"
            class="mr-1 mt-4 float-end"
            @click="record"
          >
            Cadastrar
          </b-button>
        </b-col>

      </b-row>
    </b-modal>
  </div>
</template>

<script>

import {
  BRow, BCol, BFormGroup, BFormInput, BFormCheckbox, BForm, BButton, BTable,
} from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

export default {
  name: 'TableComponent',
  components: {
    BTable,
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BForm,
    BButton,
  },
  props: {
    items: {},
    title: {},
    slug: {},
    fields: {},
    form: {},
  },
  data() {
    return {
      table: true,
      search: null,
      slug: null,
      form: {
        name: null,
        phone: null,
        email: null,
        cpf: null,
        address_id: null,
        company_id: null,
      },
    };
  },
  computed: {
    list(){
      let list = this.items;

      if (this.search){
        list = this.collect(list).filter((item) => {
          if (item.nome.search(this.search) >= 0 || item.telefone.search(this.search) >= 0 || item.email.search(this.search) >= 0){
            return true;
          } else {
            return false;
          }
        });
        list = list.items;
      }

      return list;
    },
  },
  created() {
    if (this.title) {
      this.slug = title.toLowerCase();
    }
  },
  methods: {
    record(){
      this.$bvModal.hide('bv-modal-example');
      this.$emit('emitform', this.form);
    },
  },
};
</script>

<style scoped>

  .form p{
    margin-bottom: 5px;
  }

  .input_form{
    margin-bottom: 20px !important;
  }

</style>
