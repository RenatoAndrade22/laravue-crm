<template>
  <TableComponent
    :items="list"
    :fields="fields"
    :form="form"
    title="Filiais"
    slug="filial"
    @emitform="record"
  />
</template>

<script>

import TableComponent from '../components/TableComponent';

export default {
  name: 'Index',
  components: {
    TableComponent,
  },

  data() {
    return {
      list: [],
      fields: ['nome', 'CNPJ', 'telefone', 'status', 'ações'],
      form: [
        {
          col: '6',
          label: 'nome',
          value: null,
          type: 'input',
          required: true,
          placeholder: null,
        },
        {
          col: '6',
          label: 'CNPJ',
          value: null,
          type: 'mask',
          mask: '##.###.###/####-##',
          required: true,
          placeholder: null,
        },
        {
          col: '6',
          label: 'telefone',
          value: null,
          type: 'mask',
          mask: '(##) ####-####',
          required: true,
          placeholder: null,
        },
        {
          col: '6',
          label: 'status',
          value: 1,
          type: 'select',
          required: true,
          placeholder: null,
          options: [
            { value: 1, text: 'Ativo' },
            { value: 0, text: 'Inativo' },
          ],
        },
      ],
    };
  },

  created() {
    this.getClients();
  },

  methods: {

    getClients(){
      this.axios.get('api/branch').then((items) => {
        this.list = this.collect(items.data).map((item) => {
          return {
            id: item.id,
            nome: item.name,
            CNPJ: item.cnpj,
            telefone: item.phone,
            status: item.status,
          };
        });
        this.list = this.list.items;
      });
    },

    record(form, id){
      if (id){
        this.update(form, id);
      } else {
        this.create(form);
      }
    },

    update(form, id){
      this.axios.put('api/branch/' + id,
        {
          name: form[0].value,
          cnpj: form[1].value,
          phone: form[2].value,
          status: form[3].value,
        }
      ).then((resp) => {
        this.list = this.collect(this.list).map((item) => {
          if (item.id === id){
            item = {
              id: resp.data.id,
              nome: resp.data.name,
              CNPJ: resp.data.cnpj,
              telefone: resp.data.phone,
              status: resp.data.status,
            };
          }
          return item;
        });
        this.list = this.list.items;
      });
    },

    create(form){
      this.axios.post('api/branch',
        {
          name: form[0].value,
          cnpj: form[1].value,
          phone: form[2].value,
          status: form[3].value,
        }
      ).then((resp) => {
        this.list.push({
          id: resp.data.id,
          nome: resp.data.name,
          CNPJ: resp.data.cnpj,
          telefone: resp.data.phone,
          status: resp.data.status,
        });
      });
    },

  },
};
</script>

<style scoped>

</style>
