<template>
  <TableComponent
    :items="list"
    :fields="fields"
    :form="form"
    title="Transportadoras"
    slug="transportadora"
    v-on:emitform="record"
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
      fields: ['nome', 'CNPJ', 'telefone', 'email', 'ações'],
      form:[
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
          label: 'email',
          value: null,
          type: 'input',
          required: true,
          placeholder: null,
        },
      ]
    };
  },

  created() {

    this.getClients();
  },

  methods: {

    getClients(){
      this.axios.get('api/company').then((items) => {
        this.list = this.collect(items.data).map((item)=>{
          return{
            id: item.id,
            nome: item.name,
            CNPJ: item.cnpj,
            telefone: item.phone,
            email: item.email,
            active: item.active,
          }
        })
        this.list = this.list.items
      });
    },

    record(form, id){
      if (id){
        this.update(form, id)
      }else{
        this.create(form)
      }
    },

    update(form, id){
      this.axios.put('api/company/'+id,
        {
          name: form[0].value,
          cnpj: form[1].value,
          phone: form[2].value,
          email: form[3].value,
        }
      ).then((resp) => {
        this.list = this.collect(this.list).map((item)=>{
          if (item.id === id){
            this.makeToast()
            item = {
              nome: resp.data.name,
              CNPJ: resp.data.cnpj,
              telefone: resp.data.phone,
              email: resp.data.email,
              active: resp.data.active,
            }
          }
          return item
        })
        this.list = this.list.items
      });
    },

    create(form){
      this.axios.post('api/company',
        {
          name: form[0].value,
          cnpj: form[1].value,
          phone: form[2].value,
          email: form[3].value,
        }
      ).then((resp) => {
        this.list.push({
          nome: resp.data.name,
          CNPJ: resp.data.cnpj,
          telefone: resp.data.phone,
          email: resp.data.email,
          active: resp.data.active,
        });
      });
    },
    makeToast(variant = 'success') {
      this.$bvToast.toast('Toast body content', {
        title: `Variant ${variant || 'default'}`,
        variant: variant,
        solid: true
      })
    }

  },
};
</script>

<style scoped>

</style>
