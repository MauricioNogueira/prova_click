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
                        <td>R$ {{ parseFloat(fruta.valor_unitario).toFixed(2) }}</td>
                        <td>R$ {{ parseFloat(fruta.valor_total).toFixed(2) }}</td>
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
                    <select2 v-on:setvalue="valorSelect" class="form-control" :route="fruitRoute" id="fruta" name="fruta"></select2>
                </div>

                <div class="col-md-2">
                    <label for="fruta">Quantidade</label>
                    <input v-model="fields.quantidade" class="form-control" type="text" name="quantidade" id="quantidade_venda" />
                </div>

                <div class="col-md-2">
                    <label for="fruta">Quantidade no estoque</label>
                    <input readonly v-model="estoque" class="form-control" type="text" id="quantidade_estoque" />
                </div>

                <div class="col-md-4">
                    <label for="fruta">Valor</label>
                    <money v-model="fields.valor" v-bind="money" class="form-control" name="valor_venda" id="valor_venda"></money>
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
                        <input v-model="cliente.nome" class="form-control" type="text" name="nome_cliente" id="nome_cliente" />
                    </div>

                    <div class="col-md-4">
                        <label for="cpf">CPF</label>
                        <input v-model="cliente.cpf" v-mask="'###.###.###-##'" class="form-control" type="text" name="cpf" id="cpf">
                    </div>

                    <div class="col-md-4">
                        <label for="valor_gasto">Valor a pagar</label>
                        <money readonly class="form-control" v-bind="money" name="valor_gasto" id="valor_gasto" :value="total"></money>
                    </div>
                </div>

                <button @click="comprar" class="btn btn-success mt-2">Efetuar compra</button>
            </form>
        </section>
    </div>
</template>

<script>
    import {VMoney} from 'v-money';

    export default {
        props: {
            fruitRoute: {
                type: String,
                required: true
            },

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
                    valor_gasto: 0
                },
                fields: {
                    fruta: null,
                    valor: 0,
                    quantidade: null
                },
                pedido: true,
                totalAPagar: 0,
                statusCompra: 'Aberto',
                bgBadge: 'success',
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: 'R$ ',
                    suffix: '',
                    precision: 2,
                },

                totalEstoque: null
            }
        },

        directives: {money: VMoney},

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
            },

            estoque() {
                return this.totalEstoque;
            }
        },

        methods: {
            adicionar() {
                if (this.fields.fruta && this.fields.quantidade && this.fields.valor) {
                    let valorTotal = (this.fields.quantidade * this.fields.valor);
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
                this.totalEstoque = fruta.quantidade;

                if (fruta.quantidade == 0) {
                    document.getElementById('quantidade_venda').setAttribute('disabled', true);
                } else {
                    document.getElementById('quantidade_venda').removeAttribute('disabled');
                }

                this.fields.fruta = fruta.text;
            },

            limpaCampos() {
                this.fields.fruta = null;
                this.fields.valor = 0;
                this.fields.quantidade = null;
                this.totalEstoque = null;
            },

            async comprar(e) {
                e.preventDefault();
                
                if (this.cliente.nome && this.cliente.cpf) {
                    this.cliente.valor_gasto = this.total;

                    await axios.post(this.route, {
                        vendas: this.listaCompras,
                        cliente: this.cliente
                    })
                    .then(response => {
                        alert(response.data.message);
                        this.start();
                    })
                    .catch(error => {
                        alert(error.response.data.message);
                    })
                    .finally(() => {
                        console.log("Fim da compra");
                    })
                } else {
                    alert("Dados do cliente precisa ser preenchido");
                }
            },

            start() {
                this.bgBadge = 'success';
                this.statusCompra = 'Aberto';
                this.pedido = true;
                this.totalAPagar = 0;
                this.listaCompras = [];

                this.cliente.nome = null;
                this.cliente.cpf = null;
            }
        },

        mounted() {
            
        },
    }
</script>

<style scoped>
    
</style>