<template>
  <div>
    <b-row class="p-3">
      <b-col cols="6">
        <h3>Clientes</h3>
      </b-col>
    </b-row>

    <b-row class="mb-3">

      <b-col cols="4">
        <b-form-input
          id="h-first-name"
          v-model="search"
          placeholder="Buscar cliente"
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
      <b-table v-if="table" hover :bordered="true" :items="items" :fields="fields">
        <template #cell(actions)="row">
          <b-button size="sm" variant="secondary">Ver</b-button>
          <b-button size="sm" variant="secondary">Editar</b-button>
        </template>
      </b-table>
    </div>

    <b-modal
      id="bv-modal-example"
      ref="first-login"
      size="lg"
      title="Cadastrar cliente"
      centered
      hide-footer
    >
      <b-row class="form">

        <b-col cols="6" class="input_form">
          <p>Nome <span class="required">*</span></p>
          <b-form-input
            v-model="form.name"
            placeholder="Nome"
          />
        </b-col>
        <b-col cols="6" class="input_form">
          <p>Telefone <span class="required">*</span></p>
          <b-form-input
            v-model="form.phone"
            type="text"
            placeholder="Telefone"
          />
        </b-col>
        <b-col cols="6" class="input_form">
          <p>Email</p>
          <b-form-input
            v-model="form.email"
            type="email"
            placeholder="Email"
          />
        </b-col>
        <b-col cols="6" class="input_form">
          <p>CPF</p>
          <b-form-input
            v-model="form.cpf"
            type="text"
            placeholder="CPF"
          />
        </b-col>

        <hr style="margin: 28px 13px; color: #0b5ed7">

        <b-col cols="6" class="input_form">
          <p>CEP</p>
          <b-form-input
            placeholder="CEP"
            style="width: 40%; float: left"
          />
          <b-button
            type="submit"
            variant="primary"
            style="width: 40%; float: left; margin-left: 10px"
          >
            Buscar endereço
          </b-button>
        </b-col>

        <b-col cols="6" class="input_form">
          <p>Rua</p>
          <b-form-input
            placeholder="Rua"
          />
        </b-col>

        <b-col cols="6" class="input_form">
          <p>Número</p>
          <b-form-input
            placeholder="Número"
          />
        </b-col>

        <b-col cols="6" class="input_form">
          <p>Bairro</p>
          <b-form-input
            placeholder="Bairro"
          />
        </b-col>

        <b-col cols="6" class="input_form">
          <p>Complemento</p>
          <b-form-input
            placeholder="Complemento"
          />
        </b-col>

        <b-col cols="4" class="input_form">
          <p>Cidade</p>
          <b-form-input
            placeholder="Cidade"
          />
        </b-col>

        <b-col cols="2" class="input_form">
          <p>UF</p>
          <b-form-input
            placeholder="UF"
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
  name: 'Table',
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
    items: {

    },
  },
  data() {
    return {
      table: true,
      fields: ['name', 'phone', 'cpf', 'actions'],
      search: null,
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
  methods: {
    record(){
    },
  },
};
</script>

<style scoped>

</style>
