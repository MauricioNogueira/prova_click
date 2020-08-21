<template>
    <div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>CPF</th>
                    <th>Quantidade comprada</th>
                    <th>Total gasto</th>
                    <th>Data da compra</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!listagemVendas.length">
                    <td class="text-center" colspan="5">Nenhum registro de vendas</td>
                </tr>
                <tr v-else :key="index" v-for="(venda, index) in listagemVendas">
                    <td>{{ venda.nome }}</td>
                    <td>{{ venda.cpf }}</td>
                    <td>{{ venda.quantidade }}</td>
                    <td>R$ {{ venda.total_gasto.toFixed(2) }}</td>
                    <td>{{ venda.data_compra }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                vendas: []
            }
        },

        computed: {
            listagemVendas() {
                return this.vendas;
            }
        },

        methods: {
            async getVendas() {
                const {data} = await axios.get(this.route);

                console.log(data)

                this.vendas = data;
            }
        },

        async mounted() {
            await this.getVendas();
        }
    }
</script>

<style scoped>

</style>
