<template>
    <div>
        <h2>Carrinho</h2>
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Fruta</th>
                        <th>Quantidade</th>
                        <th>Valor unitario</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="!frutas.length">
                        <td class="text-center" colspan="4">Nenhum pedido feito</td>
                    </tr>
                    <tr v-else :key="index" v-for="(fruta, index) in frutas">
                        <td>{{ fruta.nome }}</td>
                        <td>{{ fruta.quantidade }}</td>
                        <td>{{ fruta.valor_unitario }}</td>
                        <td>{{ fruta.valor_total }}</td>
                    </tr>
                </tbody>
            </table>

            <div>
                <strong>Total da compra: R$ </strong> {{ total }}
            </div>
            <div>
                <strong>Status da compra: </strong>
                <span :class="`badge badge-${colorBadge}`">{{ status }}</span>
            </div>
        </div>

        <section v-if="pedidoAberto">
            <div class="row">
                <div class="col-md-4">
                    <label for="fruta">Fruta</label>
                    <select2 v-on:setvalue="valorSelect" class="form-control" :route="route" id="fruta" name="fruta"></select2>
                </div>

                <div class="col-md-4">
                    <label for="fruta">Quantidade</label>
                    <input v-model="fields.quantidade" class="form-control" type="text" name="quantidade" id="quantidade_venda">
                </div>

                <div class="col-md-4">
                    <label for="fruta">Valor</label>
                    <input v-model="fields.valor" class="form-control" type="number" name="valor_venda" id="valor_venda">
                </div>

            </div>
            <div>
                <button @click="adicionar" class="btn btn-primary">Adicionar</button>
                <button @click="fecharPedido" class="btn btn-success">Fechar pedido</button>
            </div>
        </section>
        <section v-else>
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <label for="nome_cliente">Nome do cliente</label>
                        <input v-model="this.cliente.nome" class="form-control" type="text" name="nome_cliente" id="nome_cliente">
                    </div>

                    <div class="col-md-4">
                        <label for="cpf">CPF</label>
                        <input v-model="this.cliente.cpf" class="form-control" type="text" name="cpf" id="cpf">
                    </div>

                    <div class="col-md-4">
                        <label for="valor_gasto">Valor a pagar</label>
                        <input v-model="this.cliente.valor_gasto" class="form-control" type="text" name="valor_gasto" id="valor_gasto">
                    </div>
                </div>

                <button @click="comprar" class="btn btn-success">Efetuar compra</button>
            </form>
        </section>
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
                listaCompras: [],
                cliente: {
                    nome: null,
                    cpf: null,
                    valor_gasto: null
                },
                fields: {
                    fruta: null,
                    valor_unitario: null,
                    valor_total: null,
                    quantidade: null
                },
                pedido: true,
                totalAPagar: 0,
                statusCompra: 'Aberto',
                bgBadge: 'success'
            }
        },

        computed: {
            frutas() {
                return this.listaCompras;
            },

            pedidoAberto() {
                return this.pedido;
            },
            
            status() {
                return this.statusCompra;
            },

            colorBadge() {
                return this.bgBadge;
            },

            total() {
                return this.totalAPagar.toFixed(2);
            }
        },

        methods: {
            adicionar() {
                if (this.fields.fruta && this.fields.quantidade && this.fields.valor) {
                    let valorTotal = this.fields.quantidade * this.fields.valor;
                    this.totalAPagar += valorTotal;
                    $('#fruta').val(null).trigger('change');

                    this.listaCompras.push({
                        nome: this.fields.fruta,
                        quantidade: this.fields.quantidade,
                        valor_unitario: this.fields.valor,
                        valor_total: valorTotal
                    });
                    
                    this.limpaCampos();
                } else {
                    console.log("Possui campos vazios");
                }
            },

            fecharPedido() {
                if (this.listaCompras.length) {
                    this.statusCompra = 'Fechado';
                    this.bgBadge = 'danger';
                    this.pedido = false;
                } else {
                    alert("OPS, seu carrinho está vazio :(");
                }
            },

            valorSelect(fruta) {
                this.fields.fruta = fruta.text;
            },

            limpaCampos() {
                this.fields.fruta = null;
                this.fields.valor = null;
                this.fields.quantidade = null;
            },

            comprar() {
                alert("Finalizando compra");
            }
        },

        mounted() {
            
        },
    }
</script>

<style scoped>
    
</style>