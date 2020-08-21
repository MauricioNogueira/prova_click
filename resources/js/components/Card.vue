<template>
    <div :class="'card text-'+textColor+' mb-3 '+bgColor" style="max-width: 18rem;">
        <div class="card-header">{{ header }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">{{ text }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            header: {
                type: String,
                required: true
            },

            title: {
                type: String,
                required: true
            },

            text: {
                type: String,
                required: false
            },

            bgColor: {
                type: String,
                default: 'bg-primary'
            },

            textColor: {
                type: String,
                default: 'white'
            }
        }
    }
</script>

<style scoped>
    
</style>