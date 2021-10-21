<template>
    <div>
      <b-row class="p-3">
        <b-col cols="6">
          <h3>Clientes</h3>
          <p>Adicione um novo cliente</p>
        </b-col>

      </b-row>
      <b-row>
        <b-col cols="6">
          <div class="box">
            <b-form>
              <b-row>
                <b-col cols="6">
                  <b-form-group
                    label="Nome"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      id="h-first-name"
                      placeholder="Nome"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Telefone"
                    label-for="h-email"
                    label-cols-md="4"
                  >
                    <b-form-input
                      type="text"
                      placeholder="Telefone"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Email"
                    label-for="h-email"
                    label-cols-md="4"
                  >
                    <b-form-input
                      id="h-email"
                      type="email"
                      placeholder="Email"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="CPF"
                    label-for="h-number"
                    label-cols-md="4"
                  >
                    <b-form-input
                      type="text"
                      placeholder="CPF"
                    />
                  </b-form-group>
                </b-col>
              </b-row>
            </b-form>
          </div>
        </b-col>

        <b-col cols="6">
          <div class="box">
            <b-form>
              <b-row>

                <b-col cols="6">
                  <b-form-group
                    label="Rua"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      placeholder="Rua"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Número"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      placeholder="Número"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Bairro"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      placeholder="Bairro"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Complemento"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      placeholder="Complemento"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Cidade"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      placeholder="Cidade"
                    />
                  </b-form-group>
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    label="Estado"
                    label-for="h-first-name"
                    label-cols-md="4"
                  >
                    <b-form-input
                      placeholder="Estado"
                    />
                  </b-form-group>
                </b-col>

                <!-- submit and reset -->
                <b-col>
                  <b-button
                    type="submit"
                    variant="primary"
                    class="mr-1 mt-4 float-end"
                  >
                    Cadastrar
                  </b-button>
                </b-col>

              </b-row>
            </b-form>
          </div>
        </b-col>

      </b-row>
    </div>
</template>

<script>

import {
  BRow, BCol, BFormGroup, BFormInput, BFormCheckbox, BForm, BButton,
} from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

export default {
    name: 'Name',
    components: {
      BRow,
      BCol,
      BFormGroup,
      BFormInput,
      BFormCheckbox,
      BForm,
      BButton,
    },

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

</style>
