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
          <b-button size="sm" variant="secondary" @click="edit(row.item.id)">Editar</b-button>
        </template>

        <template #cell(status)="row">
          <b-badge v-if="row.item.status === 1" variant="success">Ativo</b-badge>
          <b-badge v-if="row.item.status === 0" variant="danger">Inativo</b-badge>
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

        <b-col v-for="(item, index) in form" :key="index" class="input_form mb-1" :cols="item.col">
          <p>{{ item.label }} <span v-if="item.required" class="required">*</span></p>
          <b-form-input
            v-if="item.type === 'input'"
            v-model="item.value"
            :placeholder="item.placeholder ? item.placeholder : item.label"
          />
          <the-mask
            v-if="item.type === 'mask'"
            v-model="item.value"
            class="form-control input"
            :mask="item.mask"
            name="cnpj"
          />
          <b-form-select v-if="item.type === 'select'" v-model="item.value" :options="item.options" class="form-control" />
        </b-col>

        <!-- submit and reset -->
        <b-col>
          <b-button
            type="submit"
            variant="primary"
            class="mr-1 mt-4 float-end"
            @click="record"
          >
            <span v-if="!edit_id">Cadastrar</span>
            <span v-else>Atualizar</span>
          </b-button>
        </b-col>

      </b-row>
    </b-modal>
  </div>
</template>

<script>

import {
  BRow, BCol, BFormGroup, BFormInput, BFormCheckbox, BForm, BButton, BTable, BFormSelect, BBadge,
} from 'bootstrap-vue';

import { TheMask } from 'vue-the-mask';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

export default {
  name: 'TableComponent',
  components: {
    BBadge,
    BFormSelect,
    TheMask,
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
      edit_item: null,
      slug: null,
      edit_id: null,
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
    this.makeToast();
    if (this.title) {
      this.slug = title.toLowerCase();
    }
  },
  methods: {

    record(){
      this.$bvModal.hide('bv-modal-example');
      this.$emit('emitform', this.form, this.edit_id);
      this.edit_id = null;
    },

    edit(id){
      this.edit_id = id;

      const j = this.collect(this.list).where('id', id).first();

      let i = this.collect(Object.keys(j)).map((item) => {
        console.log('aq', item);

        const i = this.collect(this.form).where('label', item).first();

        if (i){
          i.value = j[i.label];
        }
        return i;
      });

      i = this.collect(i.items).filter(n => n);

      this.form = i.items;
      this.$bvModal.show('bv-modal-example');
    },

    makeToast(variant = 'success') {
      this.$bvToast.toast(`Descrição`, {
        title: 'Titulo',
        autoHideDelay: 3000,
      });
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
