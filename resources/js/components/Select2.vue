<template>
    <select :name="name" :id="id">
    </select>
</template>

<script>
    export default {
        props: {
            id: {
                type: String,
                required: true
            },

            name: {
                type: String,
                required: true
            },

            route: {
                type: String,
                required: true
            }
        },

        mounted() {
            $(`#${this.id}`).select2({
                width: '100%',
                minimumInputLength: 3,
                ajax: {
                    url: this.route,
                    dataType: 'json',
                    data: function (params) {
                        let query = {
                            search: params.term,
                            type: 'public'
                        }

                        return query;
                    },

                    processResults: function (data) {
                        console.log(data);
                        return {
                            results: data
                        };
                    }
                }
            });
        },
    }
</script>

<style scoped>
    
</style>