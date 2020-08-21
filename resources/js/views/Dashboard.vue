<template>
    <div>
        <card header="Receita" title="Total ganho" :text="totalReceita"></card>

        <div class="teste">
            <canvas id="bar-chart" class="chartjs-render-monitor" style="display: block; width: 100; height: 100px;"></canvas>
        </div>
    </div>
</template>

<script>
import { Bar } from "vue-chartjs";

export default {
    props: {
        fruitRoute: {
            type: String,
            required: true
        },

        routeTotalGanho: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            frutas: [],
            labels: [],
            bgColors: [],
            bdColors: [],

            receita: 0
        }
    },

    computed: {
        totalReceita() {
            return `R$ ${this.receita.toFixed(2)}`;
        }
    },

    methods: {
        async buscarDados() {
            const {data}  = await axios.get(this.fruitRoute, {});

            data.forEach(fruta => {
                this.frutas.push(fruta.quantidade);
                this.labels.push(fruta.text);
                this.bgColors.push('rgba(255, 99, 132, 0.2)');
                this.bdColors.push('rgba(255, 99, 132, 1)');
            });
        },

        totalGanho() {
            axios.get(this.routeTotalGanho)
            .then(response => {
                this.receita = response.data.total
            })
            .catch(error => {
                this.receita = 0;
            })
            .finally(() => {

            })
        }
    },
    extends: Bar,
  async mounted() {
    this.totalGanho();
    await this.buscarDados();

    let ctx = document.getElementById('bar-chart').getContext('2d');

    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: this.labels,
            datasets: [{
                label: 'Frutas no estoque',
                data: this.frutas,
                backgroundColor: this.bgColors,
                borderColor: this.bdColors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    })
  }
};
</script>

<style scoped>
    .teste {
        width: 600px;
        height: 400px;
    }
</style>
