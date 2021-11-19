<template>
  <div>

    <b-row class="p-3">
      <b-col cols="6">
        <h3>Pagamentos</h3>
      </b-col>
    </b-row>

    <b-row class="mb-3">

      <b-col cols="4">
        <b-form-input
          id="h-first-name"
          v-model="search"
          placeholder="Buscar pagamento"
        />
      </b-col>

      <b-col cols="3" class="float-end">
        <b-button
          type="submit"
          variant="primary"
          @click="$bvModal.show('bv-modal-example')"
        >
          Cadastrar novos
        </b-button>
      </b-col>
    </b-row>

    <div class="box">
      <b-table hover :bordered="true" :items="list" :fields="fields">
        <template #cell(pagamento)="row">
          <b-badge variant="success">Efetivado</b-badge>
          <b-badge variant="danger">Estornado</b-badge>
        </template>
        <template #cell(ações)="row">
          <b-button size="sm" variant="secondary">Estornar pagamento</b-button>
        </template>
      </b-table>
    </div>

    <b-modal
      size="lg"
      id="bv-modal-example"
      ref="first-login"
      title="Cadastrar pagamento"
      centered
      hide-footer
    >
      <b-row class="form">

        <b-col cols="6" class="input_form">
          <p>Nome <span class="required">*</span></p>
          <b-form-select v-model="selected" :options="options" class="mb-3">
          </b-form-select>Actions
        </b-col>
        <b-col cols="6" class="input_form">
          <p>Telefone <span class="required">*</span></p>
          <b-form-input
            type="text"
            v-model="form.phone"
            placeholder="Telefone"
          />
        </b-col>
        <b-col cols="6" class="input_form">
          <p>Email</p>
          <b-form-input
            type="email"
            v-model="form.email"
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
  BBadge, BFormSelectOption, BFormSelect, BRow, BCol, BFormGroup, BFormInput, BFormCheckbox, BForm, BButton, BTable
} from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

export default {
  name: "Record",
  components: {
    BBadge,
    BFormSelectOption,
    BFormSelect,
    BTable,
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BForm,
    BButton,
  },
  data() {
    return {
      selected: null,
      options: [
        { value: 'A', text: 'Paulo 55' },
        { value: 'B', text: 'Ricardo 12' }
      ],
      fields: ['pagamento', 'name', 'valor', 'ações'],
      items: [],
      search: null,
      form:{
        name: null,
        phone: null,
        email: null,
        cpf: null,
        address_id: null,
        company_id: null,
      }
    }
  },

  methods:{
    record(){
      this.axios.post('api/client', this.form).then((resp)=>{
        console.log('aqqq', resp.data)
        this.items.push(resp.data)
        this.$bvModal.hide('bv-modal-example')
      })
    },

    getClients(){
      this.axios.get('api/client').then((items) => {
        this.items = items.data
      })
    }

  },

  created() {
    this.getClients()
  },

  computed:{
    list(){

      let list = this.items

      if (this.search){

        list = this.collect(list).filter((item) => {
          if (item.name.search(this.search) >= 0 || item.phone.search(this.search) >= 0 || item.cpf.search(this.search) >= 0){
            return true
          }else{
            return false
          }
        })
        list = list.items
      }

      return list
    }
  }
}
</script>

<style scoped>
.box{
  padding: 20px;
  position: relative;
  -webkit-box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
  box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(34,41,47,.125);
  border-radius: .428rem;
  transition: all .3s ease-in-out,background 0s,color 0s,border-color 0s;
}
.form p{
  margin-bottom: 0;
  margin-left: 5px;
  line-height: 32px;
  font-size: 13px;
}

.input_form{
  margin-bottom: 23px;
}

.required{
  color: red;
}
</style>
